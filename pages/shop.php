<!DOCTYPE html>
<html lang="en" data-theme="f-lab">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shop electronics, robotics, and IoT components at Frequency Lab Store">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Exo+2:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    
    <title>Shop | Frequency Lab - Electronics & Robotics Store</title>
</head>
<body class="font-sans antialiased text-platinum-900 bg-platinum-50 selection:bg-yale-blue-500 selection:text-white">

<?php $path = '../'; include '../includes/navbar.php'; ?>

<!-- Floating Cart Button -->
<button onclick="toggleCart()" class="fixed bottom-6 right-6 z-[60] bg-yale-blue-500 hover:bg-yale-blue-600 text-white p-4 rounded-full shadow-2xl transition-all duration-300 hover:scale-110 active:scale-95 group">
    <div class="relative">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center border-2 border-white hidden">0</span>
    </div>
    <span class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-slate-900 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap hidden md:block">
        View Cart
    </span>
</button>


<!-- Hero Section -->
<section class="relative pt-24 md:pt-32 pb-12 md:pb-20 overflow-hidden bg-slate-900">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-blue-900/20 to-slate-900"></div>
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-blue-500/20 to-transparent"></div>
    </div>
    
    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
        <div class="inline-flex items-center px-2.5 py-1 rounded-full border border-blue-500/30 bg-blue-500/10 text-blue-300 text-xs md:text-sm font-medium mb-4 md:mb-6">
            <span class="flex h-1.5 w-1.5 md:h-2 md:w-2 rounded-full bg-blue-400 mr-1.5 md:mr-2"></span>
            Premium Electronics & Robotics
        </div>
        <h1 class="text-3xl md:text-5xl font-bold text-white mb-4 md:mb-6">
            Electronics & Robotics <br class="hidden sm:block">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">Store</span>
        </h1>
        <p class="text-sm md:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed mb-6 md:mb-8 px-2">
            Discover cutting-edge components, development boards, and robotics kits for your next innovation
        </p>
        
        <!-- Search Bar -->
        <div class="max-w-3xl mx-auto">
            <div class="relative group">
                <!-- Search Input -->
                <div class="relative bg-white rounded-lg md:rounded-xl shadow-lg border-2 border-slate-200 hover:border-blue-400 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="pl-3 md:pl-5 pr-2 md:pr-3">
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="search-input"
                            placeholder="Search products..." 
                            class="flex-1 py-2.5 md:py-3.5 pr-2 md:pr-4 bg-transparent focus:outline-none text-sm md:text-base text-slate-900 placeholder-slate-400">
                        <button class="mr-1.5 md:mr-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-3 md:px-6 py-2 md:py-2.5 rounded-md md:rounded-lg font-semibold transition-all duration-300 hover:scale-105 shadow-md hover:shadow-lg text-xs md:text-sm">
                            Search
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Quick Search Tags -->
            <div class="flex flex-wrap justify-center gap-1.5 md:gap-2 mt-3 md:mt-4">
                <span class="text-xs text-slate-400 hidden sm:inline">Popular:</span>
                <button onclick="document.getElementById('search-input').value='Arduino'; searchProducts('Arduino');" class="text-xs bg-white/10 hover:bg-white/20 text-white px-2 md:px-2.5 py-0.5 md:py-1 rounded-full border border-white/20 hover:border-white/40 transition-all duration-200 font-medium backdrop-blur-sm">
                    Arduino
                </button>
                <button onclick="document.getElementById('search-input').value='Raspberry Pi'; searchProducts('Raspberry Pi');" class="text-xs bg-white/10 hover:bg-white/20 text-white px-2 md:px-2.5 py-0.5 md:py-1 rounded-full border border-white/20 hover:border-white/40 transition-all duration-200 font-medium backdrop-blur-sm">
                    Raspberry Pi
                </button>
                <button onclick="document.getElementById('search-input').value='ESP32'; searchProducts('ESP32');" class="text-xs bg-white/10 hover:bg-white/20 text-white px-2 md:px-2.5 py-0.5 md:py-1 rounded-full border border-white/20 hover:border-white/40 transition-all duration-200 font-medium backdrop-blur-sm">
                    ESP32
                </button>
                <button onclick="document.getElementById('search-input').value='Sensors'; searchProducts('Sensors');" class="text-xs bg-white/10 hover:bg-white/20 text-white px-2 md:px-2.5 py-0.5 md:py-1 rounded-full border border-white/20 hover:border-white/40 transition-all duration-200 font-medium backdrop-blur-sm">
                    Sensors
                </button>
            </div>
        </div>
    </div>
</section>

<main class="pb-16 md:pb-24 min-h-screen bg-slate-100">
    <div class="container mx-auto px-3 md:px-4 pt-4 md:pt-8 max-w-6xl">

        <!-- Active Filters -->
        <div id="active-filters" class="mb-3 md:mb-4"></div>

        <!-- Main Content -->
        <div class="grid lg:grid-cols-4 gap-4 md:gap-6">
            
            <!-- Category Sidebar -->
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-20">
                    <!-- Mobile Toggle Button -->
                    <button onclick="toggleCategories()" class="lg:hidden w-full bg-yale-blue-500 text-white px-4 py-2.5 rounded-lg font-semibold mb-3 flex items-center justify-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        Categories
                    </button>

                    <!-- Categories -->
                    <div id="category-sidebar" class="lg:translate-x-0 -translate-x-full fixed lg:static top-16 bottom-0 left-0 z-40 w-64 lg:w-auto bg-white lg:bg-transparent p-4 lg:p-0 transition-transform duration-300 shadow-xl lg:shadow-none overflow-y-auto">
                        <div class="lg:hidden flex justify-between items-center mb-4 pb-3 border-b sticky top-0 bg-white z-10">
                            <h3 class="font-bold text-base">Categories</h3>
                            <button onclick="toggleCategories()" class="text-slate-600 hover:text-slate-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <h3 class="hidden lg:block font-bold text-base text-prussian-blue-900 mb-3">Categories</h3>
                        <div id="categories-list" class="space-y-1">
                            <!-- Categories will be rendered by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
                    <!-- Products will be rendered by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</main>

    </div>
</main>

<!-- Cart Sidebar -->
<div id="cart-sidebar" class="fixed inset-0 bg-black/50 z-50 translate-x-full transition-transform duration-300" onclick="if(event.target === this) toggleCart()">
    <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-2xl flex flex-col">
        <!-- Cart Header -->
        <div class="p-6 border-b border-platinum-200 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-prussian-blue-900 font-exo">Shopping Cart</h2>
            <button onclick="toggleCart()" class="text-platinum-600 hover:text-prussian-blue-900 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Cart Items -->
        <div id="cart-items" class="flex-1 overflow-y-auto p-6 space-y-3">
            <!-- Cart items will be rendered by JavaScript -->
        </div>

        <!-- Cart Footer -->
        <div class="p-6 border-t border-platinum-200 bg-platinum-50">
            <div class="flex justify-between items-center mb-4">
                <span class="text-lg font-semibold text-prussian-blue-900">Subtotal:</span>
                <span id="cart-subtotal" class="text-2xl font-bold text-yale-blue-600">৳0</span>
            </div>
            <a href="#/checkout" onclick="toggleCart()" class="block w-full bg-yale-blue-500 hover:bg-yale-blue-600 text-white text-center px-6 py-4 rounded-lg font-bold text-lg transition-all duration-300 hover:scale-105 mb-3">
                Proceed to Checkout
            </a>
            <button onclick="toggleCart()" class="w-full bg-platinum-200 hover:bg-platinum-300 text-prussian-blue-900 px-6 py-3 rounded-lg font-semibold transition-all duration-300">
                Continue Shopping
            </button>
        </div>
    </div>
</div>

<!-- Product Modal -->
<div id="product-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4" onclick="if(event.target === this) closeProductModal()">
    <div class="bg-white rounded-2xl shadow-2xl max-w-5xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-platinum-200 p-6 flex justify-between items-center z-10">
            <h2 class="text-2xl font-bold text-prussian-blue-900 font-exo">Product Details</h2>
            <button onclick="closeProductModal()" class="text-platinum-600 hover:text-prussian-blue-900 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="modal-content" class="p-6">
            <!-- Modal content will be rendered by JavaScript -->
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

<script src="../js/store.js"></script>

<script>
// Export for router
window.initStore = initStore;
</script>

</body>
</html>
