<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Check if admin is logged in
     */
    private function checkAdmin()
    {
        if (!Session::has('adminLoggedIn')) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    public function index()
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $products = Product::latest()->get();
        $menus = Menu::latest()->get();
        $orders = Order::where('status', 'pending')->with('items')->latest()->get();
        $completedOrders = Order::where('status', 'completed')->with('items')->latest()->get();
        $allOrders = Order::with('items')->latest()->get();
        $users = User::latest()->get();
        
        // Calculate statistics
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $todayRevenue = Order::where('status', 'completed')
            ->whereDate('created_at', today())
            ->sum('total');
        $monthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');
        
        return view('adminpage', compact(
            'products', 
            'menus', 
            'orders', 
            'completedOrders', 
            'allOrders',
            'users',
            'totalRevenue',
            'todayRevenue',
            'monthRevenue'
        ));
    }

    public function storeUser(Request $request)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User added successfully!');
    }

    public function storeProduct(Request $request)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:coffee,product',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');
        
        if ($request->type === 'coffee') {
            Menu::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $imagePath,
            ]);
            $message = 'Menu item added successfully!';
        } else {
            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $imagePath,
            ]);
            $message = 'Product added successfully!';
        }

        return redirect()->route('admin.dashboard')->with('success', $message);
    }

    public function getProduct($id)
    {
        if (!Session::has('adminLoggedIn')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function updateProduct(Request $request, $id)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }
        
        $product->save();

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully!');
    }

    public function deleteProduct($id)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $product = Product::findOrFail($id);
        
        // Delete image
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully!');
    }

    public function getMenu($id)
    {
        if (!Session::has('adminLoggedIn')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $menu = Menu::findOrFail($id);
        return response()->json($menu);
    }

    public function updateMenu(Request $request, $id)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $menu = Menu::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->description = $request->description;
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $menu->image = $request->file('image')->store('products', 'public');
        }
        
        $menu->save();

        return redirect()->route('admin.dashboard')->with('success', 'Menu item updated successfully!');
    }

    public function deleteMenu($id)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $menu = Menu::findOrFail($id);
        
        // Delete image
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }
        
        $menu->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Menu item deleted successfully!');
    }

    public function completeOrder($id)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $order = Order::findOrFail($id);
        $order->status = 'completed';
        $order->save();

        return redirect()->route('admin.dashboard')->with('success', 'Order marked as completed!');
    }

    public function showOrder($id)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $order = Order::with('items')->findOrFail($id);

        return view('admin-order-show', compact('order'));
    }
}