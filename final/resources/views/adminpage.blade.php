@extends('layouts.app')

@section('title', 'Beanix - Admin Dashboard')

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
    --success: #28a745;
    --warning: #ffc107;
    --danger: #dc3545;
    --info: #17a2b8;
  }

  [data-theme="light"] {
    --bg-primary: #f8f9fa;
    --bg-secondary: #ffffff;
    --bg-card: #ffffff;
    --text-primary: #1a1a1a;
    --text-secondary: #6c757d;
    --border: #dee2e6;
  }

  body { 
    background: var(--bg-primary);
    color: var(--text-primary); 
    font-family: 'Poppins', sans-serif; 
    min-height: 100vh;
    transition: background 0.3s, color 0.3s;
  }
  
  .admin-navbar {
    background: linear-gradient(135deg, var(--accent) 0%, var(--accent-hover) 100%);
    padding: 1rem 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    margin-bottom: 2rem;
    position: sticky;
    top: 0;
    z-index: 1000;
  }
  
  .admin-navbar .navbar-brand {
    color: #000 !important;
    font-weight: bold;
    font-size: 1.5rem;
  }
  
  .admin-navbar .nav-link {
    color: #000 !important;
    font-weight: 500;
    margin: 0 0.5rem;
    transition: all 0.3s;
    border-radius: 5px;
  }
  
  .admin-navbar .nav-link:hover {
    color: #fff !important;
    background: rgba(0,0,0,0.1);
  }

  .theme-toggle {
    background: rgba(0,0,0,0.1);
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
  }

  .theme-toggle:hover {
    background: rgba(0,0,0,0.2);
    transform: scale(1.1);
  }
  
  .dashboard-container {
    padding: 2rem;
    max-width: 1600px;
    margin: 0 auto;
  }
  
  .stats-card {
    background: var(--bg-card);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1rem;
    box-shadow: 0 3px 10px rgba(0,0,0,0.12);
    border: 1px solid var(--border);
    transition: transform 0.2s, box-shadow 0.2s;
    height: 100%;
  }
  
  .stats-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 14px rgba(212, 163, 115, 0.25);
  }
  
  .stats-card .stat-icon {
    font-size: 2rem;
    color: var(--accent);
    margin-bottom: 0.35rem;
  }
  
  .stats-card .stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--accent);
    margin: 0.35rem 0;
  }
  
  .stats-card .stat-label {
    color: var(--text-secondary);
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.8px;
  }

  .stats-card .stat-change {
    font-size: 0.85rem;
    margin-top: 0.5rem;
  }

  .stats-card .stat-change.positive {
    color: var(--success);
  }

  .stats-card .stat-change.negative {
    color: var(--danger);
  }
  
  .card { 
    background: var(--bg-card);
    border-radius: 15px;
    border: 1px solid var(--border);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s;
    color: var(--text-primary);
  }
  
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(212, 163, 115, 0.2);
  }
  
  .btn-coffee { 
    background: linear-gradient(135deg, var(--accent) 0%, var(--accent-hover) 100%);
    color: #000;
    border: none;
    font-weight: 600;
    transition: all 0.3s;
  }
  
  .btn-coffee:hover { 
    background: linear-gradient(135deg, var(--accent-hover) 0%, var(--accent) 100%);
    color: #000;
    transform: scale(1.05);
  }
  
  .section-title { 
    margin-top: 3rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 3px solid var(--accent);
    display: inline-block;
    font-size: 1.5rem;
    font-weight: bold;
  }
  
  .form-control, .form-select {
    background-color: var(--bg-secondary);
    border: 1px solid var(--border);
    color: var(--text-primary);
  }
  
  .form-control:focus, .form-select:focus {
    background-color: var(--bg-secondary);
    border-color: var(--accent);
    color: var(--text-primary);
    box-shadow: 0 0 0 0.2rem rgba(212, 163, 115, 0.25);
  }
  
  .form-label {
    color: var(--accent);
    font-weight: 500;
  }
  
  .alert-success {
    background: linear-gradient(135deg, var(--success) 0%, #20c997 100%);
    border: none;
    border-radius: 10px;
    color: #fff;
    padding: 1rem;
    margin-bottom: 2rem;
  }

  .table {
    color: var(--text-primary);
    background: var(--bg-secondary);
  }
  
  .table thead {
    background: var(--bg-card);
    color: var(--text-primary);
  }
  
  .table thead th {
    background: var(--bg-card) !important;
    border-color: var(--border) !important;
    color: var(--text-primary) !important;
    font-weight: 600;
  }
  
  .table tbody tr {
    background: var(--bg-secondary) !important;
    border-bottom: 1px solid var(--border) !important;
    transition: background 0.3s;
  }
  
  .table tbody tr:hover {
    background: var(--bg-card) !important;
  }
  
  .table td, .table th {
    background: var(--bg-secondary) !important;
    border-color: var(--border) !important;
    padding: 0.85rem;
    color: var(--text-primary) !important;
  }
  
  .accent-title {
    color: var(--accent) !important;
  }

  .badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
  }

  .badge-success,
  .badge-warning {
    background: var(--accent);
    color: #000;
  }

  .badge-danger {
    background: var(--danger);
    color: #fff;
  }

  .badge-info {
    background: var(--info);
    color: #fff;
  }
  
  .edit-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.8);
    z-index: 9999;
    overflow-y: auto;
  }
  
  .edit-modal-content {
    background: var(--bg-card);
    margin: 2rem auto;
    padding: 2rem;
    border-radius: 15px;
    max-width: 600px;
    border: 2px solid var(--accent);
    color: var(--text-primary);
  }
  
  .close-modal {
    color: var(--accent);
    font-size: 2rem;
    cursor: pointer;
    float: right;
  }
  
  .close-modal:hover {
    color: var(--text-primary);
  }

  .tabs {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    border-bottom: 2px solid var(--border);
  }

  .tab-btn {
    padding: 0.75rem 1.5rem;
    background: transparent;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    border-bottom: 3px solid transparent;
    transition: all 0.3s;
    font-weight: 500;
  }

  .tab-btn.active {
    color: var(--accent);
    border-bottom-color: var(--accent);
  }

  .tab-btn:hover {
    color: var(--accent);
  }

  .tab-content {
    display: none;
  }

  .tab-content.active {
    display: block;
  }
</style>
@endpush

@section('content')
<!-- Admin Navbar -->
<nav class="admin-navbar navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
      <i class="bi bi-cup-hot-fill"></i> Beanix Admin
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}" target="_blank">
            <i class="bi bi-house"></i> View Site
          </a>
        </li>
        <li class="nav-item">
          <button class="theme-toggle nav-link" id="themeToggle" title="Toggle Dark/Light Mode">
            <i class="bi bi-moon-fill" id="themeIcon"></i>
          </button>
        </li>
        <li class="nav-item">
          <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="nav-link btn btn-link" style="border: none; background: none;">
              <i class="bi bi-box-arrow-right"></i> Logout
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="dashboard-container">
  <h1 class="mb-4 text-center">
    <i class="bi bi-speedometer2"></i> Admin Dashboard
  </h1>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

  <!-- Statistics Cards -->
  <div class="row g-3 mb-4">
    <div class="col-md-6 col-lg-3">
      <div class="stats-card text-center">
        <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
        <div class="stat-number">{{ $users->count() ?? 0 }}</div>
        <div class="stat-label">Total Users</div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="stats-card text-center">
        <div class="stat-icon"><i class="bi bi-cart-check-fill"></i></div>
        <div class="stat-number">{{ $orders->count() ?? 0 }}</div>
        <div class="stat-label">Pending Orders</div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="stats-card text-center">
        <div class="stat-icon"><i class="bi bi-cup-hot-fill"></i></div>
        <div class="stat-number">{{ $menus->count() ?? 0 }}</div>
        <div class="stat-label">Menu Items</div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="stats-card text-center">
        <div class="stat-icon"><i class="bi bi-box-seam-fill"></i></div>
        <div class="stat-number">{{ $products->count() ?? 0 }}</div>
        <div class="stat-label">Products</div>
      </div>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="stats-card text-center">
        <div class="stat-icon"><i class="bi bi-currency-dollar"></i></div>
        <div class="stat-number">${{ number_format($totalRevenue ?? 0, 2) }}</div>
        <div class="stat-label">Total Revenue</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="stats-card text-center">
        <div class="stat-icon"><i class="bi bi-calendar-day"></i></div>
        <div class="stat-number">${{ number_format($todayRevenue ?? 0, 2) }}</div>
        <div class="stat-label">Today's Revenue</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="stats-card text-center">
        <div class="stat-icon"><i class="bi bi-calendar-month"></i></div>
        <div class="stat-number">${{ number_format($monthRevenue ?? 0, 2) }}</div>
        <div class="stat-label">This Month</div>
      </div>
    </div>
  </div>

  <!-- Tabs for Tables -->
  <div class="tabs">
    <button class="tab-btn active" data-tab="orders">
      <i class="bi bi-cart"></i> Orders
    </button>
    <button class="tab-btn" data-tab="users">
      <i class="bi bi-people"></i> Users
    </button>
    <button class="tab-btn" data-tab="products">
      <i class="bi bi-box-seam"></i> Products & Menu
    </button>
  </div>

  <!-- Orders Tab -->
  <div id="orders-tab" class="tab-content active">
    <div class="card p-4 mb-4">
      <h4 class="mb-4 accent-title"><i class="bi bi-cart-check"></i> Pending Orders</h4>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Customer</th>
              <th>Email</th>
              <th>Items</th>
              <th>Total</th>
              <th>Status</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($orders ?? [] as $order)
              <tr>
                <td><strong>#{{ $order->id }}</strong></td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->items->count() }} items</td>
                <td><strong>${{ number_format($order->total, 2) }}</strong></td>
                <td><span class="badge badge-warning">Pending</span></td>
                <td>{{ $order->created_at->format('M d, Y') }}</td>
                <td>
                  <form action="{{ route('admin.orders.complete', $order->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">
                      <i class="bi bi-check-circle"></i> Complete
                    </button>
                  </form>
                  <a class="btn btn-info btn-sm" href="{{ route('admin.orders.show', $order->id) }}">
                    <i class="bi bi-eye"></i> View
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center">No pending orders</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="card p-4">
      <h4 class="mb-4 accent-title"><i class="bi bi-check-circle"></i> Completed Orders</h4>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Customer</th>
              <th>Email</th>
              <th>Items</th>
              <th>Total</th>
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @forelse($completedOrders ?? [] as $order)
              <tr>
                <td><strong>#{{ $order->id }}</strong></td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->items->count() }} items</td>
                <td><strong>${{ number_format($order->total, 2) }}</strong></td>
                <td><span class="badge badge-success">Completed</span></td>
                <td>{{ $order->created_at->format('M d, Y') }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center">No completed orders</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Users Tab -->
  <div id="users-tab" class="tab-content">
    <div class="row g-3">
      <div class="col-lg-4">
        <div class="card p-4 h-100">
          <h4 class="mb-4 accent-title"><i class="bi bi-person-plus"></i> Add User</h4>
          <form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" name="name" class="form-control" placeholder="Full name" required>
    </div>
    <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" placeholder="user@example.com" required>
    </div>
    <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Min 6 characters" required>
            </div>
            <button type="submit" class="btn btn-coffee w-100">
              <i class="bi bi-save"></i> Create User
            </button>
          </form>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card p-4 h-100">
          <h4 class="mb-4 accent-title"><i class="bi bi-people"></i> Users</h4>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Registered</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse($users ?? [] as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                      @if($user->email_verified_at)
                        <span class="badge badge-success">Verified</span>
                      @else
                        <span class="badge badge-warning">Unverified</span>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center">No users found</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Products & Menu Tab -->
  <div id="products-tab" class="tab-content">
    <!-- Add Product/Menu Form -->
    <div class="card p-4 mb-4">
      <h4 class="text-center mb-4">
        <i class="bi bi-plus-circle"></i> Add New Item
      </h4>
  <form id="product-form" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="product-name" class="form-label">Item Name</label>
            <input type="text" class="form-control" id="product-name" name="name" placeholder="Enter item name" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="product-price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="product-price" name="price" placeholder="0.00" required>
    </div>
    </div>
    <div class="mb-3">
          <label for="product-desc" class="form-label">Description</label>
          <textarea class="form-control" id="product-desc" name="description" rows="3" placeholder="Enter description" required></textarea>
    </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="product-type" class="form-label">Category</label>
      <select class="form-select" id="product-type" name="type" required>
              <option value="coffee">☕ Coffee (Menu)</option>
              <option value="product">🛍️ Product</option>
      </select>
    </div>
          <div class="col-md-6 mb-3">
            <label for="product-img" class="form-label">Image</label>
      <input type="file" class="form-control" id="product-img" name="image" accept="image/*" required>
    </div>
        </div>
        <button type="submit" class="btn btn-coffee w-100">
          <i class="bi bi-plus-circle"></i> Add Item
        </button>
  </form>
</div>

    <!-- Menu Items -->
    <div class="card p-4 mb-4">
      <h4 class="mb-4"><i class="bi bi-cup-hot"></i> Menu Items</h4>
      <div class="row g-3">
        @forelse($menus ?? [] as $menu)
          <div class="col-md-4 col-lg-3">
      <div class="card p-3 text-light">
              @if($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}" class="img-fluid rounded mb-2" style="height:150px; object-fit:cover; width:100%;">
        @endif
              <h6 class="text-warning">{{ $menu->name }}</h6>
              <p class="mb-1 fw-bold text-success">${{ number_format($menu->price, 2) }}</p>
              <div class="d-flex gap-2">
                <button class="btn btn-warning btn-sm flex-fill edit-menu-btn" data-id="{{ $menu->id }}" data-type="menu">
                  <i class="bi bi-pencil"></i>
                </button>
                <form action="{{ route('admin.menus.delete', $menu->id) }}" method="POST" class="flex-fill">
            @csrf
            @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Delete?')">
                    <i class="bi bi-trash"></i>
                  </button>
          </form>
        </div>
      </div>
    </div>
  @empty
          <div class="col-12">
            <p class="text-center text-muted">No menu items yet.</p>
          </div>
  @endforelse
</div>
        </div>
        
    <!-- Products -->
    <div class="card p-4">
      <h4 class="mb-4"><i class="bi bi-box-seam"></i> Products</h4>
      <div class="row g-3">
        @forelse($products ?? [] as $product)
          <div class="col-md-4 col-lg-3">
            <div class="card p-3 text-light">
              @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded mb-2" style="height:150px; object-fit:cover; width:100%;">
              @endif
              <h6 class="text-warning">{{ $product->name }}</h6>
              <p class="mb-1 fw-bold text-success">${{ number_format($product->price, 2) }}</p>
              <div class="d-flex gap-2">
                <button class="btn btn-warning btn-sm flex-fill edit-btn" data-id="{{ $product->id }}" data-type="product">
                  <i class="bi bi-pencil"></i>
                </button>
                <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="flex-fill">
          @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Delete?')">
                    <i class="bi bi-trash"></i>
                  </button>
        </form>
              </div>
      </div>
    </div>
  @empty
    <div class="col-12">
            <p class="text-center text-muted">No products yet.</p>
    </div>
  @endforelse
</div>
            </div>
          </div>
        </div>
        
<!-- Edit Modal -->
<div id="editModal" class="edit-modal">
  <div class="edit-modal-content">
    <span class="close-modal">&times;</span>
    <h3 class="mb-4 text-warning">Edit Item</h3>
    <form id="editForm" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <input type="hidden" id="edit-id" name="id">
      <div class="mb-3">
        <label for="edit-name" class="form-label">Name</label>
        <input type="text" class="form-control" id="edit-name" name="name" required>
      </div>
      <div class="mb-3">
        <label for="edit-price" class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" id="edit-price" name="price" required>
      </div>
      <div class="mb-3">
        <label for="edit-description" class="form-label">Description</label>
        <textarea class="form-control" id="edit-description" name="description" rows="3" required></textarea>
      </div>
      <div class="mb-3">
        <label for="edit-image" class="form-label">Image (Leave empty to keep current)</label>
        <input type="file" class="form-control" id="edit-image" name="image" accept="image/*">
      </div>
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-coffee flex-fill">
          <i class="bi bi-save"></i> Update
        </button>
        <button type="button" class="btn btn-secondary flex-fill close-modal-btn">Cancel</button>
    </div>
    </form>
    </div>
</div>

@push('scripts')
<script>
  // Theme Toggle
  const themeToggle = document.getElementById('themeToggle');
  const themeIcon = document.getElementById('themeIcon');
  const currentTheme = localStorage.getItem('theme') || 'dark';

  document.documentElement.setAttribute('data-theme', currentTheme);
  updateThemeIcon(currentTheme);

  themeToggle.addEventListener('click', () => {
    const current = document.documentElement.getAttribute('data-theme');
    const newTheme = current === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateThemeIcon(newTheme);
  });

  function updateThemeIcon(theme) {
    if (theme === 'dark') {
      themeIcon.className = 'bi bi-moon-fill';
    } else {
      themeIcon.className = 'bi bi-sun-fill';
    }
  }

  // Tab Switching
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const tabName = btn.dataset.tab;
      
      // Update buttons
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      
      // Update content
      document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
      document.getElementById(`${tabName}-tab`).classList.add('active');
    });
  });

  // Edit Modal
  const editModal = document.getElementById('editModal');
  const editForm = document.getElementById('editForm');
  const closeModal = document.querySelector('.close-modal');
  const closeModalBtn = document.querySelector('.close-modal-btn');
  
  document.querySelectorAll('.edit-btn, .edit-menu-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const id = this.dataset.id;
      const type = this.dataset.type;
      
      fetch(`/admin/${type === 'product' ? 'products' : 'menus'}/${id}`)
        .then(response => response.json())
        .then(data => {
          document.getElementById('edit-id').value = data.id;
          document.getElementById('edit-name').value = data.name;
          document.getElementById('edit-price').value = data.price;
          document.getElementById('edit-description').value = data.description;
          editForm.action = `/admin/${type === 'product' ? 'products' : 'menus'}/${id}`;
          editModal.style.display = 'block';
        })
        .catch(error => {
          alert('Error loading item data');
          console.error(error);
      });
    });
  });
  
  closeModal.addEventListener('click', () => {
    editModal.style.display = 'none';
  });
  
  closeModalBtn.addEventListener('click', () => {
    editModal.style.display = 'none';
  });

  // View Order Details
  document.querySelectorAll('.view-order-details').forEach(btn => {
    btn.addEventListener('click', function() {
      const orderId = this.dataset.orderId;
      // You can implement a modal or expand row here
      alert('Order details for #' + orderId);
    });
  });
</script>
@endpush
@endsection
