@extends('frontend.layouts.app')

@section('title', 'My Addresses | Nandhini Silks')

@section('content')
    <main class="account-page">
        <div class="page-shell">
            <div class="breadcrumb">
                <a href="{{ url('/') }}">Home</a> &nbsp; / &nbsp; <a href="{{ url('my-account') }}">My Account</a> &nbsp; /
                &nbsp; <span>Addresses</span>
            </div>

            <div class="account-layout">
                <!-- Sidebar -->
                <aside class="account-sidebar">
                    <div class="account-user-info">
                        <div class="account-avatar">
                            <img src="{{ asset('images/user-avatar.svg') }}" alt="User Avatar">
                        </div>
                        <h2 class="account-user-name">John Doe</h2>
                        <p class="account-user-email">john.doe@example.com</p>
                    </div>

                    <ul class="account-nav">
                        <li class="account-nav-item"><a href="{{ url('my-account') }}"
                                class="account-nav-link"><span>Dashboard</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('my-orders') }}" class="account-nav-link"><span>My
                                    Orders</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('my-profile') }}" class="account-nav-link"><span>My
                                    Profile</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('my-addresses') }}"
                                class="account-nav-link active"><span>Addresses</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('my-reviews') }}"
                                class="account-nav-link"><span>My Reviews</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('wishlist') }}"
                                class="account-nav-link"><span>Wishlist</span></a></li>
                        <li class="account-nav-item"><a href="{{ url('login') }}" class="account-nav-link logout"><span>Logout</span></a></li>
                    </ul>
                </aside>

                <!-- Addresses Content -->
                <div class="account-content">
                    <div class="section-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                        <h1 class="section-title" style="font-size: 24px;">Saved Addresses</h1>
                    </div>

                    <div class="address-grid" id="addressGrid">
                        <!-- Default Address -->
                        <div class="address-card-v3 default" id="addr-1">
                            <span class="default-badge-v3">Default</span>
                            <h3 class="address-name-v3">John Doe (Home)</h3>
                            <div class="address-details-v3">
                                <span class="addr-street">416/9 Aranmanai Street, S.V. Nagaram</span><br>
                                <span class="addr-city-state">Arni, Tamil Nadu - 632317</span><br>
                                <span class="addr-country">India</span><br>
                                Phone: <span class="addr-phone">+91 98765 43210</span>
                            </div>
                            <div class="address-actions-v3">
                                <button onclick="editMode(1)" class="address-action-v3" style="background:none; border:none; cursor:pointer; padding:0;">Edit</button>
                                <button onclick="deleteAddress(1)" class="address-action-v3" style="background:none; border:none; cursor:pointer; padding:0; margin-left: 15px; color: #999;">Delete</button>
                            </div>
                        </div>

                        <!-- Add New Address Button -->
                        <div class="btn-add-address" id="addAddressBtn" style="cursor: pointer;" onclick="openAddressModal()">
                            <span style="font-size: 24px;">+</span>
                            <span>Add New Address</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Address Modal -->
        <div id="addressModal" class="address-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2000; align-items: center; justify-content: center;">
            <div class="modal-content" style="background: #fff; padding: 40px; border-radius: 20px; width: 600px; max-width: 90%; position: relative; box-shadow: 0 10px 40px rgba(0,0,0,0.15);">
                <button onclick="closeAddressModal()" style="position: absolute; right: 25px; top: 25px; background: none; border: none; font-size: 24px; cursor: pointer; color: #999;">&times;</button>
                
                <h2 id="modalTitle" style="margin-top: 0; font-size: 24px; color: #333; margin-bottom: 8px; font-weight: 700;">Add New Address</h2>
                <p style="color: #999; font-size: 14px; margin-bottom: 30px; margin-top: 0;">Items will be delivered to this address.</p>
                
                <form id="addressForm">
                    <input type="hidden" id="editAddrId">
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #333;">Full Name</label>
                            <input type="text" id="modalName" required style="width: 100%; padding: 12px 15px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 14px; outline: none;" placeholder="e.g. John Doe">
                        </div>
                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #333;">Phone Number</label>
                            <input type="tel" id="modalPhone" required style="width: 100%; padding: 12px 15px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 14px; outline: none;" placeholder="e.g. 98765 43210">
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #333;">Street Address / House No.</label>
                        <input type="text" id="modalStreet" required style="width: 100%; padding: 12px 15px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 14px; outline: none;" placeholder="Door No, Street name, Area">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #333;">City</label>
                            <input type="text" id="modalCity" required style="width: 100%; padding: 12px 15px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 14px; outline: none;" placeholder="e.g. Chennai">
                        </div>
                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #333;">State</label>
                            <input type="text" id="modalState" required style="width: 100%; padding: 12px 15px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 14px; outline: none;" placeholder="e.g. Tamil Nadu">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #333;">Pincode</label>
                            <input type="text" id="modalPincode" required style="width: 100%; padding: 12px 15px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 14px; outline: none;" placeholder="e.g. 600001">
                        </div>
                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #333;">Address Type</label>
                            <select id="modalType" style="width: 100%; padding: 12px 15px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 14px; outline: none; background: #fff; appearance: none; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2220%22%20height%3D%2220%22%20viewBox%3D%220%200%2020%2020%22%20fill%3D%22none%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Cpath%20d%3D%22M5%207L10%2012L15%207%22%20stroke%3D%22%23999%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 15px center;">
                                <option value="Home">Home</option>
                                <option value="Work">Work</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" style="width: 100%; padding: 14px; background: #940437; color: #fff; border: none; border-radius: 12px; font-weight: 700; font-size: 16px; cursor: pointer; transition: background 0.3s;" onmouseover="this.style.background='#74032b'" onmouseout="this.style.background='#940437'">Save Address Details</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        let nextId = 2;

        function openAddressModal() {
            document.getElementById('modalTitle').innerText = 'Add New Address';
            document.getElementById('editAddrId').value = '';
            document.getElementById('addressForm').reset();
            document.getElementById('addressModal').style.display = 'flex';
        }

        function closeAddressModal() {
            document.getElementById('addressModal').style.display = 'none';
        }

        function editMode(id) {
            const card = document.getElementById('addr-' + id);
            const name = card.querySelector('.address-name-v3').innerText;
            const street = card.querySelector('.addr-street').innerText;
            const cityStateZip = card.querySelector('.addr-city-state').innerText;
            const country = card.querySelector('.addr-country').innerText;
            const phone = card.querySelector('.addr-phone').innerText;
            const type = name.includes('(') ? name.split('(')[1].replace(')', '') : 'Home';

            // Parsing city, state, zip from "Arni, Tamil Nadu - 632317"
            const parts = cityStateZip.split(',');
            const city = parts[0]?.trim() || '';
            const stateZip = parts[1]?.split('-') || [];
            const state = stateZip[0]?.trim() || '';
            const pincode = stateZip[1]?.trim() || '';

            document.getElementById('modalTitle').innerText = 'Edit Address';
            document.getElementById('editAddrId').value = id;
            document.getElementById('modalName').value = name.split(' (')[0];
            document.getElementById('modalStreet').value = street;
            document.getElementById('modalCity').value = city;
            document.getElementById('modalState').value = state;
            document.getElementById('modalPincode').value = pincode;
            document.getElementById('modalCountry').value = country;
            document.getElementById('modalPhone').value = phone;
            document.getElementById('modalType').value = type;

            document.getElementById('addressModal').style.display = 'flex';
        }

        function deleteAddress(id) {
            if(confirm('Are you sure you want to delete this address?')) {
                document.getElementById('addr-' + id).remove();
            }
        }

        document.getElementById('addressForm').onsubmit = function(e) {
            e.preventDefault();
            
            const id = document.getElementById('editAddrId').value;
            const name = document.getElementById('modalName').value;
            const phone = document.getElementById('modalPhone').value;
            const street = document.getElementById('modalStreet').value;
            const city = document.getElementById('modalCity').value;
            const state = document.getElementById('modalState').value;
            const pincode = document.getElementById('modalPincode').value;
            const country = document.getElementById('modalCountry').value;
            const type = document.getElementById('modalType').value;

            const fullCityState = `${city}, ${state} - ${pincode}`;
            const fullNameWithType = `${name} (${type})`;

            if(id) {
                // Update existing
                const card = document.getElementById('addr-' + id);
                card.querySelector('.address-name-v3').innerText = fullNameWithType;
                card.querySelector('.addr-street').innerText = street;
                card.querySelector('.addr-city-state').innerText = fullCityState;
                card.querySelector('.addr-country').innerText = country;
                card.querySelector('.addr-phone').innerText = phone;
            } else {
                // Create new
                const currentId = nextId++;
                const grid = document.getElementById('addressGrid');
                const btn = document.getElementById('addAddressBtn');
                
                const newCard = document.createElement('div');
                newCard.className = 'address-card-v3';
                newCard.id = 'addr-' + currentId;
                newCard.innerHTML = `
                    <h3 class="address-name-v3">${fullNameWithType}</h3>
                    <div class="address-details-v3">
                        <span class="addr-street">${street}</span><br>
                        <span class="addr-city-state">${fullCityState}</span><br>
                        <span class="addr-country">${country}</span><br>
                        Phone: <span class="addr-phone">${phone}</span>
                    </div>
                    <div class="address-actions-v3">
                        <button onclick="editMode(${currentId})" class="address-action-v3" style="background:none; border:none; cursor:pointer; padding:0;">Edit</button>
                        <button onclick="deleteAddress(${currentId})" class="address-action-v3" style="background:none; border:none; cursor:pointer; padding:0; margin-left: 15px; color: #999;">Delete</button>
                    </div>
                `;
                grid.insertBefore(newCard, btn);
            }

            closeAddressModal();
        };

        // Close on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('addressModal');
            if (event.target == modal) {
                closeAddressModal();
            }
        }
    </script>
@endsection
