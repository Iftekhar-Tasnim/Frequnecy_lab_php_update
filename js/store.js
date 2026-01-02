// Store Product Data (Hardcoded)
const products = [
    // Robotics & Kits - Development Boards
    {
        id: 1,
        name: "Arduino Uno R3",
        category: "Robotics & Kits",
        subcategory: "Arduino",
        price: 850,
        image: "assets/products/arduino_uno_board_1767367072855.png",
        description: "The Arduino Uno R3 is a microcontroller board based on the ATmega328P. It's perfect for beginners and professionals alike.",
        specs: ["ATmega328P Microcontroller", "14 Digital I/O Pins", "6 Analog Inputs", "16 MHz Crystal Oscillator", "USB Connection"],
        inStock: true,
        featured: true
    },
    {
        id: 2,
        name: "Raspberry Pi 4 Model B (4GB)",
        category: "Robotics & Kits",
        subcategory: "Raspberry Pi",
        price: 6500,
        image: "assets/products/raspberry_pi_4_1767367088857.png",
        description: "A powerful single-board computer with 4GB RAM, perfect for IoT projects, media centers, and learning programming.",
        specs: ["Quad-core Cortex-A72", "4GB LPDDR4 RAM", "Dual 4K HDMI Output", "Gigabit Ethernet", "WiFi & Bluetooth 5.0"],
        inStock: true,
        featured: true
    },
    {
        id: 3,
        name: "ESP32 DevKit V1",
        category: "Robotics & Kits",
        subcategory: "ESP / IoT Boards",
        price: 550,
        image: "assets/products/esp32_devkit_1767367105677.png",
        description: "WiFi and Bluetooth enabled microcontroller, ideal for IoT projects and wireless applications.",
        specs: ["Dual-core 240MHz", "WiFi 802.11 b/g/n", "Bluetooth 4.2 & BLE", "34 GPIO Pins", "Built-in Antenna"],
        inStock: true,
        featured: true
    },
    {
        id: 4,
        name: "Arduino Starter Kit",
        category: "Robotics & Kits",
        subcategory: "Arduino",
        price: 3200,
        image: "assets/products/arduino_starter_kit_1767367437767.png",
        description: "Complete Arduino starter kit with board, sensors, LEDs, breadboard, and all components needed to start learning.",
        specs: ["Arduino Uno Board", "Breadboard & Jumper Wires", "15+ Sensors & Components", "Project Book Included", "Storage Case"],
        inStock: true,
        featured: false
    },

    // Robotics & Kits - Motors & Mechanical
    {
        id: 5,
        name: "SG90 Micro Servo Motor",
        category: "Robotics & Kits",
        subcategory: "Motors",
        price: 180,
        image: "assets/products/servo_motor_1767367158078.png",
        description: "Compact and lightweight servo motor, perfect for robotics projects and RC applications.",
        specs: ["Operating Voltage: 4.8-6V", "Torque: 1.8 kg/cm", "Speed: 0.1s/60°", "Weight: 9g", "180° Rotation"],
        inStock: true,
        featured: false
    },
    {
        id: 6,
        name: "NEMA 17 Stepper Motor",
        category: "Robotics & Kits",
        subcategory: "Motors",
        price: 1200,
        image: "assets/products/stepper_motor_1767367173664.png",
        description: "High-torque bipolar stepper motor, ideal for 3D printers, CNC machines, and precision robotics.",
        specs: ["1.8° Step Angle", "200 Steps/Revolution", "Holding Torque: 40 N·cm", "Rated Current: 1.5A", "4-Wire Bipolar"],
        inStock: true,
        featured: false
    },
    {
        id: 7,
        name: "L298N Motor Driver Module",
        category: "Robotics & Kits",
        subcategory: "Motor Drivers",
        price: 320,
        image: "assets/products/motor_driver_1767367263163.png",
        description: "Dual H-Bridge motor driver for controlling DC motors and stepper motors with Arduino.",
        specs: ["Drive 2 DC Motors", "Motor Voltage: 5-35V", "Max Current: 2A per channel", "Built-in 5V Regulator", "Heat Sink Included"],
        inStock: true,
        featured: false
    },
    {
        id: 8,
        name: "2WD Robot Car Chassis Kit",
        category: "Robotics & Kits",
        subcategory: "Chassis & Frames",
        price: 650,
        image: "assets/products/robot_chassis_1767367320083.png",
        description: "Complete 2-wheel drive robot chassis with motors, wheels, and battery holder.",
        specs: ["Acrylic Platform", "2x DC Gear Motors", "2x Rubber Wheels", "Battery Holder", "Easy Assembly"],
        inStock: true,
        featured: false
    },

    // Sensors & IoT
    {
        id: 9,
        name: "HC-SR04 Ultrasonic Sensor",
        category: "Sensors & IoT",
        subcategory: "Motion & Distance Sensors",
        price: 120,
        image: "assets/products/ultrasonic_sensor_1767367121260.png",
        description: "Ultrasonic distance sensor for obstacle detection and distance measurement (2cm-400cm).",
        specs: ["Range: 2cm - 400cm", "Accuracy: 3mm", "Operating Voltage: 5V", "Trigger Input: 10µs TTL", "Echo Output: TTL"],
        inStock: true,
        featured: false
    },
    {
        id: 10,
        name: "DHT22 Temperature & Humidity Sensor",
        category: "Sensors & IoT",
        subcategory: "Environmental Sensors",
        price: 280,
        image: "assets/products/dht22_sensor_1767367141459.png",
        description: "High-precision digital temperature and humidity sensor for weather stations and environmental monitoring.",
        specs: ["Temperature: -40 to 80°C", "Humidity: 0-100% RH", "Accuracy: ±0.5°C, ±2% RH", "Digital Output", "Low Power Consumption"],
        inStock: true,
        featured: false
    },
    {
        id: 11,
        name: "PIR Motion Sensor Module",
        category: "Sensors & IoT",
        subcategory: "Motion & Distance Sensors",
        price: 150,
        image: "assets/products/pir_sensor_1767367437767.png",
        description: "Passive infrared sensor for detecting human motion, ideal for security and automation projects.",
        specs: ["Detection Range: 7m", "Detection Angle: 120°", "Operating Voltage: 5-20V", "Adjustable Delay & Sensitivity", "Digital Output"],
        inStock: true,
        featured: false
    },
    {
        id: 12,
        name: "HC-05 Bluetooth Module",
        category: "Sensors & IoT",
        subcategory: "Bluetooth",
        price: 380,
        image: "assets/products/bluetooth_module_1767367285292.png",
        description: "Wireless Bluetooth serial communication module for Arduino and microcontroller projects.",
        specs: ["Bluetooth v2.0+EDR", "Range: 10m", "Baud Rate: 9600", "Operating Voltage: 3.3-5V", "Master/Slave Mode"],
        inStock: true,
        featured: false
    },
    {
        id: 13,
        name: "NEO-6M GPS Module",
        category: "Sensors & IoT",
        subcategory: "GSM & GPS",
        price: 850,
        image: "assets/products/gps_module_1767367301637.png",
        description: "GPS receiver module with ceramic antenna for location tracking and navigation projects.",
        specs: ["50 Channels", "Update Rate: 5Hz", "Position Accuracy: 2.5m", "UART Interface", "Built-in EEPROM"],
        inStock: true,
        featured: false
    },

    // Components & Displays
    {
        id: 14,
        name: "16x2 LCD Display (I2C)",
        category: "Components & Displays",
        subcategory: "LCD & OLED Displays",
        price: 420,
        image: "assets/products/lcd_display_1767367190240.png",
        description: "16x2 character LCD display with I2C interface for easy connection to microcontrollers.",
        specs: ["16 Characters x 2 Lines", "Blue Backlight", "I2C Interface (4 pins)", "Operating Voltage: 5V", "Adjustable Contrast"],
        inStock: true,
        featured: false
    },
    {
        id: 15,
        name: "0.96\" OLED Display",
        category: "Components & Displays",
        subcategory: "LCD & OLED Displays",
        price: 380,
        image: "assets/products/oled_display_1767367212005.png",
        description: "Small OLED display with high contrast and wide viewing angle, perfect for compact projects.",
        specs: ["128x64 Resolution", "I2C/SPI Interface", "White/Blue Display", "Operating Voltage: 3.3-5V", "Wide Viewing Angle"],
        inStock: true,
        featured: false
    },
    {
        id: 16,
        name: "WS2812B RGB LED Strip (1m)",
        category: "Components & Displays",
        subcategory: "LED Displays",
        price: 650,
        image: "assets/products/led_strip_1767367334513.png",
        description: "Addressable RGB LED strip with 60 LEDs per meter, individually controllable colors.",
        specs: ["60 LEDs/meter", "Individually Addressable", "5V Power Supply", "256 Brightness Levels", "Flexible PCB"],
        inStock: true,
        featured: false
    },
    {
        id: 17,
        name: "Resistor Kit (600pcs)",
        category: "Components & Displays",
        subcategory: "Resistors & Potentiometers",
        price: 450,
        image: "assets/products/resistor_kit_1767367415756.png",
        description: "Assorted resistor kit with 30 different values, organized in a storage box.",
        specs: ["600 Pieces Total", "30 Different Values", "1/4W Power Rating", "±1% Tolerance", "Storage Box Included"],
        inStock: true,
        featured: false
    },
    {
        id: 18,
        name: "4-Channel Relay Module",
        category: "Components & Displays",
        subcategory: "Switches & Relays",
        price: 480,
        image: "assets/products/relay_module_1767367437767.png",
        description: "4-channel relay module for controlling high-power devices with microcontrollers.",
        specs: ["4 Independent Channels", "10A 250VAC / 10A 30VDC", "Optocoupler Isolation", "LED Indicators", "Active Low Trigger"],
        inStock: true,
        featured: false
    },

    // Power & Tools
    {
        id: 19,
        name: "Soldering Iron Kit",
        category: "Power & Tools",
        subcategory: "Soldering Tools",
        price: 1200,
        image: "assets/products/soldering_kit_1767367362800.png",
        description: "Complete soldering kit with temperature-controlled iron, stand, and accessories.",
        specs: ["60W Adjustable Temperature", "200-450°C Range", "Iron Stand Included", "Solder Wire & Flux", "Desoldering Pump"],
        inStock: true,
        featured: false
    },
    {
        id: 20,
        name: "Breadboard 830 Points",
        category: "Power & Tools",
        subcategory: "Prototyping Materials",
        price: 180,
        image: "assets/products/breadboard_kit_1767367228628.png",
        description: "Solderless breadboard for prototyping electronic circuits without soldering.",
        specs: ["830 Tie Points", "2 Power Rails", "Self-adhesive Back", "ABS Plastic Base", "Standard Size"],
        inStock: true,
        featured: false
    },
    {
        id: 21,
        name: "Jumper Wire Set (120pcs)",
        category: "Power & Tools",
        subcategory: "Prototyping Materials",
        price: 220,
        image: "assets/products/jumper_wires_1767367247953.png",
        description: "Assorted jumper wires for breadboard and Arduino projects, male-to-male.",
        specs: ["120 Pieces", "Multiple Colors", "Male-to-Male", "22 AWG Wire", "10cm Length"],
        inStock: true,
        featured: false
    },
    {
        id: 22,
        name: "DC Power Supply Module",
        category: "Power & Tools",
        subcategory: "Voltage Regulation",
        price: 380,
        image: "assets/products/power_supply_1767367379535.png",
        description: "Adjustable step-down DC-DC converter with voltage and current display.",
        specs: ["Input: 6-40V DC", "Output: 1.25-36V DC", "Max Current: 5A", "Voltage/Current Display", "Over-current Protection"],
        inStock: true,
        featured: false
    },
    {
        id: 23,
        name: "18650 Battery Holder (4-Cell)",
        category: "Power & Tools",
        subcategory: "Batteries",
        price: 150,
        image: "assets/products/battery_pack_1767367394992.png",
        description: "Battery holder for 4x 18650 lithium-ion batteries with wire leads.",
        specs: ["Holds 4x 18650 Cells", "Series/Parallel Configuration", "Wire Leads Included", "Plastic Housing", "Snap-fit Design"],
        inStock: true,
        featured: false
    },
    {
        id: 24,
        name: "Digital Multimeter",
        category: "Power & Tools",
        subcategory: "Measurement Tools",
        price: 950,
        image: "assets/products/multimeter_1767367437767.png",
        description: "Digital multimeter for measuring voltage, current, resistance, and continuity.",
        specs: ["DC/AC Voltage", "DC/AC Current", "Resistance & Continuity", "Diode Test", "LCD Display"],
        inStock: true,
        featured: false
    }
];

// Categories structure
const categories = {
    "All Products": null,
    "Robotics & Kits": [
        "Arduino",
        "Raspberry Pi",
        "ESP / IoT Boards",
        "Motors",
        "Motor Drivers",
        "Chassis & Frames"
    ],
    "Sensors & IoT": [
        "Environmental Sensors",
        "Motion & Distance Sensors",
        "Bluetooth",
        "GSM & GPS"
    ],
    "Components & Displays": [
        "LCD & OLED Displays",
        "LED Displays",
        "Resistors & Potentiometers",
        "Switches & Relays"
    ],
    "Power & Tools": [
        "Soldering Tools",
        "Prototyping Materials",
        "Voltage Regulation",
        "Batteries",
        "Measurement Tools"
    ]
};

// Cart state
let cart = JSON.parse(localStorage.getItem('frequencyLabCart')) || [];

// Current filters
let currentCategory = "All Products";
let currentSubcategory = null;
let searchQuery = "";
let expandedCategory = null; // Track which category is expanded (for accordion behavior)

// Initialize store
function initStore() {
    // Refresh cart from storage in case it was modified elsewhere (e.g. checkout)
    try {
        cart = JSON.parse(localStorage.getItem('frequencyLabCart')) || [];
    } catch (e) {
        cart = [];
    }

    renderProducts();
    renderCategories();
    updateCartUI();
    setupEventListeners();
}

// Render products
function renderProducts() {
    const productsGrid = document.getElementById('products-grid');
    if (!productsGrid) return;

    const filteredProducts = getFilteredProducts();

    if (filteredProducts.length === 0) {
        productsGrid.innerHTML = `
            <div class="col-span-full text-center py-16">
                <svg class="w-24 h-24 text-platinum-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <p class="text-platinum-500 text-lg font-semibold">No products found</p>
                <p class="text-platinum-400 mt-2">Try adjusting your filters or search query</p>
            </div>
        `;
        return;
    }

    productsGrid.innerHTML = filteredProducts.map(product => `
        <div class="product-card bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group">
            <div class="relative overflow-hidden bg-platinum-50 aspect-square">
                <img src="${product.image}" 
                     alt="${product.name}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22400%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22400%22 height=%22400%22/%3E%3Ctext fill=%22%23999%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-family=%22Arial%22 font-size=%2220%22%3EProduct%3C/text%3E%3C/svg%3E'">
                ${product.featured ? '<span class="absolute top-2 left-2 bg-yale-blue-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">Featured</span>' : ''}
                ${!product.inStock ? '<span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">Out of Stock</span>' : ''}
                <a href="#/product/${product.id}" class="absolute inset-0 bg-black/0 hover:bg-black/20 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </a>
            </div>
            <div class="p-3">
                <p class="text-xs text-yale-blue-600 font-semibold mb-1">${product.subcategory}</p>
                <h3 class="text-sm font-bold text-prussian-blue-900 mb-1.5 line-clamp-2 min-h-[2.5rem]">${product.name}</h3>
                <p class="text-xs text-platinum-600 mb-3 line-clamp-2">${product.description}</p>
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold text-yale-blue-600">৳${product.price.toLocaleString()}</span>
                    <button onclick="addToCart(${product.id})" 
                            ${!product.inStock ? 'disabled' : ''}
                            class="bg-yale-blue-500 hover:bg-yale-blue-600 disabled:bg-platinum-300 disabled:cursor-not-allowed text-white px-3 py-1.5 rounded-lg font-semibold transition-all duration-300 hover:scale-105 flex items-center gap-1.5 text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Add
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

// Get filtered products
function getFilteredProducts() {
    return products.filter(product => {
        const matchesCategory = currentCategory === "All Products" || product.category === currentCategory;
        const matchesSubcategory = !currentSubcategory || product.subcategory === currentSubcategory;
        const matchesSearch = !searchQuery ||
            product.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
            product.description.toLowerCase().includes(searchQuery.toLowerCase());

        return matchesCategory && matchesSubcategory && matchesSearch;
    });
}

// Render categories
function renderCategories() {
    const categoriesContainer = document.getElementById('categories-list');
    if (!categoriesContainer) return;

    // Helper function to count products in a category/subcategory
    const getProductCount = (category, subcategory = null) => {
        return products.filter(p => {
            if (category === "All Products") return true;
            if (subcategory) return p.category === category && p.subcategory === subcategory;
            return p.category === category;
        }).length;
    };

    // Category icons mapping
    const categoryIcons = {
        "All Products": "M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z",
        "Robotics & Kits": "M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z",
        "Sensors & IoT": "M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z",
        "Components & Displays": "M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z",
        "Power & Tools": "M13 10V3L4 14h7v7l9-11h-7z"
    };

    categoriesContainer.innerHTML = Object.entries(categories).map(([category, subcategories]) => {
        const productCount = getProductCount(category);
        const isExpanded = expandedCategory === category;
        const isActiveFilter = currentCategory === category && !currentSubcategory;
        const icon = categoryIcons[category] || categoryIcons["All Products"];

        return `
        <div class="category-group mb-1.5">
            <button onclick="toggleCategory('${category}')" 
                    class="category-btn w-full text-left px-4 py-3 rounded-xl font-semibold transition-all duration-300 text-sm group relative overflow-hidden ${isActiveFilter
                ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30'
                : isExpanded
                    ? 'bg-blue-50 text-slate-800 border-2 border-blue-200 shadow-md'
                    : 'bg-white text-slate-800 hover:bg-blue-50 hover:shadow-md border border-slate-200'
            }">
                <!-- Background glow effect for active filter state -->
                ${isActiveFilter ? '<div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-cyan-400/20 animate-pulse"></div>' : ''}
                
                <div class="relative flex items-center gap-3">
                    <!-- Icon -->
                    <svg class="w-5 h-5 ${isActiveFilter ? 'text-white' : 'text-blue-500 group-hover:text-blue-600'} transition-colors flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${icon}"/>
                    </svg>
                    
                    <!-- Category name -->
                    <span class="flex-1">${category}</span>
                    
                    <!-- Product count badge -->
                    <span class="px-2 py-0.5 rounded-full text-xs font-bold ${isActiveFilter
                ? 'bg-white/20 text-white'
                : 'bg-blue-100 text-blue-700 group-hover:bg-blue-200'
            }">
                        ${productCount}
                    </span>
                    
                    <!-- Expand/collapse arrow -->
                    ${subcategories ? `
                        <svg class="w-4 h-4 transition-transform duration-300 ${isExpanded ? 'rotate-180' : ''} ${isActiveFilter ? 'text-white' : 'text-slate-400'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    ` : ''}
                </div>
            </button>
            
            ${subcategories ? `
                <div class="subcategories overflow-hidden transition-all duration-300 ${isExpanded ? 'max-h-96 mt-2' : 'max-h-0'}">
                    <div class="ml-4 pl-4 border-l-2 ${isExpanded ? 'border-blue-300' : 'border-slate-200'} space-y-1">
                        ${subcategories.map(sub => {
                const subCount = getProductCount(category, sub);
                const isSubActive = currentSubcategory === sub && currentCategory === category;

                return `
                            <button onclick="filterBySubcategory('${category}', '${sub}')"
                                    class="w-full text-left px-3 py-2 text-xs rounded-lg transition-all duration-200 group flex items-center justify-between ${isSubActive
                        ? 'bg-cyan-50 text-cyan-700 font-bold border border-cyan-200 shadow-sm'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'
                    }">
                                <span class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full ${isSubActive ? 'bg-cyan-500' : 'bg-slate-300 group-hover:bg-slate-400'}"></span>
                                    ${sub}
                                </span>
                                <span class="px-1.5 py-0.5 rounded-full text-xs font-semibold ${isSubActive
                        ? 'bg-cyan-100 text-cyan-700'
                        : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200'
                    }">
                                    ${subCount}
                                </span>
                            </button>
                        `}).join('')}
                    </div>
                </div>
            ` : ''}
        </div>
    `}).join('');
}

// Toggle category expansion (accordion behavior - no filtering)
function toggleCategory(category) {
    // "All Products" has no subcategories, so clicking it should filter
    if (category === "All Products") {
        currentCategory = "All Products";
        currentSubcategory = null;
        expandedCategory = null;
        renderProducts();
        renderCategories();
        updateActiveFilters();
        return;
    }

    // For other categories, just toggle expansion without filtering
    if (expandedCategory === category) {
        expandedCategory = null; // Collapse if already expanded
    } else {
        expandedCategory = category; // Expand the clicked category
    }

    renderCategories(); // Only re-render categories, don't filter products
}

// Filter by subcategory (this applies the actual filter)
function filterBySubcategory(category, subcategory) {
    currentCategory = category;
    currentSubcategory = subcategory;
    expandedCategory = category; // Keep the parent category expanded when a subcategory is selected
    renderProducts();
    renderCategories();
    updateActiveFilters();
}

function searchProducts(query) {
    searchQuery = query;
    renderProducts();
    updateActiveFilters();
}

function updateActiveFilters() {
    const filtersContainer = document.getElementById('active-filters');
    if (!filtersContainer) return;

    const filters = [];
    if (currentCategory !== "All Products") {
        filters.push(`Category: ${currentCategory}`);
    }
    if (currentSubcategory) {
        filters.push(`Subcategory: ${currentSubcategory}`);
    }
    if (searchQuery) {
        filters.push(`Search: "${searchQuery}"`);
    }

    if (filters.length === 0) {
        filtersContainer.innerHTML = '';
        return;
    }

    filtersContainer.innerHTML = `
        <div class="flex flex-wrap gap-2 mb-4">
            ${filters.map(filter => `
                <span class="bg-yale-blue-100 text-yale-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                    ${filter}
                </span>
            `).join('')}
            <button onclick="clearFilters()" class="text-red-500 hover:text-red-700 text-sm font-semibold underline">
                Clear All
            </button>
        </div>
    `;
}

function clearFilters() {
    currentCategory = "All Products";
    currentSubcategory = null;
    searchQuery = "";
    document.getElementById('search-input').value = "";
    renderProducts();
    renderCategories();
    updateActiveFilters();
}

// Cart functions
function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    if (!product || !product.inStock) return;

    const existingItem = cart.find(item => item.id === productId);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ ...product, quantity: 1 });
    }

    saveCart();
    updateCartUI();
    showCartNotification(product.name);
}

function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    saveCart();
    updateCartUI();
}

function updateQuantity(productId, change) {
    const item = cart.find(item => item.id === productId);
    if (!item) return;

    item.quantity += change;

    if (item.quantity <= 0) {
        removeFromCart(productId);
    } else {
        saveCart();
        updateCartUI();
    }
}

function saveCart() {
    localStorage.setItem('frequencyLabCart', JSON.stringify(cart));
}

function updateCartUI() {
    // Update cart count badge
    const cartCount = document.getElementById('cart-count');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

    if (cartCount) {
        cartCount.textContent = totalItems;
        cartCount.classList.toggle('hidden', totalItems === 0);
    }

    // Update cart sidebar
    const cartItems = document.getElementById('cart-items');
    const cartSubtotal = document.getElementById('cart-subtotal');

    if (!cartItems) return;

    if (cart.length === 0) {
        cartItems.innerHTML = `
            <div class="text-center py-12">
                <svg class="w-20 h-20 text-platinum-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <p class="text-platinum-500 font-semibold">Your cart is empty</p>
                <p class="text-platinum-400 text-sm mt-2">Add some products to get started!</p>
            </div>
        `;
        if (cartSubtotal) cartSubtotal.textContent = '৳0';
        return;
    }

    cartItems.innerHTML = cart.map(item => `
        <div class="flex gap-3 p-3 bg-white rounded-lg shadow-sm">
            <img src="${item.image}" 
                 alt="${item.name}" 
                 class="w-16 h-16 object-cover rounded-lg"
                 onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22100%22 height=%22100%22/%3E%3C/svg%3E'">
            <div class="flex-1 min-w-0">
                <h4 class="font-semibold text-prussian-blue-900 text-xs mb-1 truncate">${item.name}</h4>
                <p class="text-yale-blue-600 font-bold text-sm">৳${item.price.toLocaleString()}</p>
                <div class="flex items-center gap-1.5 mt-1.5">
                    <button onclick="updateQuantity(${item.id}, -1)" class="w-6 h-6 bg-platinum-200 hover:bg-platinum-300 rounded flex items-center justify-center font-bold text-sm">-</button>
                    <span class="w-6 text-center font-semibold text-xs">${item.quantity}</span>
                    <button onclick="updateQuantity(${item.id}, 1)" class="w-6 h-6 bg-yale-blue-500 hover:bg-yale-blue-600 text-white rounded flex items-center justify-center font-bold text-sm">+</button>
                    <button onclick="removeFromCart(${item.id})" class="ml-auto text-red-500 hover:text-red-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    `).join('');

    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    if (cartSubtotal) cartSubtotal.textContent = `৳${subtotal.toLocaleString()}`;
}

function toggleCart() {
    const cartSidebar = document.getElementById('cart-sidebar');
    if (cartSidebar) {
        cartSidebar.classList.toggle('translate-x-full');
    }
}

function showCartNotification(productName) {
    // Simple notification - you can enhance this
    const notification = document.createElement('div');
    notification.className = 'fixed top-24 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in-up';
    notification.innerHTML = `
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="font-semibold">Added to cart!</span>
        </div>
    `;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Product modal
function openProductModal(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;

    const modal = document.getElementById('product-modal');
    const modalContent = document.getElementById('modal-content');

    if (!modal || !modalContent) return;

    modalContent.innerHTML = `
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-platinum-50 rounded-xl p-8 flex items-center justify-center">
                <img src="${product.image}" 
                     alt="${product.name}" 
                     class="max-w-full max-h-96 object-contain"
                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22400%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22400%22 height=%22400%22/%3E%3Ctext fill=%22%23999%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-family=%22Arial%22 font-size=%2220%22%3EProduct Image%3C/text%3E%3C/svg%3E'">
            </div>
            <div>
                <p class="text-sm text-yale-blue-600 font-semibold mb-2">${product.category} / ${product.subcategory}</p>
                <h2 class="text-3xl font-bold text-prussian-blue-900 mb-4 font-exo">${product.name}</h2>
                <p class="text-platinum-700 mb-6">${product.description}</p>
                
                <div class="mb-6">
                    <h3 class="font-semibold text-prussian-blue-800 mb-3">Specifications:</h3>
                    <ul class="space-y-2">
                        ${product.specs.map(spec => `
                            <li class="flex items-start gap-2 text-sm text-platinum-700">
                                <svg class="w-5 h-5 text-yale-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                ${spec}
                            </li>
                        `).join('')}
                    </ul>
                </div>

                <div class="flex items-center justify-between mb-6 p-4 bg-yale-blue-50 rounded-lg">
                    <span class="text-3xl font-bold text-yale-blue-600">৳${product.price.toLocaleString()}</span>
                    <span class="text-sm font-semibold ${product.inStock ? 'text-green-600' : 'text-red-600'}">
                        ${product.inStock ? '✓ In Stock' : '✗ Out of Stock'}
                    </span>
                </div>

                <button onclick="addToCart(${product.id}); closeProductModal();" 
                        ${!product.inStock ? 'disabled' : ''}
                        class="w-full bg-yale-blue-500 hover:bg-yale-blue-600 disabled:bg-platinum-300 disabled:cursor-not-allowed text-white px-6 py-4 rounded-lg font-bold text-lg transition-all duration-300 hover:scale-105 flex items-center justify-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Add to Cart
                </button>
            </div>
        </div>
    `;

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeProductModal() {
    const modal = document.getElementById('product-modal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

// Mobile category toggle
function toggleCategories() {
    const sidebar = document.getElementById('category-sidebar');
    if (sidebar) {
        sidebar.classList.toggle('-translate-x-full');
    }
}

// Event listeners
function setupEventListeners() {
    // Search input
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            searchProducts(e.target.value);
        });
    }

    // Close modal on backdrop click
    const modal = document.getElementById('product-modal');
    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeProductModal();
            }
        });
    }

    // Close cart on backdrop click
    const cartSidebar = document.getElementById('cart-sidebar');
    if (cartSidebar) {
        cartSidebar.addEventListener('click', (e) => {
            if (e.target === cartSidebar) {
                toggleCart();
            }
        });
    }

    // Escape key to close modals
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeProductModal();
        }
    });
}

// Initialize on page load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initStore);
} else {
    initStore();
}

// Show individual product detail page
function showProductDetail(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) {
        window.location.hash = '/shop';
        return;
    }

    const mainContent = document.querySelector('main');
    if (!mainContent) return;

    // Get related products (same category, excluding current product)
    const relatedProducts = products
        .filter(p => p.category === product.category && p.id !== product.id)
        .slice(0, 4);

    // Hide hero section and replace entire main content
    mainContent.innerHTML = `
        <!-- Product Hero Section -->
        <section class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 py-4 md:py-6 -mt-8">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-cyan-600/10"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAxMCAwIEwgMCAwIDAgMTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS1vcGFjaXR5PSIwLjAzIiBzdHJva2Utd2lkdGg9IjEiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JpZCkiLz48L3N2Zz4=')] opacity-40"></div>
            
            <div class="container mx-auto px-4 relative z-10 max-w-6xl">
                <!-- Breadcrumb Navigation -->
                <nav class="flex items-center gap-2 text-xs mb-2 md:mb-3 overflow-x-auto">
                    <a href="#/shop" class="text-slate-400 hover:text-white transition-colors whitespace-nowrap">Shop</a>
                    <svg class="w-3 h-3 text-slate-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="#/shop" class="text-slate-400 hover:text-white transition-colors whitespace-nowrap truncate max-w-[100px] md:max-w-none">${product.category}</a>
                    <svg class="w-3 h-3 text-slate-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-white font-semibold truncate">${product.name}</span>
                </nav>

                <!-- Product Badge -->
                <div class="inline-flex items-center gap-1.5 bg-gradient-to-r from-blue-500/20 to-cyan-500/20 backdrop-blur-sm border border-blue-400/30 rounded-full px-2.5 py-1 mb-2 md:mb-3">
                    <span class="w-1.5 h-1.5 bg-cyan-400 rounded-full animate-pulse"></span>
                    <span class="text-cyan-300 text-xs font-semibold">${product.subcategory}</span>
                </div>

                <!-- Product Title -->
                <h1 class="text-xl md:text-2xl font-bold mb-2">
                    <span class="bg-gradient-to-r from-white via-blue-100 to-cyan-200 bg-clip-text text-transparent">
                        ${product.name}
                    </span>
                </h1>

                <!-- Quick Info -->
                <div class="flex flex-wrap items-center gap-2 md:gap-3 text-slate-300">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-xs font-semibold ${product.inStock ? 'text-green-400' : 'text-red-400'}">
                            ${product.inStock ? 'In Stock' : 'Out of Stock'}
                        </span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-base md:text-lg font-bold text-white">৳${product.price.toLocaleString()}</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Product Content -->
        <section class="py-4 md:py-6 bg-slate-50">
            <div class="container mx-auto px-4 max-w-6xl">
                <div class="grid lg:grid-cols-5 gap-3 md:gap-4 mb-5 md:mb-6">
                    <!-- Product Image (Left Column - Spans 2 on desktop) -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow-md p-3 md:p-4 lg:sticky lg:top-20">
                            <div class="bg-gradient-to-br from-slate-100 to-slate-200 rounded-lg p-3 md:p-4 mb-2 md:mb-3">
                                <img src="${product.image}" 
                                     alt="${product.name}" 
                                     class="w-full h-auto max-h-48 md:max-h-64 object-contain mx-auto"
                                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22400%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22400%22 height=%22400%22/%3E%3Ctext fill=%22%23999%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-family=%22Arial%22 font-size=%2220%22%3EProduct Image%3C/text%3E%3C/svg%3E'">
                            </div>
                            
                            <!-- Trust Badges -->
                            <div class="grid grid-cols-3 gap-1.5">
                                <div class="text-center p-1.5 bg-blue-50 rounded">
                                    <svg class="w-4 h-4 text-blue-600 mx-auto mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <p class="text-[9px] font-semibold text-slate-700">Authentic</p>
                                </div>
                                <div class="text-center p-1.5 bg-green-50 rounded">
                                    <svg class="w-4 h-4 text-green-600 mx-auto mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    <p class="text-[9px] font-semibold text-slate-700">Warranty</p>
                                </div>
                                <div class="text-center p-1.5 bg-cyan-50 rounded">
                                    <svg class="w-4 h-4 text-cyan-600 mx-auto mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                    <p class="text-[9px] font-semibold text-slate-700">Secure Pay</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Details (Right Column - Spans 3 on desktop) -->
                    <div class="lg:col-span-3 space-y-2.5 md:space-y-3">
                        <!-- Description Card -->
                        <div class="bg-white rounded-lg shadow-md p-2.5 md:p-3">
                            <h2 class="text-sm md:text-base font-bold text-slate-900 mb-1.5 md:mb-2 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Product Description</span>
                            </h2>
                            <p class="text-xs text-slate-700 leading-relaxed">${product.description}</p>
                        </div>

                        <!-- Specifications Card -->
                        <div class="bg-white rounded-lg shadow-md p-2.5 md:p-3">
                            <h2 class="text-sm md:text-base font-bold text-slate-900 mb-1.5 md:mb-2 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                                <span>Technical Specifications</span>
                            </h2>
                            <ul class="space-y-1">
                                ${product.specs.map(spec => `
                                    <li class="flex items-start gap-1.5 p-1.5 bg-slate-50 rounded hover:bg-blue-50 transition-colors">
                                        <svg class="w-3 h-3 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs text-slate-700">${spec}</span>
                                    </li>
                                `).join('')}
                            </ul>
                        </div>

                        <!-- Add to Cart Card -->
                        <div class="bg-gradient-to-br from-blue-600 to-cyan-600 rounded-lg shadow-lg p-2.5 md:p-3 text-white">
                            <div class="flex items-center justify-between mb-2 gap-2">
                                <div>
                                    <p class="text-blue-100 text-[9px] mb-0.5">Price</p>
                                    <p class="text-lg md:text-2xl font-bold">৳${product.price.toLocaleString()}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-blue-100 text-[9px] mb-0.5">Availability</p>
                                    <p class="text-xs md:text-sm font-bold ${product.inStock ? 'text-green-300' : 'text-red-300'}">
                                        ${product.inStock ? '✓ In Stock' : '✗ Out of Stock'}
                                    </p>
                                </div>
                            </div>
                            
                            <button onclick="addToCart(${product.id}); showCartNotification('${product.name}');" 
                                    ${!product.inStock ? 'disabled' : ''}
                                    class="w-full bg-white text-blue-600 hover:bg-blue-50 disabled:bg-slate-300 disabled:text-slate-500 disabled:cursor-not-allowed px-3 py-2 md:py-2.5 rounded-lg font-bold text-sm transition-all duration-300 hover:scale-105 hover:shadow-2xl flex items-center justify-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                ${product.inStock ? 'Add to Cart' : 'Out of Stock'}
                            </button>

                            <a href="#/shop" class="block text-center mt-1.5 md:mt-2 text-white/80 hover:text-white text-xs font-semibold transition-colors">
                                ← Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Related Products Section -->
                ${relatedProducts.length > 0 ? `
                    <div class="mt-5 md:mt-8 max-w-6xl mx-auto">
                        <div class="flex items-center justify-between mb-2.5 md:mb-4">
                            <h2 class="text-base md:text-xl font-bold text-slate-900">Related Products</h2>
                            <a href="#/shop" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-1 group text-xs">
                                <span class="hidden sm:inline">View All</span>
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2.5 md:gap-3">
                            ${relatedProducts.map(relatedProduct => `
                                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden group">
                                    <div class="relative overflow-hidden bg-slate-100 aspect-square">
                                        <img src="${relatedProduct.image}" 
                                             alt="${relatedProduct.name}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                             onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22400%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22400%22 height=%22400%22/%3E%3Ctext fill=%22%23999%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-family=%22Arial%22 font-size=%2220%22%3EProduct%3C/text%3E%3C/svg%3E'">
                                        <a href="#/product/${relatedProduct.id}" class="absolute inset-0 bg-black/0 hover:bg-black/20 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="p-2">
                                        <p class="text-[9px] text-blue-600 font-semibold mb-0.5 truncate">${relatedProduct.subcategory}</p>
                                        <h3 class="text-xs font-bold text-slate-900 mb-1 line-clamp-2 min-h-[2rem]">${relatedProduct.name}</h3>
                                        <div class="flex items-center justify-between gap-1.5">
                                            <span class="text-xs md:text-sm font-bold text-blue-600">৳${relatedProduct.price.toLocaleString()}</span>
                                            <button onclick="addToCart(${relatedProduct.id})" 
                                                    ${!relatedProduct.inStock ? 'disabled' : ''}
                                                    class="bg-blue-600 hover:bg-blue-700 disabled:bg-slate-300 disabled:cursor-not-allowed text-white p-1.5 rounded transition-all duration-300 hover:scale-110">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                ` : ''}
            </div>
        </section>
    `;

    // Update cart UI
    updateCartUI();

    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Export initStore for router
window.initStore = initStore;
window.showProductDetail = showProductDetail;
window.products = products;
