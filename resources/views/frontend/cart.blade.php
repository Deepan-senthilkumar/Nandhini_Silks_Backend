@extends('frontend.layouts.app')

@section('title', 'Shopping Cart | Nandhini Silks')

@section('content')
    <main class="cart-page">
        <div class="page-shell">
            <div class="breadcrumb">
                <a href="{{ url('/') }}">Home</a> &nbsp; / &nbsp; <span>Shopping Cart</span>
            </div>

            <h1 class="auth-title" style="text-align: left; margin-bottom: 40px;">Your Shopping Cart</h1>

            <div class="cart-grid">
                <div class="cart-items-list">
                    <div class="cart-header-row"
                        style="display: grid; grid-template-columns: 100px 1fr 120px 150px 40px; gap: 20px; padding-bottom: 15px; border-bottom: 2px solid #eee; margin-bottom: 10px; font-weight: 700; color: #333;">
                        <span>Product</span>
                        <span style="padding-left: 20px;">Details</span>
                        <span style="margin-left: -15px;">Unit Price</span>
                        <span>Quantity</span>
                        <span></span>
                    </div>

                    <div class="cart-item-row" id="item-1">
                        <div class="cart-item-img">
                            <img src="{{ asset('images/product_detail.png') }}" alt="Royal Gold Silk Saree">
                        </div>
                        <div class="cart-item-info">
                            <h3>Royal Gold Handloom Silk Saree</h3>
                            <div class="cart-item-variant"><span class="swatch-small" style="background:#D4AF37;"></span>
                                Gold | Size: Standard (6.2m)</div>
                            <button class="save-for-later">Save for later</button>
                        </div>
                        <div class="cart-item-price">₹7,490</div>
                        <div class="quantity-picker">
                            <button class="qty-btn" onclick="updateCartQty('item-1', -1)">−</button>
                            <input type="text" class="qty-input" value="1" readonly>
                            <button class="qty-btn" onclick="updateCartQty('item-1', 1)">+</button>
                        </div>
                        <button class="remove-item" onclick="removeItem('item-1')" aria-label="Remove item">×</button>
                    </div>

                    <div class="cart-item-row" id="item-2">
                        <div class="cart-item-img">
                            <img src="{{ asset('images/pro1.png') }}" alt="Pure Silk Saree">
                        </div>
                        <div class="cart-item-info">
                            <h3>Emerald Green Silk Saree</h3>
                            <div class="cart-item-variant"><span class="swatch-small" style="background:#1B4D3E;"></span>
                                Emerald Green | Size: Standard (6.2m)</div>
                            <button class="save-for-later">Save for later</button>
                        </div>
                        <div class="cart-item-price">₹8,500</div>
                        <div class="quantity-picker">
                            <button class="qty-btn" onclick="updateCartQty('item-2', -1)">−</button>
                            <input type="text" class="qty-input" value="1" readonly>
                            <button class="qty-btn" onclick="updateCartQty('item-2', 1)">+</button>
                        </div>
                        <button class="remove-item" onclick="removeItem('item-2')" aria-label="Remove item">×</button>
                    </div>
                </div>

                <aside class="cart-summary">
                    <h2 class="summary-title">Order Summary</h2>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="subtotalDisp">₹15,990</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>FREE</span>
                    </div>
                    <div class="summary-row">
                        <span>Estimated Tax (GST 5%)</span>
                        <span id="taxDisp">₹800</span>
                    </div>
                    <div class="summary-row" style="color: #2e7d32; font-weight: 600;">
                        <span>Coupon Discount</span>
                        <span id="discountDisp">-₹0</span>
                    </div>

                    <div class="coupon-section">
                        <p style="font-size: 14px; font-weight: 600; color: #333;">Have a coupon code?</p>
                        <div class="coupon-input-group">
                            <input type="text" class="coupon-input" placeholder="Promo code" id="couponInput">
                            <button class="btn-apply-coupon" onclick="applyCoupon()">Apply</button>
                        </div>
                        <div class="applied-coupons" id="appliedCoupons" style="display: none;">
                            <div class="coupon-tag">
                                <span id="couponName">NANDHINI10</span>
                                <span class="remove-coupon" onclick="removeCoupon()">×</span>
                            </div>
                        </div>
                    </div>

                    <div class="summary-total">
                        <span>Total</span>
                        <span id="totalDisp">₹16,790</span>
                    </div>

                    <div class="cart-footer-btns">
                        <a href="{{ url('checkout') }}" class="btn-checkout"
                            style="width: 100%; text-decoration: none; text-align: center;">Proceed to Checkout</a>
                        <a href="{{ url('sarees') }}" class="btn-continue-shopping">Continue Shopping</a>
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        function updateCartQty(id, val) {
            const row = document.getElementById(id);
            const input = row.querySelector('.qty-input');
            let current = parseInt(input.value);
            current += val;
            if (current < 1) current = 1;
            input.value = current;
        }

        function removeItem(id) {
            const row = document.getElementById(id);
            row.style.opacity = '0';
            setTimeout(() => {
                row.remove();
            }, 300);
        }

        function applyCoupon() {
            const input = document.getElementById('couponInput');
            const applied = document.getElementById('appliedCoupons');
            const couponName = document.getElementById('couponName');
            const discountDisp = document.getElementById('discountDisp');
            const totalDisp = document.getElementById('totalDisp');

            if (input.value.trim() !== "") {
                couponName.textContent = input.value.toUpperCase();
                applied.style.display = 'block';
                discountDisp.textContent = '-₹500';
                totalDisp.textContent = '₹16,290';
                input.value = "";
            }
        }

        function removeCoupon() {
            document.getElementById('appliedCoupons').style.display = 'none';
            document.getElementById('discountDisp').textContent = '-₹0';
            document.getElementById('totalDisp').textContent = '₹16,790';
        }
    </script>
@endpush
