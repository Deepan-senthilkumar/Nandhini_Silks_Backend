@extends('frontend.layouts.app')

@section('title', 'Account Dashboard | Nandhini Silks')

@section('content')
    <main class="account-page">
        <div class="page-shell">
            <div class="breadcrumb">
                <a href="{{ url('/') }}">Home</a> &nbsp; / &nbsp; <span>My Account</span>
            </div>

            <div class="account-layout">
                <aside class="account-sidebar">
                    <div class="account-user-info">
                        <div class="account-avatar">
                            <img src="{{ asset('images/user-avatar.svg') }}" alt="User Avatar">
                        </div>
                        <h2 class="account-user-name">John Doe</h2>
                        <p class="account-user-email">john.doe@example.com</p>
                    </div>

                    <ul class="account-nav">
                        <li class="account-nav-item"><a href="{{ url('my-account') }}" class="account-nav-link active"><span>Dashboard</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('my-orders') }}" class="account-nav-link"><span>My Orders</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('my-profile') }}" class="account-nav-link"><span>My Profile</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('my-addresses') }}" class="account-nav-link"><span>Addresses</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('my-reviews') }}" class="account-nav-link"><span>My Reviews</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('wishlist') }}" class="account-nav-link"><span>Wishlist</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('login') }}" class="account-nav-link logout"><span>Logout</span></a></li>
                    </ul>
                </aside>

                <div class="account-content">
                    <div class="dashboard-welcome">
                        <h1 class="dashboard-title">Welcome back, John!</h1>
                        <p class="dashboard-subtitle">From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.</p>
                    </div>

                    <div class="dashboard-stats">
                        <a href="{{ url('my-orders') }}" class="stat-card">
                            <div class="stat-icon">&#128230;</div>
                            <div class="stat-info">
                                <span class="stat-value">12</span>
                                <span class="stat-label">Total Orders</span>
                            </div>
                        </a>
                        <a href="{{ url('wishlist') }}" class="stat-card">
                            <div class="stat-icon">&#10084;&#65039;</div>
                            <div class="stat-info">
                                <span class="stat-value">25</span>
                                <span class="stat-label">In Wishlist</span>
                            </div>
                        </a>
                        <a href="{{ url('my-addresses') }}" class="stat-card">
                            <div class="stat-icon">&#127968;</div>
                            <div class="stat-info">
                                <span class="stat-value">2</span>
                                <span class="stat-label">Saved Addresses</span>
                            </div>
                        </a>
                    </div>

                    <div class="dashboard-grid">
                        <div class="dashboard-section">
                            <div class="section-header">
                                <h3 class="section-title">Recent Orders</h3>
                                <a href="{{ url('my-orders') }}" class="view-all-link">View All</a>
                            </div>
                            <div class="order-list">
                                <a href="{{ url('order-detail') }}" class="order-item-mini">
                                    <img src="{{ asset('images/pro1.png') }}" alt="" class="mini-order-img">
                                    <div class="mini-order-info">
                                        <span class="mini-order-id">#NS7842</span>
                                        <span class="mini-order-date">Oct 12, 2023</span>
                                    </div>
                                    <span class="status-badge status-processing">Processing</span>
                                </a>
                                <a href="{{ url('order-detail') }}" class="order-item-mini">
                                    <img src="{{ asset('images/pro2.png') }}" alt="" class="mini-order-img">
                                    <div class="mini-order-info">
                                        <span class="mini-order-id">#NS7839</span>
                                        <span class="mini-order-date">Sep 28, 2023</span>
                                    </div>
                                    <span class="status-badge status-delivered">Delivered</span>
                                </a>
                            </div>
                        </div>

                        <div class="dashboard-section">
                            <div class="section-header">
                                <h3 class="section-title">Account Details</h3>
                                <a href="{{ url('my-profile') }}" class="view-all-link">Edit Profile</a>
                            </div>
                            <div class="account-summary-mini">
                                <p><strong>Name:</strong> John Doe</p>
                                <p><strong>Email:</strong> john.doe@example.com</p>
                                <p><strong>Phone:</strong> +91 98765 43210</p>
                                <p style="margin-top: 20px; font-size: 13px; color: #777;">Member since: January 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
