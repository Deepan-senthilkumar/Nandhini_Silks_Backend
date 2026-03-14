@extends('frontend.layouts.app')

@section('title', 'My Orders | Nandhini Silks')

@push('styles')
<style>
    .orders-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .order-card {
        background: #fff;
        border: 1px solid #f0f0f0;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 15px;
        border-bottom: 1px solid #f5f5f5;
        margin-bottom: 15px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .order-meta {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .meta-label {
        font-size: 12px;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .meta-value {
        font-size: 14px;
        font-weight: 600;
        color: #333;
    }

    .order-body {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .order-items-preview {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-grow: 1;
    }

    .order-img {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #eee;
    }

    .order-items-count {
        font-size: 13px;
        color: #777;
    }

    .order-actions {
        display: flex;
        gap: 10px;
    }

    .btn-outline {
        padding: 10px 20px;
        border: 1px solid var(--pink);
        color: var(--pink);
        background: #fff;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-outline:hover {
        background: var(--pink);
        color: #fff;
    }

    .btn-action {
        padding: 10px 20px;
        background: #f5f5f5;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #666;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-action:hover {
        background: #eee;
    }

    .payment-status {
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        margin-left: 10px;
    }

    .pay-paid {
        background: #e6fffb;
        color: #08979c;
    }

    .pay-pending {
        background: #fffbe6;
        color: #d48806;
    }

    @media (max-width: 600px) {
        .order-actions {
            width: 100%;
            flex-direction: column;
        }

        .order-actions .btn-outline,
        .order-actions .btn-action {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
    <main class="account-page">
        <div class="page-shell">
            <div class="breadcrumb">
                <a href="{{ url('/') }}">Home</a> &nbsp; / &nbsp; <a href="{{ url('my-account') }}">My Account</a> &nbsp; / &nbsp; <span>My Orders</span>
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
                        <li class="account-nav-item"><a href="{{ url('my-account') }}" class="account-nav-link"><span>Dashboard</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('my-orders') }}" class="account-nav-link active"><span>My Orders</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('my-profile') }}" class="account-nav-link"><span>My Profile</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('my-addresses') }}" class="account-nav-link"><span>Addresses</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('my-reviews') }}" class="account-nav-link"><span>My Reviews</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('wishlist') }}" class="account-nav-link"><span>Wishlist</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('login') }}" class="account-nav-link logout"><span>Logout</span></a></li>
                    </ul>
                </aside>

                <div class="account-content">
                    <div class="section-header" style="margin-bottom: 30px;">
                        <h1 class="section-title" style="font-size: 24px;">My Orders</h1>
                    </div>

                    <div class="orders-container">
                        <div class="order-card">
                            <div class="order-header">
                                <div class="order-meta">
                                    <div class="meta-item">
                                        <span class="meta-label">Order ID</span>
                                        <span class="meta-value">#NS7842</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-label">Date Placed</span>
                                        <span class="meta-value">Oct 12, 2023</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-label">Total Amount</span>
                                        <span class="meta-value">&#8377;7,490 <span class="payment-status pay-paid">Paid</span></span>
                                    </div>
                                </div>
                                <span class="status-badge status-processing">Processing</span>
                            </div>
                            <div class="order-body">
                                <div class="order-items-preview">
                                    <img src="{{ asset('images/pro1.png') }}" alt="" class="order-img">
                                    <span class="order-items-count">+ 2 other items</span>
                                </div>
                                <div class="order-actions">
                                    <a href="{{ url('order-detail') }}" class="btn-outline">View Details</a>
                                    <button class="btn-action">Track Order</button>
                                    <button class="btn-action" style="color: #f5222d;">Cancel Order</button>
                                </div>
                            </div>
                        </div>

                        <div class="order-card">
                            <div class="order-header">
                                <div class="order-meta">
                                    <div class="meta-item">
                                        <span class="meta-label">Order ID</span>
                                        <span class="meta-value">#NS7839</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-label">Date Placed</span>
                                        <span class="meta-value">Sep 28, 2023</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-label">Total Amount</span>
                                        <span class="meta-value">&#8377;4,290 <span class="payment-status pay-paid">Paid</span></span>
                                    </div>
                                </div>
                                <span class="status-badge status-delivered">Delivered</span>
                            </div>
                            <div class="order-body">
                                <div class="order-items-preview">
                                    <img src="{{ asset('images/pro2.png') }}" alt="" class="order-img">
                                </div>
                                <div class="order-actions">
                                    <a href="{{ url('order-detail') }}" class="btn-outline">View Details</a>
                                    <button class="btn-action">Buy it Again</button>
                                    <button class="btn-action">Return / Refund</button>
                                </div>
                            </div>
                        </div>

                        <div class="order-card">
                            <div class="order-header">
                                <div class="order-meta">
                                    <div class="meta-item">
                                        <span class="meta-label">Order ID</span>
                                        <span class="meta-value">#NS7835</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-label">Date Placed</span>
                                        <span class="meta-value">Sep 15, 2023</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-label">Total Amount</span>
                                        <span class="meta-value">&#8377;2,890 <span class="payment-status pay-pending">Refunded</span></span>
                                    </div>
                                </div>
                                <span class="status-badge status-cancelled">Cancelled</span>
                            </div>
                            <div class="order-body">
                                <div class="order-items-preview">
                                    <img src="{{ asset('images/pro3.png') }}" alt="" class="order-img">
                                </div>
                                <div class="order-actions">
                                    <a href="{{ url('order-detail') }}" class="btn-outline">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
