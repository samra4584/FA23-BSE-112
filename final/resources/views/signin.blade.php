@extends('layouts.app')

@section('title', 'Beanix - Sign In')

@push('styles')
<style>
  body { 
    background-color: #000; 
    color: #fff; 
    font-family: 'Poppins', sans-serif; 
  }
  .form-container { 
    max-width: 400px; 
    margin: 100px auto; 
    padding: 30px; 
    background: #1a1a1a; 
    border-radius: 15px; 
    position: relative;
    box-shadow: 0 0 15px rgba(212,163,115,0.3);
  }
  .form-label {
    color: #fff !important;
  }
  .form-control {
    background-color: #222 !important;
    border: none !important;
    color: #fff !important;
  }
  .form-control::placeholder {
    color: #ffffffb5 !important;
    opacity: 1;
  }
  .form-control:focus {
    background-color: #333 !important;
    border-color: #d4a373 !important;
    box-shadow: none !important;
    color: #ffffffe4 !important;
  }
  .btn-coffee { 
    background-color: #d4a373; 
    color: #000; 
    width: 100%; 
    font-weight: 600;
  }
  .btn-coffee:hover { 
    background-color: #fff; 
    color: #000; 
  }
  .back-arrow {
    position: absolute;
    top: 15px;
    left: 15px;
    font-size: 24px;
    color: #d4a373;
    text-decoration: none;
  }
  .back-arrow:hover {
    color: #fff;
  }
  h2 {
    color: #d4a373;
  }
  .alert {
    border: none;
    border-radius: 8px;
  }
  .alert-danger {
    background-color: rgba(220, 53, 69, 0.2);
    color: #ff6b6b;
  }
  .alert-success {
    background-color: rgba(40, 167, 69, 0.2);
    color: #51cf66;
  }
  .text-secondary {
    color: #aaa !important;
  }
</style>
@endpush

@section('content')
<div class="form-container">
  <a href="{{ route('login') }}" class="back-arrow"><i class="bi bi-arrow-left-circle-fill"></i></a>

  <h2 class="text-center mb-4" style="color: #d4a373;">Sign In</h2>
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <form id="signinForm" action="{{ route('signin.post') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-coffee">Sign In</button>
  </form>
  <p class="mt-3 text-center text-secondary" id="msg"></p>
</div>
@endsection
