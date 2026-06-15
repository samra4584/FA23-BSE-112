@extends('layouts.app')

@section('title', 'Beanix - Our Products')

@push('styles')
<style>
  body { padding-top: 80px; }
  #products { background-color: #111; padding: 80px 0; }
  .card { background-color: #1a1a1a; border: none; border-radius: 15px; transition: transform 0.3s, box-shadow 0.3s; }
  .card:hover { transform: translateY(-8px); box-shadow: 0 8px 25px rgba(212, 163, 115, 0.3); }
  .card img { height: 300px; object-fit: cover; border-radius: 10px 10px 0 0; }
  .btn-coffee { background-color: #d4a373; color: #000; font-weight: 600; border-radius: 30px; padding: 8px 20px; transition: all 0.3s; }
  .btn-coffee:hover { background-color: #fff; color: #000; }
  #navbarNav { display: none; }
  #navbarNav.show { display: flex !important; flex-direction: column; }
  @media(min-width: 992px) { #navbarNav { display: flex !important; flex-direction: row; } }
  #message { position: fixed; top: 80px; right: 20px; background-color: #d4a373; color: #000; padding: 10px 20px; border-radius: 5px; display: none; z-index: 1000; }
</style>
@endpush

@section('content')
<div id="message">Added to cart successfully!</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('home') }}#home">
      <img src="{{ asset('images/logo.png') }}" width="60" alt="logo"> Beanix
    </a>
    <button class="navbar-toggler" type="button" id="navToggle">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav me-3">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('menu') }}">Menu</a></li>
        <li class="nav-item"><a class="nav-link active" href="{{ route('products') }}">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#review">Review</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#contact">Contact</a></li>

        <li class="nav-item dropdown position-relative">
          <a class="nav-link position-relative" href="#" id="navbarCart" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-cart4"></i>
            <span class="badge rounded-pill bg-danger" id="cart-count">0</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end p-3 bg-dark text-light" style="min-width:300px; z-index:1050;" aria-labelledby="navbarCart">
            <li><h6 class="text-warning">Your Cart</h6></li>
            <li><hr class="dropdown-divider"></li>
            <li><ul class="list-unstyled" id="cart-items" style="max-height:200px; overflow-y:auto;"></ul></li>
            <li><hr class="dropdown-divider"></li>
            <li class="d-flex justify-content-between text-light fw-bold">
              Total: $<span id="cart-total">0.00</span>
            </li>
            <li class="mt-2 d-flex justify-content-between">
              <a href="{{ route('checkout') }}" class="btn btn-sm btn-warning checkout">Checkout</a>
              <button class="btn btn-sm btn-danger clear-cart">Clear</button>
            </li>
          </ul>
        </li>
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

<!-- Products Section -->
<section id="products" class="text-center">
  <div class="container">
    <h2 class="fw-bold mb-5" style="color:#d4a373;">Our Coffee Products</h2>
    <div class="row g-4">
      @forelse($products ?? [] as $product)
        <div class="col-md-4 col-sm-6">
          <div class="card text-light h-100">
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
              <h5 class="card-title">{{ $product->name }}</h5>
              <p class="text-secondary">{{ $product->description }}</p>
              <p class="fw-bold">${{ number_format($product->price, 2) }}</p>
              <button class="btn btn-coffee add-cart" data-name="{{ $product->name }}" data-price="{{ $product->price }}">Add to cart</button>
            </div>
          </div>
        </div>
      @empty
        <!-- Default static items if no database items -->
        <div class="col-md-4 col-sm-6">
          <div class="card text-light h-100">
            <img src="{{ asset('images/coffeebeans.jpg') }}" class="card-img-top" alt="Coffee Beans">
            <div class="card-body">
              <h5 class="card-title">Premium Coffee Beans</h5>
              <p class="text-secondary">Freshly roasted beans sourced from the finest farms worldwide.</p>
              <p class="fw-bold">$15.00</p>
              <button class="btn btn-coffee add-cart" data-name="Premium Coffee Beans" data-price="15.00">Add to cart</button>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 col-sm-6">
          <div class="card text-light h-100">
            <img src="{{ asset('images/powder.jpeg') }}" class="card-img-top" alt="Chocolate Powder">
            <div class="card-body">
              <h5 class="card-title">Chocolate Powder</h5>
              <p class="text-secondary">Premium cocoa blend for a smooth, rich, and indulgent chocolate taste.</p>
              <p class="fw-bold">$8.00</p>
              <button class="btn btn-coffee add-cart" data-name="Chocolate Powder" data-price="8.00">Add to cart</button>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6">
          <div class="card text-light h-100">
            <img src="{{ asset('images/caramel.jpeg') }}" class="card-img-top" alt="Caramel Syrup">
            <div class="card-body">
              <h5 class="card-title">Coffee Caramel Syrup</h5>
              <p class="text-secondary">Rich caramel flavor crafted to perfectly sweeten and elevate your coffee experience.</p>
              <p class="fw-bold">$8.00</p>
              <button class="btn btn-coffee add-cart" data-name="Coffee Caramel Syrup" data-price="8.00">Add to cart</button>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6">
          <div class="card text-light h-100">
            <img src="{{ asset('images/cookies.jpeg') }}" class="card-img-top" alt="Cookies">
            <div class="card-body">
              <h5 class="card-title">Cookies</h5>
              <p class="text-secondary">Freshly baked cookies with a perfect crunch — the ideal companion to your coffee.</p>
              <p class="fw-bold">$5.00</p>
              <button class="btn btn-coffee add-cart" data-name="Cookies" data-price="5.00">Add to cart</button>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6">
          <div class="card text-light h-100">
            <img src="{{ asset('images/syrup.jpeg') }}" class="card-img-top" alt="Vanilla Syrup">
            <div class="card-body">
              <h5 class="card-title">Vanilla Coffee Syrup</h5>
              <p class="text-secondary">Add a sweet vanilla twist to your favorite drink.</p>
              <p class="fw-bold">$6.50</p>
              <button class="btn btn-coffee add-cart" data-name="Vanilla Coffee Syrup" data-price="6.50">Add to cart</button>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6">
          <div class="card text-light h-100">
            <img src="{{ asset('images/blender.jpeg') }}" class="card-img-top" alt="Coffee Blender">
            <div class="card-body">
              <h5 class="card-title">Coffee Blender</h5>
              <p class="text-secondary">High-performance coffee blender for perfectly mixed and creamy beverages every time.</p>
              <p class="fw-bold">$45.00</p>
              <button class="btn btn-coffee add-cart" data-name="Coffee Blender" data-price="45.00">Add to cart</button>
            </div>
          </div>
        </div>
      @endforelse
    </div>
  </div>
</section>

<footer>
  <p>© 2025 Beanix | Designed by BUSHRA AHMAD ☕</p>
</footer>

@push('scripts')
<script>
  const navToggle = document.getElementById("navToggle");
  const navbarNav = document.getElementById("navbarNav");
  navToggle.addEventListener("click", () => { navbarNav.classList.toggle("show"); });

  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  const cartItems = document.getElementById("cart-items");
  const cartTotal = document.getElementById("cart-total");
  const cartCount = document.getElementById("cart-count");
  const message = document.getElementById("message");

  function saveCart() { localStorage.setItem("cart", JSON.stringify(cart)); }
  function updateCart() {
    cartItems.innerHTML = "";
    let total = 0;
    cart.forEach(item => {
      total += item.price;
      const li = document.createElement("li");
      li.textContent = `${item.name} - $${item.price.toFixed(2)}`;
      li.className = "text-light mb-1";
      cartItems.appendChild(li);
    });
    cartTotal.textContent = total.toFixed(2);
    cartCount.textContent = cart.length;
  }

  document.querySelectorAll(".add-cart").forEach(btn => {
    btn.addEventListener("click", () => {
      const name = btn.dataset.name;
      const price = parseFloat(btn.dataset.price);
      cart.push({name, price});
      saveCart();
      updateCart();
      message.style.display = "block";
      setTimeout(() => { message.style.display = "none"; }, 2000);
    });
  });

  document.querySelector(".clear-cart").addEventListener("click", () => {
    cart = [];
    saveCart();
    updateCart();
  });

  updateCart();
</script>
@endpush
@endsection
