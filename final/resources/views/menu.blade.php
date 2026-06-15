@extends('layouts.app')

@section('title', 'Beanix - Menu')

@push('styles')
<style>
  body { padding-top: 80px; }
  h2 { color: #d4a373; margin-bottom: 40px; }
  .card { background-color: #1a1a1a; border: none; border-radius: 15px; transition: transform 0.3s, box-shadow 0.3s; margin: auto; }
  .card:hover { transform: translateY(-10px) scale(1.03); box-shadow: 0 10px 25px rgba(212, 163, 115, 0.3); }
  .card-img-top { height: 200px; object-fit: cover; border-radius: 15px 15px 0 0; }
  .card-title, .card-text, .fw-bold { color: #ccc; }
  .btn-coffee {
    background-color: #d4a373;
    color: #000;
    font-weight: 600;
    padding: 10px 25px;
    border-radius: 30px;
    transition: all 0.3s;
  }
  .btn-coffee:hover { background-color: #fff; color: #000; }
  #navbarNav { display: none; }
  #navbarNav.show { display: flex !important; flex-direction: column; }
  @media(min-width: 992px) { #navbarNav { display: flex !important; flex-direction: row; } }
</style>
@endpush

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('home') }}#home">
      <img src="{{ asset('images/logo.png') }}" width="60" alt="logo">
      Beanix
    </a>
    <button class="navbar-toggler" type="button" id="navToggle">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav me-3">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#about">About</a></li>
        <li class="nav-item"><a class="nav-link active" href="{{ route('menu') }}">Menu</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('products') }}">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#review">Review</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#contact">Contact</a></li>

        <!-- Cart Dropdown -->
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

<!-- Menu Section -->
<section id="menu" class="text-center" style="background-color: #000;">
  <div class="container">
    <h2 class="fw-bold">Our Coffee Menu</h2>
    <div class="row g-4">
      @forelse($coffeeItems ?? [] as $item)
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card h-100 text-light">
            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}" />
            <div class="card-body">
              <h5 class="card-title">{{ $item->name }}</h5>
              <p class="card-text">{{ $item->description }}</p>
              <p class="fw-bold">${{ number_format($item->price, 2) }}</p>
              <button class="btn btn-coffee add-cart" data-name="{{ $item->name }}" data-price="{{ $item->price }}">Add to cart</button>
            </div>
          </div>
        </div>
      @empty
        <!-- Default static items if no database items -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card h-100 text-light">
            <img src="{{ asset('images/espresso.jpeg') }}" class="card-img-top" alt="Espresso" />
            <div class="card-body">
              <h5 class="card-title">Espresso</h5>
              <p class="card-text">Rich and bold, our espresso gives you the true coffee kick you need.</p>
              <p class="fw-bold">$3.50</p>
              <button class="btn btn-coffee add-cart" data-name="Espresso" data-price="3.50">Add to cart</button>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
          <div class="card h-100 text-light">
            <img src="{{ asset('images/cappuccino.jpeg') }}" class="card-img-top" alt="Cappuccino" />
            <div class="card-body">
              <h5 class="card-title">Cappuccino</h5>
              <p class="card-text">Smooth, creamy, and topped with milk foam.</p>
              <p class="fw-bold">$4.00</p>
              <button class="btn btn-coffee add-cart" data-name="Cappuccino" data-price="4.00">Add to cart</button>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
          <div class="card h-100 text-light">
            <img src="{{ asset('images/latte.jpg') }}" class="card-img-top" alt="Latte" />
            <div class="card-body">
              <h5 class="card-title">Latte</h5>
              <p class="card-text">Perfect mix of espresso and milk for a soothing drink.</p>
              <p class="fw-bold">$4.50</p>
              <button class="btn btn-coffee add-cart" data-name="Latte" data-price="4.50">Add to cart</button>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
          <div class="card h-100 text-light">
            <img src="{{ asset('images/mocha.jpeg') }}" class="card-img-top" alt="Mocha">
            <div class="card-body">
              <h5 class="card-title">Mocha</h5>
              <p class="card-text">A delightful blend of chocolate and espresso for a rich, sweet treat.</p>
              <p class="fw-bold">$4.75</p>
              <button class="btn btn-coffee add-cart" data-name="Mocha" data-price="4.75">Add to cart</button>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
          <div class="card h-100 text-light">
            <img src="{{ asset('images/americano.jpeg') }}" class="card-img-top" alt="Americano">
            <div class="card-body">
              <h5 class="card-title">Americano</h5>
              <p class="card-text">Smooth espresso diluted with hot water for a light yet flavorful coffee experience.</p>
              <p class="fw-bold">$3.80</p>
              <button class="btn btn-coffee add-cart" data-name="Americano" data-price="3.80">Add to cart</button>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
          <div class="card h-100 text-light">
            <img src="{{ asset('images/flatwhite.jpeg') }}" class="card-img-top" alt="Flat White">
            <div class="card-body">
              <h5 class="card-title">Flat White</h5>
              <p class="card-text">Creamy microfoam poured over rich espresso for a smooth and velvety taste.</p>
              <p class="fw-bold">$4.20</p>
              <button class="btn btn-coffee add-cart" data-name="Flat White" data-price="4.20">Add to cart</button>
            </div>
          </div>
        </div>
      @endforelse
    </div>
  </div>
</section>

<div id="message" style="position: fixed; top: 50px; right: 20px; background-color: #d4a373; color: #000; padding: 20px 20px; border-radius: 5px; display: none; z-index: 1000;">
  Added to cart successfully!
</div>

<footer>
  <p>© 2025 Beanix | Designed by Aliza ☕</p>
</footer>

@push('scripts')
<script>
  const navToggle = document.getElementById("navToggle");
  const navbarNav = document.getElementById("navbarNav");
  navToggle.addEventListener("click", () => {
    navbarNav.classList.toggle("show");
  });

  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  const cartItems = document.getElementById("cart-items");
  const cartTotal = document.getElementById("cart-total");
  const cartCount = document.getElementById("cart-count");

  document.querySelectorAll(".add-cart").forEach(btn => {
    btn.addEventListener("click", () => {
      const name = btn.dataset.name;
      const price = parseFloat(btn.dataset.price);
      cart.push({name, price});
      saveCart();
      updateCart();
      
      const msg = document.getElementById("message");
      msg.style.display = "block";
      setTimeout(() => { msg.style.display = "none"; }, 2000);
    });
  });

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

  document.querySelector(".clear-cart").addEventListener("click", () => {
    cart = [];
    saveCart();
    updateCart();
  });

  updateCart();
</script>
@endpush
@endsection
