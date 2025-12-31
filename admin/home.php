<?php
require_once '../includes/auth.php';
$auth->requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - Frequency Lab Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'prussian-blue': {
                            900: '#0B1423',
                            950: '#050A11',
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-exo { font-family: 'Exo 2', sans-serif; }
    </style>
</head>
<body class="bg-prussian-blue-950 min-h-screen text-slate-300">

<div class="flex h-screen overflow-hidden relative">
    
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden relative z-10">
        <?php include 'includes/mobile_header.php'; ?>

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-transparent p-4 md:p-8 scrollbar-thin scrollbar-thumb-slate-700 scrollbar-track-transparent">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white font-exo">Home Page Management</h1>
                <p class="text-slate-400 mt-1">Manage hero section, partners, and testimonials.</p>
            </div>

            <!-- Content Area Placeholder -->
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-12 flex flex-col items-center justify-center text-center min-h-[400px]">
                <div class="p-4 bg-white/5 rounded-full mb-4">
                    <svg class="w-12 h-12 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">Coming Soon</h3>
                <p class="text-slate-400 max-w-md">This module is currently under development. You will soon be able to manage the home page content from here.</p>
            </div>

        </main>
    </div>
</div>

</body>
</html>
