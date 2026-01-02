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

<!-- Hero Section -->
<section class="relative pt-32 pb-20 overflow-hidden bg-slate-900">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-blue-900/20 to-slate-900"></div>
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-blue-500/20 to-transparent"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
        <div class="inline-flex items-center px-3 py-1 rounded-full border border-blue-500/30 bg-blue-500/10 text-blue-300 text-sm font-medium mb-6">
            <span class="flex h-2 w-2 rounded-full bg-blue-400 mr-2"></span>
            Premium Electronics & Robotics
        </div>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
            Electronics & Robotics <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">Store</span>
        </h1>
        <p class="text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed mb-8">
            Discover cutting-edge components, development boards, and robotics kits for your next innovation
        </p>
        
        <!-- Search Bar -->
        <div class="max-w-3xl mx-auto">
            <div class="relative group">
                <!-- Search Input -->
                <div class="relative bg-white rounded-xl shadow-lg border-2 border-slate-200 hover:border-blue-400 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="pl-5 pr-3">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="search-input"
                            placeholder="Search for Arduino, Raspberry Pi, sensors..." 
                            class="flex-1 py-3.5 pr-4 bg-transparent focus:outline-none text-base text-slate-900 placeholder-slate-400">
                        <button class="mr-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-2.5 rounded-lg font-semibold transition-all duration-300 hover:scale-105 shadow-md hover:shadow-lg text-sm">
                            Search
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Quick Search Tags -->
            <div class="flex flex-wrap justify-center gap-2 mt-4">
                <span class="text-xs text-slate-400">Popular:</span>
                <button onclick="document.getElementById('search-input').value='Arduino'; searchProducts('Arduino');" class="text-xs bg-white/10 hover:bg-white/20 text-white px-2.5 py-1 rounded-full border border-white/20 hover:border-white/40 transition-all duration-200 font-medium backdrop-blur-sm">
                    Arduino
                </button>
                <button onclick="document.getElementById('search-input').value='Raspberry Pi'; searchProducts('Raspberry Pi');" class="text-xs bg-white/10 hover:bg-white/20 text-white px-2.5 py-1 rounded-full border border-white/20 hover:border-white/40 transition-all duration-200 font-medium backdrop-blur-sm">
                    Raspberry Pi
                </button>
                <button onclick="document.getElementById('search-input').value='ESP32'; searchProducts('ESP32');" class="text-xs bg-white/10 hover:bg-white/20 text-white px-2.5 py-1 rounded-full border border-white/20 hover:border-white/40 transition-all duration-200 font-medium backdrop-blur-sm">
                    ESP32
                </button>
                <button onclick="document.getElementById('search-input').value='Sensors'; searchProducts('Sensors');" class="text-xs bg-white/10 hover:bg-white/20 text-white px-2.5 py-1 rounded-full border border-white/20 hover:border-white/40 transition-all duration-200 font-medium backdrop-blur-sm">
                    Sensors
                </button>
            </div>
        </div>
    </div>
</section>

<main class="pb-24 min-h-screen bg-slate-100">
    <div class="container mx-auto px-4 pt-8">

        <!-- Active Filters -->
        <div id="active-filters" class="max-w-6xl mx-auto"></div>

        <!-- Main Content -->
        <div class="grid lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
            
            <!-- Category Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-24">
                    <!-- Mobile Toggle Button -->
                    <button onclick="toggleCategories()" class="lg:hidden w-full bg-yale-blue-500 text-white px-4 py-3 rounded-lg font-semibold mb-4 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        Categories
                    </button>

                    <!-- Categories -->
                    <div id="category-sidebar" class="lg:translate-x-0 -translate-x-full fixed lg:static inset-y-0 left-0 z-40 w-64 lg:w-auto bg-platinum-50 lg:bg-transparent p-4 lg:p-0 transition-transform duration-300">
                        <div class="lg:hidden flex justify-between items-center mb-4">
                            <h3 class="font-bold text-lg">Categories</h3>
                            <button onclick="toggleCategories()" class="text-platinum-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <h3 class="hidden lg:block font-bold text-lg text-prussian-blue-900 mb-4">Categories</h3>
                        <div id="categories-list" class="space-y-1">
                            <!-- Categories will be rendered by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Products will be rendered by JavaScript -->
                </div>
            </div>
        </div>
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
