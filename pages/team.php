<?php
require_once '../config/db.php';

// Fetch Members Grouped by Category
$board_members = $pdo->query("SELECT * FROM team_members WHERE category='board' ORDER BY display_order ASC")->fetchAll(PDO::FETCH_ASSOC);
$advisors = $pdo->query("SELECT * FROM team_members WHERE category='advisor' ORDER BY display_order ASC")->fetchAll(PDO::FETCH_ASSOC);
$executives = $pdo->query("SELECT * FROM team_members WHERE category='executive' ORDER BY display_order ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" data-theme="f-lab">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Meet the passionate team of STEM educators, robotics trainers, and innovators at Frequency Lab.">
    
    <title>Meet Our Team | Frequency Lab</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Exo+2:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body class="font-sans antialiased text-platinum-900 bg-white selection:bg-yale-blue-500 selection:text-white">

    <?php include '../includes/navbar.php'; ?>

    <!-- Spacer for fixed navbar -->
    <div class="h-20"></div>

    <!-- Main Content -->
    <main class="min-h-screen bg-gradient-to-br from-platinum-50 via-yale-blue-50/50 to-fresh-sky-50/50 overflow-hidden relative">
        <!-- Abstract Shapes for Color -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-yale-blue-200/40 rounded-full blur-3xl -z-10 animate-float pointer-events-none"></div>
        <div class="absolute bottom-1/3 left-[-100px] w-[500px] h-[500px] bg-fresh-sky-200/40 rounded-full blur-3xl -z-10 animate-float pointer-events-none" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-0 right-[-100px] w-[600px] h-[600px] bg-prussian-blue-100/30 rounded-full blur-3xl -z-10 animate-float pointer-events-none" style="animation-delay: 4s;"></div>

        <!-- Board of Directors -->
        <?php if (!empty($board_members)): ?>
        <section class="container mx-auto px-4 py-16 md:py-20">
            <div class="text-center mb-12 animate-fade-in-up">
                <h2 class="text-3xl md:text-5xl font-bold text-prussian-blue-900 mb-4 font-exo">
                    Board of Directors
                </h2>
                <div class="w-20 h-1.5 bg-yale-blue-500 mx-auto rounded-full mb-6"></div>
                <p class="text-lg text-platinum-600 max-w-2xl mx-auto">
                    Visionary leaders shaping the future of education and innovation
                </p>
            </div>

            <div class="max-w-md mx-auto animate-fade-in-up" style="animation-delay: 0.2s;">
                <?php foreach ($board_members as $member): ?>
                <div class="bg-white rounded-2xl shadow-lg border border-platinum-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group mb-8">
                    <div class="aspect-square w-full overflow-hidden bg-platinum-100 relative">
                        <?php if (!empty($member['image_path'])): ?>
                            <img src="../<?php echo htmlspecialchars($member['image_path']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-400">No Image</div>
                        <?php endif; ?>
                    </div>
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bold text-prussian-blue-900 mb-2 font-exo">
                            <?php echo htmlspecialchars($member['name']); ?>
                        </h3>
                        <p class="text-lg text-yale-blue-600 font-bold mb-4 uppercase tracking-wider">
                            <?php echo htmlspecialchars($member['designation']); ?>
                        </p>
                        <p class="text-sm text-platinum-700 leading-relaxed max-w-sm mx-auto">
                            <?php echo htmlspecialchars($member['bio']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- Advisor Panel -->
        <?php if (!empty($advisors)): ?>
        <section class="container mx-auto px-4 py-12 md:py-16 animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-prussian-blue-900 mb-4 font-exo">
                    Advisor Panel
                </h2>
                <div class="w-16 h-1.5 bg-fresh-sky-500 mx-auto rounded-full mb-6"></div>
                <p class="text-lg text-platinum-600 max-w-2xl mx-auto">
                    Expert advisors providing strategic guidance and mentorship
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
                <?php foreach ($advisors as $member): ?>
                <div class="bg-white rounded-2xl shadow-lg border border-platinum-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group">
                    <div class="aspect-square w-full overflow-hidden bg-platinum-100 relative">
                        <?php if (!empty($member['image_path'])): ?>
                            <img src="../<?php echo htmlspecialchars($member['image_path']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-400">No Image</div>
                        <?php endif; ?>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-prussian-blue-900 mb-1 font-exo">
                            <?php echo htmlspecialchars($member['name']); ?>
                        </h3>
                        <p class="text-sm text-yale-blue-600 font-bold uppercase tracking-wider mb-2">
                            <?php echo htmlspecialchars($member['designation']); ?>
                        </p>
                        <p class="text-sm text-platinum-700 mb-4 font-medium">
                            <?php echo htmlspecialchars($member['bio']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- Executive Team -->
        <?php if (!empty($executives)): ?>
        <section class="container mx-auto px-4 py-16 md:py-24 pb-32 animate-fade-in-up" style="animation-delay: 0.6s;">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-prussian-blue-900 mb-6 font-exo">
                    Executive Team
                </h2>
                <div class="w-20 h-1.5 bg-yale-blue-500 mx-auto rounded-full mb-6"></div>
                <p class="text-lg text-platinum-600 max-w-2xl mx-auto">
                    A diverse team of facilitators, coordinators, and innovators
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
                <?php foreach ($executives as $member): ?>
                <div class="bg-white rounded-2xl shadow-lg border border-platinum-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group">
                    <div class="aspect-square w-full overflow-hidden bg-platinum-100">
                        <?php if (!empty($member['image_path'])): ?>
                            <img src="../<?php echo htmlspecialchars($member['image_path']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-400">No Image</div>
                        <?php endif; ?>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-lg font-bold text-prussian-blue-900 mb-1 font-exo">
                            <?php echo htmlspecialchars($member['name']); ?>
                        </h3>
                        <p class="text-sm text-yale-blue-600 font-semibold mb-2">
                            <?php echo htmlspecialchars($member['designation']); ?>
                        </p>
                        <p class="text-xs text-platinum-400">
                            <?php echo htmlspecialchars($member['bio']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>
        
        <!-- CTA Section -->
        <section class="bg-prussian-blue-900 py-12 md:py-16 text-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-2xl md:text-3xl font-bold mb-4 font-exo">Join Our Team</h2>
                <p class="text-base text-platinum-300 mb-8 max-w-2xl mx-auto">
                    We're always looking for passionate individuals to help shape the future of STEM education in Bangladesh.
                </p>
                <a href="#/contact" class="inline-block bg-yale-blue-600 hover:bg-yale-blue-500 text-white font-bold px-8 py-3 rounded-lg transition-colors duration-300">
                    Get in Touch
                </a>
            </div>
        </section>

    </main>

    <?php include '../includes/footer.php'; ?>

</body>
</html>
