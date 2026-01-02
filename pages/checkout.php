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
<body class="font-sans antialiased text-platinum-900 bg-platinum-50 selection:bg-yale-blue-500 selection:text-white">

<?php $path = '../'; include '../includes/navbar.php'; ?>

<main class="pt-32 pb-24 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-prussian-blue-900 mb-4 font-exo">
                    Checkout
                </h1>
                <p class="text-platinum-600 text-lg">Complete your order</p>
            </div>

            <!-- Success Message (Hidden by default) -->
            <div id="success-message" class="hidden mb-8 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-2xl p-8 shadow-xl">
                <div class="flex items-start gap-4">
                    <div class="bg-white/20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold mb-2">Order Placed Successfully!</h2>
                        <p class="text-green-100 mb-4">Thank you for your order. We'll contact you shortly to confirm the details.</p>
                        <div class="bg-white/20 rounded-lg p-4 mb-4">
                            <p class="font-semibold">Order Number: <span id="order-number" class="font-mono">DEMO-XXXX</span></p>
                        </div>
                        <a href="shop.php" class="inline-block bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-green-50 transition-all duration-300">
                            ← Back to Store
                        </a>
                    </div>
                </div>
            </div>

            <!-- Checkout Form -->
            <div id="checkout-form" class="grid lg:grid-cols-3 gap-8">
                
                <!-- Order Form -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Customer Information -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h2 class="text-2xl font-bold text-prussian-blue-900 mb-6 font-exo">Customer Information</h2>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="customer-name" class="block text-sm font-semibold text-prussian-blue-800 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="customer-name"
                                    required
                                    class="w-full px-4 py-3 bg-platinum-50 border-2 border-platinum-200 rounded-lg focus:border-yale-blue-500 focus:outline-none transition-colors duration-300"
                                    placeholder="John Doe">
                            </div>
                            <div>
                                <label for="customer-phone" class="block text-sm font-semibold text-prussian-blue-800 mb-2">
                                    Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="tel" 
                                    id="customer-phone"
                                    required
                                    class="w-full px-4 py-3 bg-platinum-50 border-2 border-platinum-200 rounded-lg focus:border-yale-blue-500 focus:outline-none transition-colors duration-300"
                                    placeholder="01XXXXXXXXX">
                            </div>
                            <div class="md:col-span-2">
                                <label for="customer-email" class="block text-sm font-semibold text-prussian-blue-800 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="customer-email"
                                    required
                                    class="w-full px-4 py-3 bg-platinum-50 border-2 border-platinum-200 rounded-lg focus:border-yale-blue-500 focus:outline-none transition-colors duration-300"
                                    placeholder="john@example.com">
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h2 class="text-2xl font-bold text-prussian-blue-900 mb-6 font-exo">Shipping Address</h2>
                        <div class="space-y-6">
                            <div>
                                <label for="address" class="block text-sm font-semibold text-prussian-blue-800 mb-2">
                                    Street Address <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="address"
                                    required
                                    class="w-full px-4 py-3 bg-platinum-50 border-2 border-platinum-200 rounded-lg focus:border-yale-blue-500 focus:outline-none transition-colors duration-300"
                                    placeholder="House/Flat, Road, Block">
                            </div>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="city" class="block text-sm font-semibold text-prussian-blue-800 mb-2">
                                        City <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="city"
                                        required
                                        class="w-full px-4 py-3 bg-platinum-50 border-2 border-platinum-200 rounded-lg focus:border-yale-blue-500 focus:outline-none transition-colors duration-300"
                                        placeholder="Dhaka">
                                </div>
                                <div>
                                    <label for="postal-code" class="block text-sm font-semibold text-prussian-blue-800 mb-2">
                                        Postal Code
                                    </label>
                                    <input 
                                        type="text" 
                                        id="postal-code"
                                        class="w-full px-4 py-3 bg-platinum-50 border-2 border-platinum-200 rounded-lg focus:border-yale-blue-500 focus:outline-none transition-colors duration-300"
                                        placeholder="1216">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h2 class="text-2xl font-bold text-prussian-blue-900 mb-6 font-exo">Payment Method (Demo)</h2>
                        <div class="space-y-3">
                            <label class="flex items-center gap-4 p-4 border-2 border-platinum-200 rounded-lg cursor-pointer hover:border-yale-blue-500 transition-colors duration-300">
                                <input type="radio" name="payment" value="cod" checked class="w-5 h-5 text-yale-blue-500">
                                <div class="flex-1">
                                    <p class="font-semibold text-prussian-blue-900">Cash on Delivery</p>
                                    <p class="text-sm text-platinum-600">Pay when you receive your order</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-4 p-4 border-2 border-platinum-200 rounded-lg cursor-pointer hover:border-yale-blue-500 transition-colors duration-300">
                                <input type="radio" name="payment" value="bkash" class="w-5 h-5 text-yale-blue-500">
                                <div class="flex-1">
                                    <p class="font-semibold text-prussian-blue-900">bKash (Demo)</p>
                                    <p class="text-sm text-platinum-600">Mobile payment via bKash</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-4 p-4 border-2 border-platinum-200 rounded-lg cursor-pointer hover:border-yale-blue-500 transition-colors duration-300">
                                <input type="radio" name="payment" value="nagad" class="w-5 h-5 text-yale-blue-500">
                                <div class="flex-1">
                                    <p class="font-semibold text-prussian-blue-900">Nagad (Demo)</p>
                                    <p class="text-sm text-platinum-600">Mobile payment via Nagad</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-4 p-4 border-2 border-platinum-200 rounded-lg cursor-pointer hover:border-yale-blue-500 transition-colors duration-300">
                                <input type="radio" name="payment" value="card" class="w-5 h-5 text-yale-blue-500">
                                <div class="flex-1">
                                    <p class="font-semibold text-prussian-blue-900">Credit/Debit Card (Demo)</p>
                                    <p class="text-sm text-platinum-600">Pay with Visa, Mastercard, or Amex</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Order Notes -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h2 class="text-2xl font-bold text-prussian-blue-900 mb-6 font-exo">Order Notes (Optional)</h2>
                        <textarea 
                            id="order-notes"
                            rows="4"
                            class="w-full px-4 py-3 bg-platinum-50 border-2 border-platinum-200 rounded-lg focus:border-yale-blue-500 focus:outline-none transition-colors duration-300 resize-none"
                            placeholder="Any special instructions for your order..."></textarea>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                        <h2 class="text-2xl font-bold text-prussian-blue-900 mb-6 font-exo">Order Summary</h2>
                        
                        <div id="order-items" class="space-y-4 mb-6 max-h-96 overflow-y-auto">
                            <!-- Order items will be rendered by JavaScript -->
                        </div>

                        <div class="border-t border-platinum-200 pt-4 space-y-3">
                            <div class="flex justify-between text-platinum-700">
                                <span>Subtotal:</span>
                                <span id="summary-subtotal" class="font-semibold">৳0</span>
                            </div>
                            <div class="flex justify-between text-platinum-700">
                                <span>Shipping:</span>
                                <span id="summary-shipping" class="font-semibold">৳100</span>
                            </div>
                            <div class="flex justify-between text-xl font-bold text-prussian-blue-900 pt-3 border-t border-platinum-200">
                                <span>Total:</span>
                                <span id="summary-total" class="text-yale-blue-600">৳0</span>
                            </div>
                        </div>

                        <button 
                            onclick="placeOrder()"
                            class="w-full mt-6 bg-yale-blue-500 hover:bg-yale-blue-600 text-white px-6 py-4 rounded-lg font-bold text-lg transition-all duration-300 hover:scale-105 flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Place Order
                        </button>

                        <a href="shop.php" class="block w-full mt-3 bg-platinum-200 hover:bg-platinum-300 text-prussian-blue-900 text-center px-6 py-3 rounded-lg font-semibold transition-all duration-300">
                            ← Back to Store
                        </a>

                        <div class="mt-6 p-4 bg-yale-blue-50 rounded-lg">
                            <p class="text-xs text-yale-blue-800 text-center">
                                <strong>Note:</strong> This is a demo checkout. No actual payment will be processed.
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
let cart = JSON.parse(localStorage.getItem('frequencyLabCart')) || [];
const SHIPPING_COST = 100;

// Initialize checkout page
function initCheckout() {
    if (cart.length === 0) {
        window.location.href = 'shop.php';
        return;
    }
    
    renderOrderSummary();
}

// Render order summary
function renderOrderSummary() {
    const orderItems = document.getElementById('order-items');
    const subtotalEl = document.getElementById('summary-subtotal');
    const shippingEl = document.getElementById('summary-shipping');
    const totalEl = document.getElementById('summary-total');
    
    if (!orderItems) return;
    
    orderItems.innerHTML = cart.map(item => `
        <div class="flex gap-3 pb-4 border-b border-platinum-100">
            <div class="w-16 h-16 bg-platinum-100 rounded-lg flex-shrink-0"></div>
            <div class="flex-1 min-w-0">
                <h4 class="font-semibold text-sm text-prussian-blue-900 truncate">${item.name}</h4>
                <p class="text-xs text-platinum-600 mt-1">Qty: ${item.quantity}</p>
                <p class="text-sm font-bold text-yale-blue-600 mt-1">৳${(item.price * item.quantity).toLocaleString()}</p>
            </div>
        </div>
    `).join('');
    
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const total = subtotal + SHIPPING_COST;
    
    if (subtotalEl) subtotalEl.textContent = `৳${subtotal.toLocaleString()}`;
    if (shippingEl) shippingEl.textContent = `৳${SHIPPING_COST.toLocaleString()}`;
    if (totalEl) totalEl.textContent = `৳${total.toLocaleString()}`;
}

// Place order
function placeOrder() {
    // Validate form
    const name = document.getElementById('customer-name').value.trim();
    const phone = document.getElementById('customer-phone').value.trim();
    const email = document.getElementById('customer-email').value.trim();
    const address = document.getElementById('address').value.trim();
    const city = document.getElementById('city').value.trim();
    
    if (!name || !phone || !email || !address || !city) {
        alert('Please fill in all required fields');
        return;
    }
    
    // Generate order number
    const orderNumber = 'DEMO-' + Math.random().toString(36).substr(2, 9).toUpperCase();
    
    // Show success message
    document.getElementById('checkout-form').classList.add('hidden');
    const successMessage = document.getElementById('success-message');
    successMessage.classList.remove('hidden');
    document.getElementById('order-number').textContent = orderNumber;
    
    // Clear cart
    localStorage.removeItem('frequencyLabCart');
    
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
