@extends('frontend.layouts.app')

@section('title', 'Cancellation Policy - Nandhini Silks')

@section('content')
    <main class="policy-main">
        <div class="page-shell">
            <div class="policy-container">
                <h1 class="policy-title">Order Cancellation</h1>
                <div class="policy-content">
                    <h2>Right to Cancel</h2>
                    <p>We understand that minds can change. Orders may be cancelled prior to dispatch without any
                        hassle.</p>

                    <h2>Cancellation Window</h2>
                    <ul>
                        <li><b>Pre-dispatch:</b> You may cancel your order by contacting us within 24 hours of placement
                            for a full, unconditional refund to your original payment method.</li>
                        <li><b>Post-dispatch:</b> Once an order has left our boutique, cancellations are no longer
                            possible. You will need to receive the item and initiate a return request as per our
                            Exchange Policy.</li>
                    </ul>

                    <h2>Custom Orders</h2>
                    <p>Bespoke or heavily customized saree orders (such as custom blouse stitching or specialized
                        fall/pico additions) cannot be cancelled once the work has begun.</p>
                </div>
            </div>
        </div>
    </main>
@endsection
