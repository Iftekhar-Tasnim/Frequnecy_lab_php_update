<!DOCTYPE html>
<html lang="en" data-theme="f-lab">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Complete your purchase at Frequency Lab Store - Electronics & Robotics">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Exo+2:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    
    <title>Checkout | Frequency Lab Store</title>
</head>
<body class="font-sans antialiased text-platinum-900 bg-slate-50 selection:bg-yale-blue-500 selection:text-white">

<?php $path = '../'; include '../includes/navbar.php'; ?>

<main class="pt-24 md:pt-32 pb-16 md:pb-24 min-h-screen">
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Header -->
        <div class="mb-8 md:mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-2 font-exo">
                Complete Your Order
            </h1>
            <p class="text-slate-500 text-sm md:text-base">Please provide your details to finalize the purchase.</p>
        </div>

        <!-- Success Message -->
        <div id="success-message" class="hidden mb-8 md:mb-12 bg-white rounded-2xl p-10 md:p-16 shadow-2xl border border-green-100 text-center animate-fade-in-up">
            <div class="max-w-md mx-auto">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Order Placed!</h2>
                <p class="text-slate-600 mb-8">Thank you for shopping with us. We have received your order and will contact you shortly for confirmation.</p>
                
                <div class="bg-slate-50 rounded-xl p-5 mb-8 border border-slate-100">
                    <p class="text-xs text-slate-500 uppercase tracking-widest font-bold mb-1">Order ID</p>
                    <p id="order-number" class="text-xl font-mono font-bold text-yale-blue-600">XXXX-XXXX-XXXX</p>
                </div>

                <a href="#/shop" class="inline-flex items-center justify-center gap-2 w-full md:w-auto bg-yale-blue-500 text-white px-8 py-4 rounded-xl font-bold hover:bg-yale-blue-600 transition-all duration-300 hover:scale-105 shadow-lg shadow-yale-blue-500/25">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Continue Shopping
                </a>
            </div>
        </div>

        <!-- Checkout Form -->
        <div id="checkout-form" class="grid lg:grid-cols-3 gap-8">
            
            <!-- Left Side: Forms -->
            <div class="lg:col-span-2 space-y-6 md:space-y-8">
                
                <!-- Customer Information -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-yale-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Personal Information
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid md:grid-cols-2 gap-5">
                            <div>
                                <label for="customer-name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="customer-name"
                                    required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-yale-blue-500/10 focus:border-yale-blue-500 focus:outline-none transition-all duration-300 placeholder:text-slate-400"
                                    placeholder="Enter your full name">
                            </div>
                            <div>
                                <label for="customer-phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="tel" 
                                    id="customer-phone"
                                    required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-yale-blue-500/10 focus:border-yale-blue-500 focus:outline-none transition-all duration-300 placeholder:text-slate-400"
                                    placeholder="e.g. 017XXXXXXXX">
                            </div>
                            <div class="md:col-span-2">
                                <label for="customer-email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="customer-email"
                                    required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-yale-blue-500/10 focus:border-yale-blue-500 focus:outline-none transition-all duration-300 placeholder:text-slate-400"
                                    placeholder="yourname@example.com">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-yale-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Delivery Address
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-5">
                            <div>
                                <label for="address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Street Address <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="address"
                                    required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-yale-blue-500/10 focus:border-yale-blue-500 focus:outline-none transition-all duration-300 placeholder:text-slate-400"
                                    placeholder="Enter House/Flat, Road, Block">
                            </div>
                            <div class="grid md:grid-cols-2 gap-5">
                                <div>
                                    <label for="city" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                        City <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="city"
                                        required
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-yale-blue-500/10 focus:border-yale-blue-500 focus:outline-none transition-all duration-300 placeholder:text-slate-400"
                                        placeholder="City name">
                                </div>
                                <div>
                                    <label for="postal-code" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                        Postal Code
                                    </label>
                                    <input 
                                        type="text" 
                                        id="postal-code"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-yale-blue-500/10 focus:border-yale-blue-500 focus:outline-none transition-all duration-300 placeholder:text-slate-400"
                                        placeholder="Zip/Postal code">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-yale-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Payment Method
                        </h2>
                    </div>
                    <div class="p-6 space-y-3">
                        <label class="flex items-center gap-4 p-4 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 hover:border-yale-blue-300 transition-all duration-300 group">
                            <input type="radio" name="payment" value="cod" checked class="w-5 h-5 text-yale-blue-500 focus:ring-yale-blue-500 border-slate-300">
                            <div class="flex-1">
                                <p class="font-bold text-slate-800">Cash on Delivery</p>
                                <p class="text-sm text-slate-500">Pay in cash when your order reaches your doorstep.</p>
                            </div>
                            <div class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-[10px] font-bold uppercase tracking-wider">Recommended</div>
                        </label>
                        <label class="flex items-center gap-4 p-4 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 hover:border-yale-blue-300 transition-all duration-300">
                            <input type="radio" name="payment" value="bkash" class="w-5 h-5 text-yale-blue-500 focus:ring-yale-blue-500 border-slate-300">
                            <div class="flex-1">
                                <p class="font-bold text-slate-800">bKash</p>
                                <p class="text-sm text-slate-500">Fast and secure mobile payment via bKash.</p>
                            </div>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b2/Bkash_logo.png" alt="bKash" class="h-8 object-contain opacity-60 grayscale group-hover:grayscale-0 transition-all">
                        </label>
                        <label class="flex items-center gap-4 p-4 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 hover:border-yale-blue-300 transition-all duration-300">
                            <input type="radio" name="payment" value="nagad" class="w-5 h-5 text-yale-blue-500 focus:ring-yale-blue-500 border-slate-300">
                            <div class="flex-1">
                                <p class="font-bold text-slate-800">Nagad</p>
                                <p class="text-sm text-slate-500">Digital financial service by Bangladesh Post Office.</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Order Notes -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-yale-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Order Instructions (Optional)
                        </h2>
                    </div>
                    <div class="p-6">
                        <textarea 
                            id="order-notes"
                            rows="4"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-yale-blue-500/10 focus:border-yale-blue-500 focus:outline-none transition-all duration-300 resize-none placeholder:text-slate-400"
                            placeholder="Add any special instructions or notes for your delivery..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Right Side: Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden sticky top-24">
                    <div class="bg-slate-900 p-6 text-white">
                        <h2 class="text-xl font-bold font-exo flex items-center gap-2">
                            <svg class="w-6 h-6 text-yale-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Order Summary
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        <div id="order-items" class="space-y-4 mb-6 max-h-[40vh] overflow-y-auto pr-2 scrollbar-thin">
                            <!-- Order items will be rendered by JavaScript -->
                        </div>

                        <div class="space-y-4 pt-4 border-t border-slate-100">
                            <div class="flex justify-between items-center text-slate-600">
                                <span class="text-sm font-medium">Subtotal</span>
                                <span id="summary-subtotal" class="font-bold text-slate-900">৳0</span>
                            </div>
                            <div class="flex justify-between items-center text-slate-600">
                                <span class="text-sm font-medium">Delivery Charge</span>
                                <span id="summary-shipping" class="font-bold text-slate-900">৳100</span>
                            </div>
                            <div class="flex justify-between items-center pt-4 border-t border-slate-200">
                                <span class="text-lg font-bold text-slate-900">Final Total</span>
                                <span id="summary-total" class="text-2xl font-black text-yale-blue-600">৳0</span>
                            </div>
                        </div>

                        <button 
                            onclick="placeOrder()"
                            class="w-full mt-8 bg-yale-blue-500 hover:bg-yale-blue-600 text-white px-6 py-4 rounded-xl font-bold text-lg transition-all duration-300 hover:scale-[1.02] active:scale-95 shadow-xl shadow-yale-blue-500/30 flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Confirm Order
                        </button>

                        <a href="#/shop" class="block w-full mt-4 text-center text-slate-500 hover:text-slate-900 font-bold transition-colors">
                            ← Back to Shop
                        </a>
                    </div>
                    
                    <div class="bg-blue-50 border-t border-blue-100 p-4">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-[10px] text-blue-700 leading-normal">
                                <strong>Payment Notice:</strong> Your info is secure. For pre-payments like bKash/Nagad, we will contact you via phone for the transaction details. No auto-charge is applied.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>

<script>
// Load cart from localStorage
var cart = [];
try {
    cart = JSON.parse(localStorage.getItem('frequencyLabCart')) || [];
} catch (e) {
    console.error('Error parsing cart data:', e);
    localStorage.removeItem('frequencyLabCart');
}

const SHIPPING_COST = 100;

// Initialize checkout page
function initCheckout() {
    // Re-check cart from storage in case it changed in another tab
    try {
        cart = JSON.parse(localStorage.getItem('frequencyLabCart')) || [];
    } catch (e) {
        cart = [];
    }

    // Filter out NULL or Invalid items to prevent crashes
    cart = cart.filter(item => item && typeof item === 'object' && item.id);

    if (!Array.isArray(cart) || cart.length === 0) {
        window.location.href = '#/shop';
        return;
    }
    
    renderOrderSummary();
}

// Render order summary
function renderOrderSummary() {
    const orderItemsContainer = document.getElementById('order-items');
    const subtotalEl = document.getElementById('summary-subtotal');
    const shippingEl = document.getElementById('summary-shipping');
    const totalEl = document.getElementById('summary-total');
    
    if (!orderItemsContainer) return;
    
    try {
        orderItemsContainer.innerHTML = cart.map(item => {
            const price = Number(item.price) || 0;
            const quantity = Number(item.quantity) || 1;
            const itemTotal = price * quantity;
            
            return `
            <div class="flex gap-4 p-2 rounded-xl group hover:bg-slate-50 transition-all duration-200">
                <div class="w-16 h-16 bg-slate-100 rounded-lg overflow-hidden flex-shrink-0 border border-slate-200">
                    <img src="${item.image || ''}" alt="${item.name || 'Product'}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                        onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22100%22 height=%22100%22/%3E%3C/svg%3E'">
                </div>
                <div class="flex-1 min-w-0 flex flex-col justify-center">
                    <h4 class="font-bold text-sm text-slate-800 truncate">${item.name || 'Unknown Product'}</h4>
                    <div class="flex items-center justify-between mt-1">
                        <p class="text-[11px] font-bold text-slate-500">Qty: ${quantity}</p>
                        <p class="text-sm font-black text-yale-blue-600">৳${itemTotal.toLocaleString()}</p>
                    </div>
                </div>
            </div>
            `;
        }).join('');
        
        const subtotal = cart.reduce((sum, item) => {
            const price = Number(item.price) || 0;
            const quantity = Number(item.quantity) || 1;
            return sum + (price * quantity);
        }, 0);
        
        const total = subtotal + SHIPPING_COST;
        
        if (subtotalEl) subtotalEl.textContent = `৳${subtotal.toLocaleString()}`;
        if (shippingEl) shippingEl.textContent = `৳${SHIPPING_COST.toLocaleString()}`;
        if (totalEl) totalEl.textContent = `৳${total.toLocaleString()}`;
        
    } catch (error) {
        console.error("Error rendering order summary:", error);
    }
}

// Place order
function placeOrder() {
    // Validate form
    const nameEl = document.getElementById('customer-name');
    const phoneEl = document.getElementById('customer-phone');
    const emailEl = document.getElementById('customer-email');
    const addressEl = document.getElementById('address');
    const cityEl = document.getElementById('city');
    
    const name = nameEl.value.trim();
    const phone = phoneEl.value.trim();
    const email = emailEl.value.trim();
    const address = addressEl.value.trim();
    const city = cityEl.value.trim();
    
    // Simple validation with visual feedback
    const fields = [nameEl, phoneEl, emailEl, addressEl, cityEl];
    let hasError = false;
    
    fields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('border-red-500', 'bg-red-50');
            hasError = true;
        } else {
            field.classList.remove('border-red-500', 'bg-red-50');
        }
    });
    
    if (hasError) {
        alert('Please fill in all required fields marked with *');
        return;
    }
    
    // Generate order number
    const orderNumber = 'FL' + Date.now().toString().slice(-6) + Math.random().toString(36).substr(2, 4).toUpperCase();
    
    // Hide form and show success message
    const checkoutForm = document.getElementById('checkout-form');
    const successMessage = document.getElementById('success-message');
    
    if (checkoutForm && successMessage) {
        checkoutForm.classList.add('hidden');
        successMessage.classList.remove('hidden');
        document.getElementById('order-number').textContent = orderNumber;
        
        // Clear cart from storage and memory
        localStorage.removeItem('frequencyLabCart');
        cart = [];
        
        // Update cart UI if globally accessible (e.g. in navbar)
        // We dispatch a custom event so other components can listen
        window.dispatchEvent(new Event('cartUpdated'));
        
        // If the store.js function is available globally, call it
        if (typeof window.updateCartUI === 'function') {
            window.updateCartUI();
        }
    }
    
    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Initialize on page load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCheckout);
} else {
    initCheckout();
}

// Export for router
window.initCheckout = initCheckout;
</script>

</body>
</html>

