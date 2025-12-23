<!DOCTYPE html>
<html lang="en" data-theme="f-lab">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequency Lab | Feel the Magic of Technology</title>
    
    <!-- Meta Tags -->
    <meta name="description" content="Frequency Lab offers hands-on coding, robotics, and STEM education in Bangladesh. Learn robotics, Arduino, and coding with fun.">
    <link rel="icon" type="image/png" href="assets/logo/F_Lab logo Badge.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-white selection:bg-yale-blue-500 selection:text-white">

    <!-- Navigation -->
    <nav id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
        <div class="absolute inset-0 bg-prussian-blue-950/80 backdrop-blur-xl border-b border-white/5"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-4">
                    <a href="#/" class="flex items-center gap-3">
                        <img src="assets/logo/F_Lab logo Badge.png" alt="Logo" class="h-10 w-10">
                        <img src="assets/logo/F_Lab logo(full name).png" alt="Frequency Lab" class="h-12 hidden sm:block">
                    </a>
                </div>
                
                <!-- Desktop Nav -->
                <div class="hidden lg:flex items-center gap-2">
                    <a href="#/" class="nav-link text-white font-medium">Home<span class="nav-indicator"></span></a>
                    <a href="#/about" class="nav-link text-white font-medium">About<span class="nav-indicator"></span></a>
                    <a href="#/programmes" class="nav-link text-white font-medium">Programmes<span class="nav-indicator"></span></a>
                    <a href="#/publications" class="nav-link text-white font-medium">Publications<span class="nav-indicator"></span></a>
                    <a href="#/team" class="nav-link text-white font-medium">Team<span class="nav-indicator"></span></a>
                    <a href="#/gallery" class="nav-link text-white font-medium">Gallery<span class="nav-indicator"></span></a>
                    <a href="#/shop" class="nav-link text-white font-medium">Shop<span class="nav-indicator"></span></a>
                    <a href="#/contact" class="ml-4 btn-premium">Contact Us</a>
                </div>

                <!-- Mobile menu button -->
                <button id="mobile-menu-btn" class="lg:hidden text-white p-2">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-prussian-blue-950 border-t border-white/5">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="#/" class="block px-3 py-4 text-white hover:bg-white/5 font-exo">Home</a>
                <a href="#/about" class="block px-3 py-4 text-white hover:bg-white/5 font-exo">About</a>
                <a href="#/programmes" class="block px-3 py-4 text-white hover:bg-white/5 font-exo">Programmes</a>
                <a href="#/publications" class="block px-3 py-4 text-white hover:bg-white/5 font-exo">Publications</a>
                <a href="#/team" class="block px-3 py-4 text-white hover:bg-white/5 font-exo">Team</a>
                <a href="#/gallery" class="block px-3 py-4 text-white hover:bg-white/5 font-exo">Gallery</a>
                <a href="#/shop" class="block px-3 py-4 text-white hover:bg-white/5 font-exo">Shop</a>
                <a href="#/contact" class="block px-3 py-4 text-yale-blue-400 font-bold font-exo">Contact Us</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <!-- Carousel Simulated Background -->
        <div class="absolute inset-0 z-0 scrollbar-hide">
            <div class="carousel w-full h-full flex scroll-smooth snap-x snap-mandatory overflow-x-auto scrollbar-hide">
                <div id="slide1" class="carousel-item relative w-full h-full flex-shrink-0 snap-center">
                    <img src="assets/hero/image1.png" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/50"></div>
                </div>
                <div id="slide2" class="carousel-item relative w-full h-full flex-shrink-0 snap-center">
                    <img src="assets/hero/image2.jpg" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/50"></div>
                </div>
            </div>
        </div>

        <div class="relative z-10 text-center px-4">
            <h1 class="text-5xl md:text-7xl lg:text-8xl text-white mb-6 animate-fade-in drop-shadow-2xl">
                Feel the Magic of <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-yale-blue-400 to-fresh-sky-400">Technology</span>
            </h1>
            <p class="text-xl md:text-2xl text-platinum-200 mb-10 max-w-3xl mx-auto font-light leading-relaxed">
                Empowering the next generation of innovators in Bangladesh through Coding, Electronics, and Robotics.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#/programmes" class="btn-premium">Explore Programmes</a>
                <a href="#/about" class="px-8 py-3 rounded-full border border-white/30 text-white font-bold hover:bg-white/10 transition-all backdrop-blur-md">Learn More</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-24 bg-platinum-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="inline-block px-4 py-1.5 bg-yale-blue-100/50 text-yale-blue-700 rounded-full text-sm font-bold tracking-wider uppercase">
                        About Frequency Lab
                    </div>
                    <h2 class="text-4xl md:text-5xl text-prussian-blue-900 leading-tight">
                        Pioneering STEM Education <br>in <span class="text-yale-blue-600 underline decoration-yale-blue-200 underline-offset-8">Bangladesh</span>
                    </h2>
                    <p class="text-lg text-platinum-600 leading-relaxed">
                        Frequency Lab is a Bangladesh-based EdTech social enterprise dedicated to nurturing a new generation of technology innovators. As the <span class="text-yale-blue-600 font-bold">first of its kind in Bangladesh</span>, we empower youth through Coding, Electronics, and Robotics.
                    </p>
                    
                    <!-- Stats / Features -->
                    <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="p-6 bg-white rounded-2xl shadow-sm border border-platinum-200/50 hover:shadow-xl hover:border-yale-blue-500/20 transition-all group">
                            <div class="w-12 h-12 bg-yale-blue-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-yale-blue-500 transition-all">
                                <svg class="w-6 h-6 text-yale-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-prussian-blue-900 mb-2">Coding</h3>
                            <p class="text-sm text-platinum-500">Learn programming fundamentals and build applications.</p>
                        </div>
                        <div class="p-6 bg-white rounded-2xl shadow-sm border border-platinum-200/50 hover:shadow-xl transition-all group">
                            <div class="w-12 h-12 bg-fresh-sky-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-fresh-sky-500">
                                <svg class="w-6 h-6 text-fresh-sky-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-prussian-blue-900 mb-2">Electronics</h3>
                            <p class="text-sm text-platinum-500"> circuit design and electronic systems development.</p>
                        </div>
                        <div class="p-6 bg-white rounded-2xl shadow-sm border border-platinum-200/50 hover:shadow-xl transition-all group">
                            <div class="w-12 h-12 bg-prussian-blue-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-prussian-blue-500">
                                <svg class="w-6 h-6 text-prussian-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-prussian-blue-900 mb-2">Robotics</h3>
                            <p class="text-sm text-platinum-500">Create intelligent robots and explore automation.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Image Side -->
                <div class="relative">
                    <div class="aspect-square rounded-3xl overflow-hidden shadow-2xl skew-y-3">
                        <img src="assets/hero/image2.jpg" alt="Active learning session" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700">
                    </div>
                    <div class="absolute -bottom-8 -left-8 bg-yale-blue-600 text-white p-8 rounded-3xl shadow-xl hidden md:block animate-pulse">
                        <div class="text-4xl font-black mb-1">First</div>
                        <div class="text-sm font-medium opacity-80 uppercase tracking-widest">In Bangladesh</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-prussian-blue-900 mb-4 font-exo">Partners & Affiliates</h2>
            <div class="w-20 h-1 bg-yale-blue-500 mx-auto mb-10"></div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 items-center opacity-70 hover:opacity-100 transition-opacity">
                <img src="assets/partners/phulki.jpg" alt="Phulki" class="h-12 w-auto mx-auto object-contain">
                <img src="assets/partners/aiub.png" alt="AIUB" class="h-16 w-auto mx-auto object-contain">
                <img src="assets/partners/cropped-pbgs-small.png" alt="PBGS" class="h-14 w-auto mx-auto object-contain">
                <img src="assets/partners/Rajshahi_University_School.png" alt="RU School" class="h-16 w-auto mx-auto object-contain">
                <img src="assets/partners/Bangladesh_Agriculture_University_logo.svg.png" alt="BAU" class="h-16 w-auto mx-auto object-contain">
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-24 bg-prussian-blue-900 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-yale-blue-500/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold font-exo mb-4">What Our Students Say</h2>
                <p class="text-platinum-300 max-w-2xl mx-auto">Hear from the young innovators who are shaping their future with us.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white/5 backdrop-blur-md p-8 rounded-3xl border border-white/10 hover:border-yale-blue-500 transition-all group">
                    <div class="flex gap-1 text-yellow-400 mb-6">
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                    </div>
                    <p class="text-platinum-200 italic mb-8">"Learning robotics at Frequency Lab has been amazing! Complex concepts are made easy to understand."</p>
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 bg-yale-blue-500 rounded-full flex items-center justify-center font-bold">A</div>
                        <div>
                            <p class="font-bold">Anika Rahman</p>
                            <p class="text-sm text-platinum-400">Robotics Student</p>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white/5 backdrop-blur-md p-8 rounded-3xl border border-white/10 hover:border-yale-blue-500 transition-all group">
                    <div class="flex gap-1 text-yellow-400 mb-6">
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                    </div>
                    <p class="text-platinum-200 italic mb-8">"The coding classes helped me develop my first mobile app! I never thought I could do this at my age."</p>
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 bg-fresh-sky-500 rounded-full flex items-center justify-center font-bold">R</div>
                        <div>
                            <p class="font-bold">Rafiq Ahmed</p>
                            <p class="text-sm text-platinum-400">Coding Student</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white/5 backdrop-blur-md p-8 rounded-3xl border border-white/10 hover:border-yale-blue-500 transition-all group">
                    <div class="flex gap-1 text-yellow-400 mb-6">
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                    </div>
                    <p class="text-platinum-200 italic mb-8">"My daughter loves the electronics course! She's learning practical skills while having fun."</p>
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 bg-platinum-500 rounded-full flex items-center justify-center font-bold">S</div>
                        <div>
                            <p class="font-bold">Sadia Karim</p>
                            <p class="text-sm text-platinum-400">Parent</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-prussian-blue-950 text-white pt-16 pb-12 border-t border-white/5 font-inter">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Footer Content Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 mb-12">
                
                <!-- Column 1: Brand -->
                <div class="space-y-8">
                    <div class="flex items-center gap-4">
                        <img src="assets/logo/flab_logo.jpg" alt="F Lab Logo" class="h-14 w-14 rounded-xl shadow-2xl">
                        <div>
                            <h3 class="text-2xl font-bold text-white tracking-tight">Frequency Lab</h3>
                            <p class="text-[10px] text-fresh-sky-500 font-bold uppercase tracking-[0.2em] mt-2">Innovate. Learn. Create.</p>
                        </div>
                    </div>
                    <p class="text-platinum-400 text-sm leading-relaxed max-w-sm">
                        Empowering young innovators to shape the future through Coding, Electronics, and Robotics education.
                    </p>
                    <div class="flex gap-3">
                        <a href="https://www.facebook.com/frequencylab.bd" target="_blank" class="w-10 h-10 bg-prussian-blue-900 border border-white/5 rounded-lg flex items-center justify-center hover:bg-yale-blue-500 transition-all group">
                            <svg class="w-5 h-5 text-platinum-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/company/frequency-lab-bd/" target="_blank" class="w-10 h-10 bg-prussian-blue-900 border border-white/5 rounded-lg flex items-center justify-center hover:bg-yale-blue-500 transition-all group">
                            <svg class="w-5 h-5 text-platinum-400 group-hover:text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        <a href="mailto:info@flabbd.com" class="w-10 h-10 bg-prussian-blue-900 border border-white/5 rounded-lg flex items-center justify-center hover:bg-yale-blue-500 transition-all group">
                            <svg class="w-5 h-5 text-platinum-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-8 relative inline-block">
                        Quick Links
                        <span class="absolute -bottom-1 left-0 w-10 h-0.5 bg-fresh-sky-500"></span>
                    </h4>
                    <ul class="space-y-4">
                        <li><a href="#/" class="text-platinum-400 hover:text-white transition-all text-sm">Home</a></li>
                        <li><a href="#/about" class="text-platinum-400 hover:text-white transition-all text-sm">About Us</a></li>
                        <li><a href="#/programmes" class="text-platinum-400 hover:text-white transition-all text-sm">Programmes</a></li>
                        <li><a href="#/team" class="text-platinum-400 hover:text-white transition-all text-sm">Our Team</a></li>
                        <li><a href="#/gallery" class="text-platinum-400 hover:text-white transition-all text-sm">Gallery</a></li>
                    </ul>
                </div>

                <!-- Column 3: Contact -->
                <div class="space-y-8">
                    <h4 class="text-white font-bold text-lg mb-8 relative inline-block">
                        Get in Touch
                        <span class="absolute -bottom-1 left-0 w-10 h-0.5 bg-fresh-sky-500"></span>
                    </h4>
                    <ul class="space-y-5">
                        <li class="flex items-start gap-4 group">
                            <svg class="w-5 h-5 text-fresh-sky-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <a href="mailto:info@flabbd.com" class="text-platinum-400 hover:text-white transition-colors text-sm font-medium">info@flabbd.com</a>
                        </li>
                        <li class="flex items-start gap-4 group">
                            <svg class="w-5 h-5 text-fresh-sky-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <div class="space-y-1">
                                <p class="text-sm text-platinum-400"><span class="font-medium">Hotline:</span> <a href="tel:01886660098" class="hover:text-white transition-colors">01886660098</a></p>
                                <p class="text-sm text-platinum-400"><span class="font-medium">Phone:</span> <a href="tel:01886660098" class="hover:text-white transition-colors">01886660098</a> & <a href="tel:01886677379" class="hover:text-white transition-colors">01886677379</a></p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4 group">
                            <svg class="w-5 h-5 text-fresh-sky-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <p class="text-platinum-400 text-sm leading-relaxed">H-1/F, Rd-09, Block-C, Sec-12, Pallabi, Mirpur, Dhaka, Bangladesh</p>
                        </li>
                    </ul>
                    <div class="pt-6 border-t border-white/5">
                        <a href="#/publications" class="text-platinum-400 hover:text-fresh-sky-500 transition-colors text-xs uppercase tracking-widest font-bold">Publications</a>
                    </div>
                </div>
            </div>

            <!-- Copyright Bar -->
            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-platinum-500 text-[10px] uppercase tracking-[0.2em] font-bold">
                    &copy; 2024 <span class="text-white">Frequency Lab</span>. All rights reserved.
                </p>
                <div class="flex items-center gap-6 text-[10px] uppercase tracking-[0.2em] font-bold">
                    <a href="#/privacy-policy" class="text-platinum-500 hover:text-white transition-colors">Privacy Policy</a>
                    <span class="text-white/10">•</span>
                    <a href="#/safeguard" class="text-platinum-500 hover:text-white transition-colors">Safeguard Policy</a>
                    <span class="text-white/10">•</span>
                    <a href="#/contact" class="text-platinum-500 hover:text-white transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </footer>


    <script src="js/router.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
