<!DOCTYPE html>
<html lang="en" data-theme="f-lab">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programmes | Frequency Lab</title>
    <meta name="description" content="Explore our robotics, coding, and STEM programmes for kids. After-school, weekend, and community workshops.">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Exo+2:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Exo 2', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-900 selection:bg-blue-600 selection:text-white">

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
            Our Curriculum
        </div>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
            Future-Ready <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">Educational Programmes</span>
        </h1>
        <p class="text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
            Empowering the next generation with hands-on skills in Robotics, Coding, and Electronics through our structured learning pathways.
        </p>
    </div>
</section>

<!-- Programmes Grid -->
<section class="py-20 bg-gradient-to-b from-slate-100 via-blue-50/30 to-slate-100 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Card 1: After-School -->
            <div class="group relative bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-blue-500 transform origin-top scale-y-0 group-hover:scale-y-100 transition-transform duration-300"></div>
                
                <div class="h-12 w-12 bg-blue-50 rounded-lg flex items-center justify-center mb-6 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                
                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">After-School Program</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">
                    Specialized technology learning sessions after regular school hours, packed with hands-on coding, electronics, and robotics experiences.
                </p>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Daily 90-minute cohorts
                    </li>
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Mini projects every week
                    </li>
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Ideal for Grades 4-10
                    </li>
                </ul>

                <a href="contact.php" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors group/link">
                    Join Waitlist
                    <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <!-- Card 2: Weekend -->
            <div class="group relative bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-cyan-500 transform origin-top scale-y-0 group-hover:scale-y-100 transition-transform duration-300"></div>
                
                <div class="h-12 w-12 bg-cyan-50 rounded-lg flex items-center justify-center mb-6 text-cyan-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                
                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-cyan-600 transition-colors">Weekend Program</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">
                    Flexible weekend sessions deepen STEM learning through project-based activities, teamwork, and innovation challenges.
                </p>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-cyan-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Saturday & Sunday batches
                    </li>
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-cyan-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Project showcases quarterly
                    </li>
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-cyan-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Focus on critical thinking
                    </li>
                </ul>

                <a href="contact.php" class="inline-flex items-center text-sm font-semibold text-cyan-600 hover:text-cyan-700 transition-colors group/link">
                    Enroll Now
                    <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <!-- Card 3: Community -->
            <div class="group relative bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-emerald-500 transform origin-top scale-y-0 group-hover:scale-y-100 transition-transform duration-300"></div>
                
                <div class="h-12 w-12 bg-emerald-50 rounded-lg flex items-center justify-center mb-6 text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                
                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-emerald-600 transition-colors">Community Program</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">
                    Localized learning initiatives bring STEM education directly to communities, especially in underserved areas that need access most.
                </p>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-emerald-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Pop-up labs & mobile kits
                    </li>
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-emerald-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Parent-community engagement
                    </li>
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-emerald-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Context-aware curriculum
                    </li>
                </ul>

                <a href="contact.php" class="inline-flex items-center text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition-colors group/link">
                    Partner With Us
                    <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <!-- Card 4: Robotics Club -->
            <div class="group relative bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-violet-500 transform origin-top scale-y-0 group-hover:scale-y-100 transition-transform duration-300"></div>
                
                <div class="h-12 w-12 bg-violet-50 rounded-lg flex items-center justify-center mb-6 text-violet-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                
                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-violet-600 transition-colors">Robotics / Coding Club</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">
                    A dynamic club where students collaborate, innovate, and compete while building real-world robotics and coding projects.
                </p>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-violet-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Seasonal competitions
                    </li>
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-violet-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Peer mentoring pods
                    </li>
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-violet-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Access to advanced kits
                    </li>
                </ul>

                <a href="contact.php" class="inline-flex items-center text-sm font-semibold text-violet-600 hover:text-violet-700 transition-colors group/link">
                    Join the Club
                    <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <!-- Card 5: Workshop -->
            <div class="group relative bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-amber-500 transform origin-top scale-y-0 group-hover:scale-y-100 transition-transform duration-300"></div>
                
                <div class="h-12 w-12 bg-amber-50 rounded-lg flex items-center justify-center mb-6 text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                
                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-amber-600 transition-colors">Workshop / Training</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">
                    Short-term, focused workshops on STEM topics such as IoT device building, AI basics, and robotics to accelerate skills quickly.
                </p>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-amber-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        1-3 day intensives
                    </li>
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-amber-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Industry expert mentors
                    </li>
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-amber-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Certification on completion
                    </li>
                </ul>

                <a href="contact.php" class="inline-flex items-center text-sm font-semibold text-amber-600 hover:text-amber-700 transition-colors group/link">
                    View Schedule
                    <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <!-- Card 6: STEM -->
            <div class="group relative bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-rose-500 transform origin-top scale-y-0 group-hover:scale-y-100 transition-transform duration-300"></div>
                
                <div class="h-12 w-12 bg-rose-50 rounded-lg flex items-center justify-center mb-6 text-rose-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                
                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-rose-600 transition-colors">STEM Program</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">
                    A structured curriculum offering comprehensive Science, Technology, Engineering, and Mathematics education through interactive problem solving.
                </p>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-rose-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Semester-aligned modules
                    </li>
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-rose-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Real-world design challenges
                    </li>
                    <li class="flex items-start text-sm text-slate-500">
                        <svg class="w-5 h-5 text-rose-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Continuous assessment
                    </li>
                </ul>

                <a href="contact.php" class="inline-flex items-center text-sm font-semibold text-rose-600 hover:text-rose-700 transition-colors group/link">
                    Get Details
                    <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-b from-slate-100 to-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-gradient-to-br from-blue-900 to-slate-900 rounded-3xl overflow-hidden shadow-2xl">
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-blue-600/20 mix-blend-multiply"></div>
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
            </div>
            
            <div class="relative px-8 py-16 md:py-20 text-center max-w-3xl mx-auto z-10">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-6 font-exo">Ready to Start Learning?</h2>
                <p class="text-lg text-blue-100 mb-8 leading-relaxed">
                    Join hundreds of students who are building the future with Frequency Lab. 
                    Whether you're a beginner or an advanced coder, we have a spot for you.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="contact.php" class="inline-flex justify-center items-center px-8 py-3.5 border border-transparent text-base font-semibold rounded-lg text-blue-900 bg-white hover:bg-blue-50 transition-colors shadow-lg">
                        Enroll Now
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>

</body>
</html>
