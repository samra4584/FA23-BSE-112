@extends('layouts.app')

@section('title', 'Beanix - Checkout')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('home') }}#home">
      <img src="{{ asset('images/logo.png') }}" width="60" alt="logo"> Beanix
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav me-3">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('menu') }}">Menu</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('products') }}">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#review">Review</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#contact">Contact</a></li>
      </ul>

      <!-- Logout Button -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-outline-warning ms-2">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Checkout Section -->
<section class="container mt-5 pt-5">
  <h2 class="text-center text-warning mb-4">Shipping Information</h2>

  <form id="shipping-form" class="bg-black p-4 rounded shadow" action="{{ route('checkout.store') }}" method="POST">
    @csrf
    <div class="row mb-3">
      <div class="col-md-6">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control" name="name" id="name" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Phone Number</label>
        <input type="tel" class="form-control" name="phone" id="phone" required>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-6">
        <label class="form-label">Email Address</label>
        <input type="email" class="form-control" name="email" id="email" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Delivery Address</label>
        <input type="text" class="form-control" name="address" id="address" required>
      </div>
    </div>

    <div class="mb-4">
      <label class="form-label">Delivery Method</label>
      <select class="form-select" name="delivery_method" id="delivery-method" required>
        <option value="" disabled selected>Select a method</option>
        <option value="standard" data-cost="2.00">Standard Delivery ($2.00)</option>
        <option value="express" data-cost="5.00">Express Delivery ($5.00)</option>
        <option value="pickup" data-cost="0.00">Pickup from Cafe (Free)</option>
      </select>
    </div>

    <input type="hidden" name="total" id="order-total" value="0.00">
    <input type="hidden" name="cart" id="cart-data" value="">

    <button type="submit" class="btn btn-coffee w-100">Place Order</button>
  </form>

  <!-- Order Summary -->
  <div class="p-4 bg-black rounded shadow mt-5" id="order-summary" style="background-color: #1a1a1a !important;">
    <h4 class="text-warning mb-3">Order Summary</h4>
    <ul id="summary-list" class="list-group mb-3" style="max-height: 300px; overflow-y: auto;"></ul>

    <div class="d-flex justify-content-between mt-3 text-light">
      <strong>Total Items:</strong> <span id="summary-items" class="text-light">0</span>
    </div>
    <div class="d-flex justify-content-between text-light">
      <strong>Subtotal:</strong> <span id="summary-subtotal" class="text-light">$0.00</span>
    </div>
    <div class="d-flex justify-content-between text-light">
      <strong>Delivery:</strong> <span id="summary-delivery" class="text-light">$0.00</span>
    </div>
    <hr class="text-light">
    <div class="d-flex justify-content-between fw-bold fs-5 text-warning">
      <span>Total:</span> <span id="summary-total" class="text-warning">$0.00</span>
    </div>
  </div>
</section>

<footer class="text-center mt-5">
  <p>© 2025 Beanix | Designed by Aliza ☕</p>
</footer>

@push('scripts')
<script>
  // Wait for DOM to be ready
  document.addEventListener('DOMContentLoaded', function() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const summaryList = document.getElementById("summary-list");
    const summaryItems = document.getElementById("summary-items");
    const summarySubtotal = document.getElementById("summary-subtotal");
    const summaryDelivery = document.getElementById("summary-delivery");
    const summaryTotal = document.getElementById("summary-total");
    const orderTotal = document.getElementById("order-total");
    const cartDataInput = document.getElementById("cart-data");

    function updateSummary() {
      if (!summaryList || !summaryItems || !summarySubtotal || !summaryDelivery || !summaryTotal) {
        console.error('Summary elements not found');
        return;
      }

      const delivery = document.getElementById("delivery-method");
      const deliveryCost = parseFloat(delivery?.selectedOptions[0]?.dataset.cost || 0);

      // Clear and rebuild the list
      summaryList.innerHTML = "";
      let total = 0;
      
      if (cart.length === 0) {
        const li = document.createElement("li");
        li.className = "list-group-item bg-dark text-light text-center";
        li.textContent = "Your cart is empty";
        summaryList.appendChild(li);
      } else {
        cart.forEach(item => {
          const li = document.createElement("li");
          li.className = "list-group-item bg-dark text-light d-flex justify-content-between align-items-center";
          li.innerHTML = `<span>${item.name}</span> <span>$${parseFloat(item.price).toFixed(2)}</span>`;
          summaryList.appendChild(li);
          total += parseFloat(item.price);
        });
      }

      // Update summary values
      summaryItems.textContent = cart.length;
      summarySubtotal.textContent = `$${total.toFixed(2)}`;
      summaryDelivery.textContent = `$${deliveryCost.toFixed(2)}`;
      const finalTotal = total + deliveryCost;
      summaryTotal.textContent = `$${finalTotal.toFixed(2)}`;
      
      if (orderTotal) {
        orderTotal.value = finalTotal.toFixed(2);
      }
      
      // Update cart data for form submission
      if (cartDataInput) {
        cartDataInput.value = JSON.stringify(cart);
      }
    }

    // Update summary when delivery method changes
    const deliveryMethod = document.getElementById("delivery-method");
    if (deliveryMethod) {
      deliveryMethod.addEventListener("change", updateSummary);
    }

    // Update cart data before form submission
    const shippingForm = document.getElementById("shipping-form");
    if (shippingForm) {
      shippingForm.addEventListener("submit", function(e) {
        // Re-read cart from localStorage in case it changed
        cart = JSON.parse(localStorage.getItem("cart")) || [];
        if (cartDataInput) {
          cartDataInput.value = JSON.stringify(cart);
        }
        if (cart.length === 0) {
          e.preventDefault();
          alert("Your cart is empty! Please add items to your cart first.");
          return false;
        }
      });
    }

    // Initial update
    updateSummary();
  });
</script>
@endpush
@endsection
