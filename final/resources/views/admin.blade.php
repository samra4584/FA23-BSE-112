@extends('layouts.app')

@section('title', 'Beanix - Admin Login')

@push('styles')
<style>
  body { 
    background-color: #000; 
    color: #fff; 
    font-family: 'Poppins', sans-serif; 
    display: flex; 
    justify-content: center; 
    align-items: center; 
    height: 100vh; 
  }
  .login-box { 
    background-color: #1a1a1a; 
    padding: 30px; 
    border-radius: 15px; 
    width: 350px; 
    position: relative;
    box-shadow: 0 0 15px rgba(212,163,115,0.3);
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
    font-size: 1.5rem;
    color: #d4a373;
    text-decoration: none;
  }
  .back-arrow:hover {
    color: #fff;
  }
  h3 {
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
</style>
@endpush

@section('content')
<div class="login-box">
  <a href="{{ route('login') }}" class="back-arrow"><i class="bi bi-arrow-left-circle-fill"></i></a>

  <h3 class="text-center mb-4">Admin Login</h3>
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif
  <form id="admin-login-form" action="{{ route('admin.login.post') }}" method="POST">
    @csrf
    <div class="mb-3">
      <input type="text" class="form-control" id="admin-username" name="username" placeholder="Username" required>
    </div>
    <div class="mb-3">
      <input type="password" class="form-control" id="admin-password" name="password" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-coffee">Login</button>
  </form>
  <p class="mt-2 text-center" id="login-msg"></p>
</div>
@endsection
