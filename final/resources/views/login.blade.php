@extends('layouts.app')

@section('title', 'Beanix - Sign In Options')

@push('styles')
<style>
  body { 
    background-color: #000; 
    height: 100vh; 
    display: flex; 
    justify-content: center; 
    align-items: center; 
    color: #fff; 
    font-family: 'Poppins', sans-serif; 
    margin: 0; 
  }
  .card {
    background-color: #1a1a1a;
    padding: 40px 30px;
    border-radius: 15px;
    box-shadow: 0 0 15px rgba(212,163,115,0.3);
    text-align: center;
    width: 350px;
  }
  h2 {
    color: #d4a373;
    margin-bottom: 30px;
  }
  .btn-choice {
    width: 100%;
    margin: 10px 0;
    padding: 10px 0;
    font-weight: bold;
    text-decoration: none;
    display: inline-block;
    text-align: center;
    border-radius: 8px;
    transition: 0.3s;
  }
  .btn-warning {
    background-color: #d4a373 !important;
    color: #000 !important;
    border: none !important;
  }
  .btn-warning:hover {
    background-color: #fff !important;
    color: #000 !important;
  }
  .btn-outline-warning {
    border: 2px solid #d4a373 !important;
    color: #d4a373 !important;
    background-color: transparent !important;
  }
  .btn-outline-warning:hover {
    background-color: #d4a373 !important;
    color: #000 !important;
  }
</style>
@endpush

@section('content')
<div class="card">
  <h2>Sign In As</h2>
  <a href="{{ route('signin') }}" class="btn-choice btn-warning">Customer</a>
  <a href="{{ route('admin.login') }}" class="btn-choice btn-outline-warning">Admin</a>
</div>
@endsection
