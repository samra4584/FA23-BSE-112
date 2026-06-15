@extends('layouts.app')

@section('title', 'Beanix - Fresh Coffee')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('home') }}#home">
      <img src="{{ asset('images/logo.png') }}" width="60" alt="logo">
      Beanix
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav me-3" id="navbar-links">
        <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('menu') }}">Menu</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('products') }}">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="#review">Review</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
      </ul>

      <!-- Cart Dropdown -->
      <ul class="navbar-nav me-2">
        <li class="nav-item dropdown">
          <a class="nav-link position-relative" href="#" id="navbarCart" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-cart4"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">0</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end p-3 bg-dark text-light" style="min-width:300px; z-index:1050;" aria-labelledby="navbarCart">
            <li><h6 class="text-warning">Your Cart</h6></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <ul class="list-unstyled" id="cart-items" style="max-height:200px; overflow-y:auto;"></ul>
            </li>
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
        <li class="nav-item d-flex align-items-center">
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline-block; margin: 0;">
            @csrf
            <button type="submit" class="btn btn-outline-warning ms-2" id="logout-button" style="cursor: pointer;">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <!-- Hero Section -->
  <section id="home" class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content text-start">
      <h1>FRESH COFFEE IN<br>THE MORNING</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit consequuntur? Et veritatis velit nesciunt odio!</p>
      <a href="{{ route('menu') }}" class="btn btn-coffee">Get It Now</a>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="py-5 position-relative">
    <div class="container position-relative" style="z-index:1;">
      <h2 class="text-center text-uppercase fw-bold mb-5" style="color:#d4a373;">About Us</h2>
      <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
          <div style="background: url('{{ asset('images/about.png') }}') no-repeat center center/cover; height: 400px; border-radius: 10px;"></div>
        </div>
        <div class="col-md-6 text-light">
          <h3 class="fw-bold mb-3">What Makes Our Coffee Special?</h3>
          <p class="text-secondary">At Beanix, we pride ourselves on sourcing the finest coffee beans from around the world. Each cup is brewed to perfection, delivering a rich aroma and bold flavor that invigorates your senses.</p>
          <p class="text-secondary">Our passionate baristas craft every drink with love, ensuring that every sip you take is a moment of pure bliss. From espresso to latte art, we make coffee an unforgettable experience.</p>
          <a href="{{ route('menu') }}" class="btn btn-coffee mt-3">Learn More</a>
        </div>
      </div>
    </div>
    <div style="position:absolute; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.6); z-index:0;"></div>
  </section>

  <!-- Reviews Section -->
  <section id="review" class="py-5 text-center">
    <div class="container">
      <h2 class="fw-bold mb-5">What Our Customers Say</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="review-card">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Reviewer">
            <h5>Emily Johnson</h5>
            <p class="text-secondary">"The best coffee I've ever had! The aroma, taste, and vibe are perfect."</p>
            <div class="text-warning"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="review-card">
            <img src="https://randomuser.me/api/portraits/men/46.jpg" alt="Reviewer">
            <h5>Michael Brown</h5>
            <p class="text-secondary">"Friendly staff and cozy place. Their cappuccino is a must-try!"</p>
            <div class="text-warning"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i></div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="review2-card">
            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Reviewer">
            <h5>Sophia Davis</h5>
            <p class="text-secondary">"Love the ambiance and the latte art. Great spot for coffee lovers!"</p>
            <div class="text-warning"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="py-5 text-center" style="background-color: #111;">
    <div class="container">
      <div class="mx-auto p-4" style="max-width: 500px; background-color: #1a1a1a; border-radius: 15px; box-shadow: 0 0 15px rgba(212,163,115,0.3);">
        <h2 class="fw-bold mb-4" style="color:#d4a373;">Get in Touch</h2>
        <form action="{{ route('contact.submit') }}" method="POST">
          @csrf
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <input type="text" class="form-control" name="name" placeholder="Your Name" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
            <input type="tel" class="form-control" name="phone" placeholder="Your Phone Number" 
                   pattern="03[0-9]{9}" 
                   title="Phone number must be 11 digits and start with 03" 
                   required>
          </div>
          <button type="submit" class="btn btn-coffee w-100">Contact Now</button>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>© 2025 Beanix | Designed by Bushra☕</p>
  </footer>

  <script>
  // Initialize cart on page load - optimized
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', updateCart);
  } else {
    updateCart();
  }

  // Ensure logout form submission works
  (function() {
    function setupLogout() {
      const logoutButton = document.getElementById('logout-button');
      const logoutForm = document.getElementById('logout-form');
      
      if (logoutButton && logoutForm) {
        logoutButton.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          logoutForm.submit();
        });
      }
    }
    
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', setupLogout);
    } else {
      setupLogout();
    }
  })();
  </script>
@endsection
