<!DOCTYPE html>
<html lang="en" data-theme="f-lab">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequency Lab | Innovate. Learn. Create.</title>
    
    <!-- Meta Tags -->
    <meta name="description" content="Frequency Lab offers hands-on coding, robotics, and future-tech education in Bangladesh. Learn robotics, Arduino, and coding with fun.">
    <link rel="icon" type="image/png" href="assets/logo/F_Lab logo Badge.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-white font-sans selection:bg-yale-blue-500 selection:text-white">

    <!-- Navigation -->
    <?php $path = ''; include 'includes/navbar.php'; ?>

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
            <h1 class="text-5xl md:text-7xl lg:text-8xl text-white mb-6 animate-fade-in drop-shadow-2xl font-exo">
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
                    <h2 class="text-4xl md:text-5xl text-prussian-blue-900 leading-tight font-exo">
                        Pioneering Tech Education <br>in <span class="text-yale-blue-600 underline decoration-yale-blue-200 underline-offset-8">Bangladesh</span>
                    </h2>
                    <p class="text-lg text-platinum-600 leading-relaxed mb-4">
                        Frequency Lab is a Bangladesh-based education technology (EdTech) company and social enterprise dedicated to nurturing a new generation of technology innovators and developers.
                    </p>
                    <p class="text-lg text-platinum-600 leading-relaxed">
                        Frequency Lab empowers children and youth through Coding, Electronics, and Robotics education, helping bridge the gap between theoretical knowledge and real-world application.
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
                    <!-- New Badge -->
                    <div class="absolute -bottom-8 -left-8 bg-black/80 backdrop-blur-xl text-white p-6 rounded-3xl border border-white/10 shadow-2xl hidden md:block group animate-pulse hover:animate-none transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-yale-blue-500 rounded-xl flex items-center justify-center font-bold">FL</div>
                            <div>
                                <div class="text-[10px] text-yale-blue-400 font-bold uppercase tracking-widest mb-0.5">Frequency Lab</div>
                                <div class="text-lg font-black leading-none">Social Enterprise</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="py-24 bg-white overflow-hidden border-t border-platinum-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-prussian-blue-900 mb-4 font-exo">Partners & Affiliates</h2>
                
            </div>

            <!-- Infinite Marquee -->
            <div class="relative flex overflow-x-hidden group py-4">
                <div class="flex animate-marquee whitespace-nowrap gap-16 items-center">
                    <!-- First Set -->
                    <img src="assets/partners/aiub.png" alt="AIUB" class="h-15 w-auto object-contain transition-all duration-300">
                    <img src="assets/partners/phulki.jpg" alt="Phulki" class="h-15 w-auto object-contain transition-all duration-300">
                    <img src="assets/partners/cropped-pbgs-small.png" alt="PBGS" class="h-15 w-auto object-contain transition-all duration-300">
                    <img src="assets/partners/Rajshahi_University_School.png" alt="RU School" class="h-15 w-auto object-contain transition-all duration-300">
                    <img src="assets/partners/Bangladesh_Agriculture_University_logo.svg.png" alt="BAU" class="h-15 w-auto object-contain transition-all duration-300">
                    <img src="assets/partners/BRRI.jpg" alt="BRRI" class="h-15 w-auto object-contain transition-all duration-300">
                    <img src="assets/partners/BSRI.jpg" alt="BSRI" class="h-15 w-auto object-contain transition-all duration-300">
                    <img src="assets/partners/Godagari School and College.jfif" alt="Godagari" class="h-15 w-auto object-contain transition-all duration-300">
                    
                    <!-- Second Set (Duplicate for Loop) -->
                    <img src="assets/partners/aiub.png" alt="AIUB" class="h-15 w-auto object-contain transition-all duration-300">
                    <img src="assets/partners/phulki.jpg" alt="Phulki" class="h-15 w-auto object-contain transition-all duration-300">
                    <img src="assets/partners/cropped-pbgs-small.png" alt="PBGS" class="h-15 w-auto object-contain transition-all duration-300">
                    <img src="assets/partners/Rajshahi_University_School.png" alt="RU School" class="h-15 w-auto object-contain transition-all duration-300">
                    <img src="assets/partners/Bangladesh_Agriculture_University_logo.svg.png" alt="BAU" class="h-15 w-auto object-contain transition-all duration-300">
                    <img src="assets/partners/BRRI.jpg" alt="BRRI" class="h-15 w-auto object-contain transition-all duration-300">
                    <img src="assets/partners/BSRI.jpg" alt="BSRI" class="h-15 w-auto object-contain transition-all duration-300">
                    <img src="assets/partners/Godagari School and College.jfif" alt="Godagari" class="h-15 w-auto object-contain transition-all duration-300">
                </div>

                <!-- Gradient Overlays for Fade Effect -->
                <div class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-white to-transparent z-10"></div>
                <div class="absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-white to-transparent z-10"></div>
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
    <?php include 'includes/footer.php'; ?>


    <script src="js/router.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
