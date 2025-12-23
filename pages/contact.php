<!DOCTYPE html>
<html lang="en" data-theme="f-lab">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Frequency Lab</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-white font-sans selection:bg-yale-blue-500 selection:text-white">

<?php include '../includes/navbar.php'; ?>

<main class="pt-32 pb-24 min-h-screen bg-platinum-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-8 mb-16">
            <div class="inline-block px-4 py-1.5 bg-yale-blue-100/50 text-yale-blue-700 rounded-full text-sm font-bold tracking-wider uppercase">
                Contact Us
            </div>
            <h1 class="text-5xl md:text-7xl font-bold text-prussian-blue-900 font-exo">
                Get in <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-yale-blue-600 to-fresh-sky-500">Touch</span>
            </h1>
            <p class="text-xl text-platinum-600 max-w-3xl mx-auto leading-relaxed">
                Have questions or want to collaborate? We'd love to hear from you.
            </p>
        </div>

        <div class="max-w-4xl mx-auto bg-white rounded-[3rem] shadow-xl shadow-prussian-blue-900/5 border border-platinum-100 overflow-hidden">
            <div class="grid md:grid-cols-5 h-full">
                <div class="md:col-span-2 bg-prussian-blue-900 p-12 text-white">
                    <h3 class="text-2xl font-bold mb-8">Contact Information</h3>
                    <ul class="space-y-6">
                        <li class="flex items-start gap-4">
                            <svg class="w-6 h-6 text-yale-blue-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <p>info@flabbd.com</p>
                        </li>
                        <li class="flex items-start gap-4">
                            <svg class="w-6 h-6 text-yale-blue-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <p>01886660098</p>
                        </li>
                    </ul>
                </div>
                <div class="md:col-span-3 p-12">
                    <div class="space-y-6 opacity-30 select-none pointer-events-none">
                        <div class="h-12 bg-platinum-100 rounded-xl w-full"></div>
                        <div class="h-12 bg-platinum-100 rounded-xl w-full"></div>
                        <div class="h-32 bg-platinum-100 rounded-xl w-full"></div>
                        <div class="h-12 bg-yale-blue-500 rounded-xl w-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>

</body>
</html>
