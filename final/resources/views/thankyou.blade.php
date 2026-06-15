@extends('layouts.app')

@section('title', 'Beanix - Thank You')

@push('styles')
<style>
  body { 
    background-color: #000; 
    color: #fff; 
    display: flex; 
    flex-direction: column; 
    justify-content: center; 
    align-items: center; 
    min-height: 100vh; 
    text-align: center; 
  }
</style>
@endpush

@section('content')
<div class="p-5 bg-black rounded shadow" style="max-width: 500px;">
  <i class="bi bi-check-circle-fill text-success fs-1 mb-3"></i>
  <h2 class="text-warning mb-3">Thank You!</h2>
  <p class="lead">
    @if(isset($order) && !empty($order))
      Thank you {{ $order['name'] }}! Your order will be delivered to {{ $order['address'] }}.
    @else
      Thank you! Your order has been placed successfully.
    @endif
  </p>
  <p class="mt-3">You will receive your order in <strong>3–4 days</strong>.</p>
  @if(isset($order) && !empty($order))
    <p class="fw-bold mt-2">Total Amount: <span>${{ $order['total'] ?? '0.00' }}</span></p>
  @endif
  <a href="{{ route('home') }}" class="btn btn-coffee mt-4 w-100">Return to Home</a>
</div>

@push('scripts')
<script>
  // Clear cart after showing message
  localStorage.removeItem("cart");
</script>
@endpush
@endsection
