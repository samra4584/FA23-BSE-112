<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'delivery_method' => 'required|string',
            'total' => 'required|numeric',
        ]);

        // Get cart from form (sent as JSON string)
        $cartJson = $request->input('cart', '[]');
        $cart = json_decode($cartJson, true);
        
        // If cart is empty or invalid, try to get from session as fallback
        if (empty($cart) || !is_array($cart)) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty! Please add items to your cart first.');
        }

        // Calculate totals
        $subtotal = array_sum(array_column($cart, 'price'));
        $deliveryCosts = [
            'standard' => 2.00,
            'express' => 5.00,
            'pickup' => 0.00,
        ];
        $deliveryCost = $deliveryCosts[$request->delivery_method] ?? 2.00;
        $total = $subtotal + $deliveryCost;

        // Create order
        $order = Order::create([
            'customer_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'delivery_method' => $request->delivery_method,
            'delivery_cost' => $deliveryCost,
            'subtotal' => $subtotal,
            'total' => $total,
            'status' => 'pending',
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => 1,
            ]);
        }

        // Store order in session for thank you page
        Session::put('order', [
            'name' => $order->customer_name,
            'address' => $order->address,
            'total' => number_format($order->total, 2),
        ]);

        return redirect()->route('thankyou');
    }

    public function thankyou()
    {
        $order = Session::get('order', []);
        return view('thankyou', compact('order'));
    }
}