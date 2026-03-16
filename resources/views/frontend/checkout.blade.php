@extends('frontend.layouts.app')

@section('title', 'Checkout | Nandhini Silks')

@push('styles')
<style>
    .checkout-step-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 800px;
      margin: 0 auto 40px auto;
      background: #fff;
      padding: 20px 40px;
      border-radius: 50px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }
    .step-item {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 600;
      color: #999;
      flex: 1;
      justify-content: center;
      position: relative;
    }
    .step-item:not(:last-child)::after {
        content: "";
        position: absolute;
        right: -20px;
        top: 50%;
        width: 15px;
        height: 2px;
        background: #eee;
    }
    .payment-option-v3 {
      border: 1px solid #ddd;
      border-radius: 12px;
      padding: 20px;
      display: flex;
      align-items: center;
      gap: 15px;
      background: #fff;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .payment-option-v3.active {
      border-color: var(--pink);
      background: #fff9fa;
    }
    .step-item.active {
        color: var(--pink);
    }
    .step-item.active .step-num {
        background: var(--pink);
        color: #fff;
    }
    .step-num {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #eee;
        color: #999;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }
    .step-item.completed {
        color: #2e7d32;
    }
    .completed .step-num {
        background: #e8f5e9;
        color: #2e7d32;
    }
    .address-card {
        border: 1px solid #eee;
        border-radius: 12px;
        padding: 15px;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fafafa;
    }
    .address-card.active {
        border-color: var(--pink);
        background: #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .address-label-badge {
        font-size: 10px;
        text-transform: uppercase;
        background: #eee;
        padding: 2px 8px;
        border-radius: 4px;
        margin-bottom: 8px;
        display: inline-block;
    }
    .btn-step {
        padding: 12px 40px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        height: 48px;
    }
    .btn-next {
        background: var(--pink);
        color: #fff;
        border: 1px solid var(--pink);
    }
    .btn-next:hover {
        background: #a91b43;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(148, 4, 55, 0.2);
    }
    .btn-prev {
        background: #fff;
        color: #333;
        border: 1px solid #ddd;
    }
    .btn-prev:hover {
        background: #fafafa;
        border-color: #333;
        transform: translateY(-2px);
    }
    .review-section-box {
        background: #fdfdfd;
        border: 1px solid #eee;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .review-title {
        font-size: 14px;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .review-content {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }
</style>
@endpush

@section('content')
<main class="cart-page" style="background: #fffcf0; padding-top: 40px;">
    <div class="page-shell">
        <div class="checkout-grid" style="display: grid; grid-template-columns: 1fr 350px; gap: 40px;">
            <form id="checkoutForm" method="POST" action="{{ route('checkout.place') }}" class="checkout-main">
                @csrf
                <input type="hidden" name="payment_method" value="razorpay">
                <!-- Step 1: Delivery Address -->
                <div id="step-1" class="checkout-step-content">
                    <div class="checkout-section">
                        <h2 class="checkout-title">Shipping Address</h2>
                        <div class="review-section-box" style="margin-bottom: 25px;">
                            <div class="review-title">Contact Details</div>
                            <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                <div class="form-group">
                                    <label class="form-label" style="display: block; font-size: 12px; color: #999; margin-bottom: 5px;">Full Name</label>
                                    <input type="text" name="customer_name" required class="form-input" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" value="{{ old('customer_name') }}" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" style="display: block; font-size: 12px; color: #999; margin-bottom: 5px;">Email</label>
                                    <input type="email" name="customer_email" required class="form-input" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" value="{{ old('customer_email') }}" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" style="display: block; font-size: 12px; color: #999; margin-bottom: 5px;">Phone</label>
                                    <input type="tel" name="customer_phone" required class="form-input" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" value="{{ old('customer_phone') }}" placeholder="Phone">
                                </div>
                                <div class="form-group" style="grid-column: span 2;">
                                    <label class="form-label" style="display: block; font-size: 12px; color: #999; margin-bottom: 5px;">Delivery Address</label>
                                    <textarea name="delivery_address" id="delivery_address" required class="form-input" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; min-height: 80px;" placeholder="Full address">{{ old('delivery_address') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="saved-addresses" id="addressList" style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 30px;">
                            <div class="address-card active" onclick="selectAddress(this)">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                    <span class="address-label-badge" style="background: #e3f2fd; color: #1565c0;">Home</span>
                                    <button onclick="editAddress(this, event)" style="background: none; border: none; color: var(--pink); cursor: pointer; font-size: 12px; font-weight: 600;">Edit</button>
                                </div>
                                <div class="addr-name" style="font-weight: 600; margin-bottom: 5px;">Raswanth Sabarish</div>
                                <div class="address-text" style="font-size: 13px; color: #666;">
                                    <span class="addr-line1">416/9 Aranmanai Street, S.V. Nagaram</span><br>
                                    <span class="addr-city-state">Arni, Tamil Nadu - 632317</span><br>
                                    Phone: <span class="addr-phone">+91 96295 52822</span>
                                </div>
                            </div>
                            <div class="address-card" onclick="selectAddress(this)">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                    <span class="address-label-badge">Work</span>
                                    <button onclick="editAddress(this, event)" style="background: none; border: none; color: var(--pink); cursor: pointer; font-size: 12px; font-weight: 600;">Edit</button>
                                </div>
                                <div class="addr-name" style="font-weight: 600; margin-bottom: 5px;">Raswanth Sabarish</div>
                                <div class="address-text" style="font-size: 13px; color: #666;">
                                    <span class="addr-line1">Ocean Softwares, Main Road</span><br>
                                    <span class="addr-city-state">Chennai, Tamil Nadu - 600001</span><br>
                                    Phone: <span class="addr-phone">+91 96295 52822</span>
                                </div>
                            </div>
                        </div>

                        <div style="margin-bottom: 30px; padding-top: 20px; border-top: 1px dashed #ddd;">
                            <button type="button" class="btn-step btn-prev" id="toggleNewAddr" style="margin-bottom: 25px; padding: 10px 25px; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                                <span style="font-size: 18px;">+</span> Add New Address
                            </button>
                            
                            <div id="newAddressForm" style="display: none; background: #fff; padding: 20px; border-radius: 12px; border: 1px solid #eee;">
                                <h3 id="formTitle" style="font-size: 16px; margin-bottom: 20px; color: var(--pink);">New Shipping Address</h3>
                                <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                    <input type="hidden" id="editIndex" value="-1">
                                    <div class="form-group"><label class="form-label" style="display: block; font-size: 12px; color: #999; margin-bottom: 5px;">Full Name</label><input type="text" id="fullName" class="form-input" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" placeholder="Name"></div>
                                    <div class="form-group"><label class="form-label" style="display: block; font-size: 12px; color: #999; margin-bottom: 5px;">Phone</label><input type="tel" id="phoneNumber" class="form-input" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" placeholder="Phone"></div>
                                    <div class="form-group" style="grid-column: span 2;"><label class="form-label" style="display: block; font-size: 12px; color: #999; margin-bottom: 5px;">Address</label><input type="text" id="addrLine1" class="form-input" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" placeholder="Street/Apartment"></div>
                                    <div class="form-group"><label class="form-label" style="display: block; font-size: 12px; color: #999; margin-bottom: 5px;">City</label><input type="text" id="city" class="form-input" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;"></div>
                                    <div class="form-group"><label class="form-label" style="display: block; font-size: 12px; color: #999; margin-bottom: 5px;">State</label><input type="text" id="state" class="form-input" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;"></div>
                                </div>
                                <div style="margin-top: 20px; display: flex; gap: 10px;">
                                    <button type="button" class="btn-step btn-next" style="padding: 10px 25px;" onclick="saveAddress()">Save Address</button>
                                    <button type="button" class="btn-step btn-prev" onclick="hideAddressForm()" style="padding: 10px 25px;">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: flex-end;">
                            <button type="button" class="btn-step btn-next" onclick="goToStep(2)">Review Order</button>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Order Review -->
                <div id="step-2" class="checkout-step-content" style="display: none;">
                    <div class="checkout-section">
                        <h2 class="checkout-title">Review Your Order</h2>
                        
                        <div class="review-section-box">
                            <div class="review-title">Delivery Address <a href="#" onclick="goToStep(1)" style="color: var(--pink); font-size: 12px; text-decoration: none;">Change</a></div>
                            <div class="review-content" id="reviewAddr">
                                <strong>Raswanth Sabarish (Home)</strong><br>
                                416/9 Aranmanai Street, S.V. Nagaram<br>
                                Arni, Tamil Nadu - 632317<br>
                                Phone: +91 96295 52822
                            </div>
                        </div>

                        <div class="review-section-box">
                            <div class="review-title">Items & Delivery</div>
                            <div class="review-items-list">
    @if(isset($items) && count($items) > 0)
        @foreach ($items as $item)
            <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                <img src="{{ $item['image_url'] }}" width="60" height="75" style="object-fit: cover; border-radius: 4px;">
                <div style="flex: 1;">
                    <div style="font-weight: 600;">{{ $item['name'] }}</div>
                    <div style="font-size: 12px; color: #666;">Qty: {{ $item['quantity'] }}</div>
                    <div style="font-weight: 700; color: var(--pink); margin-top: 5px;">&#8377;{{ number_format($item['price'], 0) }}</div>
                </div>
            </div>
        @endforeach
    @else
        <div style="font-size: 13px; color: #666;">No items in cart.</div>
    @endif
</div>
                                </div>
                            </div>
                            <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #f5f5f5; font-size: 13px; color: #666;">
                                Delivery Method: <strong style="color: #333;">Standard Delivery (3-5 Days)</strong>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between; margin-top: 30px;">
                            <button type="button" class="btn-step btn-prev" onclick="goToStep(1)">Back</button>
                            <button type="button" class="btn-step btn-next" onclick="goToStep(3)">Continue to Payment</button>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Payment Method -->
                <div id="step-3" class="checkout-step-content" style="display: none;">
                    <div class="checkout-section">
                        <h2 class="checkout-title">Secure Payment</h2>
                        
                        <div class="payment-option-v3 active" style="margin-bottom: 25px;">
                            <img src="https://razorpay.com/favicon.png" width="24" alt="Razorpay">
                            <div style="flex: 1;">
                                <div style="font-weight: 700;">Razorpay Secure</div>
                                <div style="font-size: 13px; color: #666;">UPI, Cards, NetBanking or Wallets</div>
                            </div>
                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 6px solid var(--pink);"></div>
                        </div>

                        <div class="form-group" id="termsGroup" style="margin: 20px 0;">
                            <label style="display: flex; align-items: center; gap: 12px; font-size: 14px; cursor: pointer;">
                                <input type="checkbox" id="termsAgree" required checked> I agree to the <a href="{{ url('terms-conditions') }}" style="color: var(--pink);">Terms and Conditions</a>
                            </label>
                            <span class="error-msg" id="termsErrorMsg" style="display: block; opacity: 0; pointer-events: none; margin-top: 10px;">Please agree to terms to proceed</span>
                        </div>

                        <div style="display: flex; justify-content: space-between; margin-top: 30px;">
                            <button type="button" class="btn-step btn-prev" onclick="goToStep(2)">Back</button>
                            <button type="button" class="btn-step btn-next" style="padding: 12px 60px; font-size: 18px;" onclick="placeOrder()">Pay & Place Order</button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Summary Side -->
            <aside class="cart-summary">
                <h2 class="summary-title" style="margin-bottom: 15px;">Order Summary</h2>
                
                <div class="summary-row"><span>Subtotal ({{ $itemCount ?? 0 }} items)</span><span>&#8377;{{ number_format($subTotal ?? 0, 0) }}</span></div>
                <div class="summary-row"><span>Delivery Charges</span><span style="color: #2e7d32;">FREE</span></div>
                <div class="summary-row"><span>GST (5%)</span><span>&#8377;{{ number_format($tax ?? 0, 0) }}</span></div>
                <div class="summary-row" style="color: #2e7d32; font-weight: 600;"><span>Coupon Discount</span><span>-&#8377;{{ number_format($discount ?? 0, 0) }}</span></div>
                
                <div style="margin: 20px 0; padding: 15px; background: #f9f9f9; border-radius: 8px;">
                    <div style="font-size: 13px; font-weight: 600; margin-bottom: 10px;">Apply Coupon</div>
                    @if(session('success'))
                        <div style="font-size: 12px; color: #2e7d32; margin-bottom: 8px;">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div style="font-size: 12px; color: #c62828; margin-bottom: 8px;">{{ session('error') }}</div>
                    @endif
                    @error('code')
                        <div style="font-size: 12px; color: #c62828; margin-bottom: 8px;">{{ $message }}</div>
                    @enderror

                    @if($coupon)
                        <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px;">
                            <div style="font-size: 12px; font-weight: 600; color: #2e7d32;">Applied: {{ $coupon->code }}</div>
                            <button type="submit" form="checkoutForm" formaction="{{ route('cart.coupon.remove') }}" formnovalidate style="padding: 6px 12px; background: #eee; color: #333; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">Remove</button>
                        </div>
                    @else
                        <div style="display: flex; gap: 10px;">
                            <input type="text" name="code" form="checkoutForm" placeholder="Enter code" value="{{ old('code') }}" style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 13px;">
                            <button type="submit" form="checkoutForm" formaction="{{ route('cart.coupon.apply') }}" formnovalidate style="padding: 8px 15px; background: #333; color: #fff; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">Apply</button>
                        </div>
                    @endif
                </div>

                <div class="summary-total" style="border-top: 2px solid #eee; padding-top: 15px; font-size: 22px;">
                    <span>Grand Total</span>
                    <span>&#8377;{{ number_format($grandTotal ?? 0, 0) }}</span>
                </div>

                <div style="text-align: center; margin-top: 25px; padding-top: 20px; border-top: 1px solid #eee;">
                    <img src="{{ asset('images/security.svg') }}" width="16" alt="" style="vertical-align: middle;">
                    <span style="font-size: 12px; color: #999;">100% Secure Transaction</span>
                    <div style="margin-top: 10px; display: flex; justify-content: center; gap: 10px; opacity: 0.6;">
                        <img src="https://razorpay.com/favicon.png" width="18" alt="Razorpay">
                        <span style="font-size: 10px; font-weight: 700;">RAZORPAY SECURED</span>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    function selectAddress(el) {
        document.querySelectorAll('.address-card').forEach(card => card.classList.remove('active'));
        el.classList.add('active');
        
        // Update review section address
        const name = el.querySelector('.addr-name').innerText;
        const line1 = el.querySelector('.addr-line1').innerText;
        const cityState = el.querySelector('.addr-city-state').innerText;
        const phone = el.querySelector('.addr-phone').innerText;
        
        document.getElementById('reviewAddr').innerHTML = `<strong>${name}</strong><br>${line1}<br>${cityState}<br>Phone: ${phone}`;
    }

    document.getElementById('toggleNewAddr').onclick = function() {
        showAddressForm('New Shipping Address');
    };

    function showAddressForm(title, data = null) {
        document.getElementById('toggleNewAddr').style.display = 'none';
        document.getElementById('newAddressForm').style.display = 'block';
        document.getElementById('formTitle').innerText = title;
        
        if(data) {
            document.getElementById('fullName').value = data.name;
            document.getElementById('phoneNumber').value = data.phone;
            document.getElementById('addrLine1').value = data.line1;
            document.getElementById('city').value = data.city;
            document.getElementById('state').value = data.state;
        } else {
            document.getElementById('fullName').value = '';
            document.getElementById('phoneNumber').value = '';
            document.getElementById('addrLine1').value = '';
            document.getElementById('city').value = '';
            document.getElementById('state').value = '';
        }
    }

    function hideAddressForm() {
        document.getElementById('newAddressForm').style.display = 'none';
        document.getElementById('toggleNewAddr').style.display = 'flex';
        document.getElementById('editIndex').value = "-1";
    }

    let editTarget = null;

    function editAddress(btn, event) {
        event.stopPropagation();
        const card = btn.closest('.address-card');
        editTarget = card;
        
        const data = {
            name: card.querySelector('.addr-name').innerText,
            phone: card.querySelector('.addr-phone').innerText,
            line1: card.querySelector('.addr-line1').innerText,
            city: card.querySelector('.addr-city-state').innerText.split(',')[0],
            state: card.querySelector('.addr-city-state').innerText.split(',')[1].split('-')[0].trim()
        };
        
        showAddressForm('Edit Address', data);
    }

    function saveAddress() {
        const name = document.getElementById('fullName').value;
        const phone = document.getElementById('phoneNumber').value;
        const line1 = document.getElementById('addrLine1').value;
        const city = document.getElementById('city').value;
        const state = document.getElementById('state').value;
        
        if(!name || !line1 || !city) return alert('Please fill required fields');

        if(editTarget) {
            // Update existing
            editTarget.querySelector('.addr-name').innerText = name;
            editTarget.querySelector('.addr-phone').innerText = phone;
            editTarget.querySelector('.addr-line1').innerText = line1;
            editTarget.querySelector('.addr-city-state').innerText = `${city}, ${state}`;
            editTarget = null;
        } else {
            // Add new
            const newList = document.getElementById('addressList');
            const newCard = document.createElement('div');
            newCard.className = 'address-card';
            newCard.onclick = function() { selectAddress(this); };
            newCard.innerHTML = `
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <span class="address-label-badge">Other</span>
                    <button onclick="editAddress(this, event)" style="background: none; border: none; color: var(--pink); cursor: pointer; font-size: 12px; font-weight: 600;">Edit</button>
                </div>
                <div class="addr-name" style="font-weight: 600; margin-bottom: 5px;">${name}</div>
                <div class="address-text" style="font-size: 13px; color: #666;">
                    <span class="addr-line1">${line1}</span><br>
                    <span class="addr-city-state">${city}, ${state}</span><br>
                    Phone: <span class="addr-phone">${phone}</span>
                </div>
            `;
            newList.appendChild(newCard);
            selectAddress(newCard);
        }
        
        hideAddressForm();
    }

    function goToStep(num) {
        // Toggle Nav Bar State
        document.querySelectorAll('.step-item').forEach((item, index) => {
            if (index + 1 < num) {
                item.classList.add('completed');
                item.classList.remove('active');
            } else if (index + 1 === num) {
                item.classList.add('active');
                item.classList.remove('completed');
            } else {
                item.classList.remove('active', 'completed');
            }
        });

        // Hide all steps, show target
        document.querySelectorAll('.checkout-step-content').forEach(step => step.style.display = 'none');
        document.getElementById('step-' + num).style.display = 'block';

        // Scroll to top of section
        window.scrollTo({ top: 100, behavior: 'smooth' });
    }

    function placeOrder() {
        const agreed = document.getElementById('termsAgree').checked;
        const group = document.getElementById('termsGroup');
        const error = document.getElementById('termsErrorMsg');
        const form = document.getElementById('checkoutForm');
        const addressInput = document.getElementById('delivery_address');
        
        if (!agreed) {
            group.classList.add('has-error');
            error.style.opacity = '1';
            return;
        } else {
            group.classList.remove('has-error');
            error.style.opacity = '0';
        }
        
        if (addressInput && addressInput.value.trim() === '') {
            const reviewAddr = document.getElementById('reviewAddr');
            if (reviewAddr) {
                addressInput.value = reviewAddr.innerText.replace(/\s+/g, ' ').trim();
            }
        }

        if (form) {
            form.submit();
        }
    }
</script>
@endpush





