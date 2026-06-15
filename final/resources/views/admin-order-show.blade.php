@extends('layouts.app')

@section('title', 'Order Details')

@push('styles')
<style>
  :root {
    --bg-primary: #1a1a1a;
    --bg-secondary: #2d2d2d;
    --bg-card: #2d2d2d;
    --text-primary: #ffffff;
    --text-secondary: #aaaaaa;
    --accent: #d4a373;
    --accent-hover: #c49360;
    --border: #3d3d3d;
  }

  body {
    background: var(--bg-primary);
    color: var(--text-primary);
    font-family: 'Poppins', sans-serif;
  }

  .order-container {
    max-width: 1100px;
    margin: 2rem auto;
    padding: 1.5rem;
    color: var(--text-primary);
  }

  .card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    margin-bottom: 1.25rem;
  }

  .card-header {
    background: var(--bg-card);
    border-bottom: 1px solid var(--border);
    color: var(--accent);
    font-weight: 700;
  }

  .card-body {
    padding: 1.25rem 1.5rem;
    color: var(--text-primary);
  }

  .table {
    color: var(--text-primary);
    background: var(--bg-secondary);
  }

  .table thead th {
    background: var(--bg-card) !important;
    border-color: var(--border) !important;
    color: var(--text-primary) !important;
  }

  .table tbody tr {
    background: var(--bg-secondary) !important;
    border-bottom: 1px solid var(--border) !important;
  }

  .table td, .table th {
    background: var(--bg-secondary) !important;
    border-color: var(--border) !important;
    color: var(--text-primary) !important;
  }

  .card-body strong,
  .card-body span,
  .card-body div {
    color: var(--text-primary);
  }

  .btn-coffee {
    background: linear-gradient(135deg, var(--accent) 0%, var(--accent-hover) 100%);
    color: #000;
    border: none;
    font-weight: 600;
  }

  .btn-coffee:hover {
    background: linear-gradient(135deg, var(--accent-hover) 0%, var(--accent) 100%);
    color: #000;
  }

  .badge-accent {
    background: var(--accent);
    color: #000;
    border-radius: 999px;
    padding: 0.35rem 0.8rem;
    font-weight: 600;
  }
</style>
@endpush

@section('content')
<div class="order-container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h2 class="mb-1" style="color: var(--accent);">Order #{{ $order->id }}</h2>
      <div class="text-secondary">Placed on {{ $order->created_at->format('M d, Y H:i') }}</div>
    </div>
    <div class="d-flex gap-2">
      <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light">Back</a>
      <span class="badge-accent">{{ ucfirst($order->status) }}</span>
    </div>
  </div>

  <div class="card">
    <div class="card-header">Customer Details</div>
    <div class="card-body">
      <div class="row mb-2">
        <div class="col-md-6">
          <strong>Name:</strong> {{ $order->customer_name }}
        </div>
        <div class="col-md-6">
          <strong>Email:</strong> {{ $order->email }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-6">
          <strong>Phone:</strong> {{ $order->phone }}
        </div>
        <div class="col-md-6">
          <strong>Delivery:</strong> {{ ucfirst($order->delivery_method) }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <strong>Address:</strong><br>
          {{ $order->address }}
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">Order Items</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Item</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            @foreach($order->items as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->product_name }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">Summary</div>
    <div class="card-body">
      <div class="d-flex justify-content-between mb-2">
        <span>Subtotal</span>
        <span>${{ number_format($order->subtotal, 2) }}</span>
      </div>
      <div class="d-flex justify-content-between mb-2">
        <span>Delivery</span>
        <span>${{ number_format($order->delivery_cost, 2) }}</span>
      </div>
      <hr>
      <div class="d-flex justify-content-between fw-bold" style="color: var(--accent);">
        <span>Total</span>
        <span>${{ number_format($order->total, 2) }}</span>
      </div>
    </div>
  </div>
</div>
@endsection

