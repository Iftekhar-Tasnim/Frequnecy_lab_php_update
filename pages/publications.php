<?php 
include '../includes/navbar.php'; 
require_once '../config/db.php';

// Fetch Filters
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Build Query
$where_clauses = ["1=1"];
$params = [];

if ($search) {
    $where_clauses[] = "(title LIKE ? OR authors LIKE ? OR abstract LIKE ? OR tags LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$where_sql = implode(' AND ', $where_clauses);
$sql = "SELECT * FROM publications WHERE $where_sql ORDER BY is_featured DESC, publication_date DESC, id DESC";
$all_pubs = [];

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $all_pubs = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log("Error fetching publications: " . $e->getMessage());
}

// Group by Type
$profiles = array_filter($all_pubs, fn($p) => $p['type'] === 'profile');
$journals = array_filter($all_pubs, fn($p) => $p['type'] === 'journal');
$articles = array_filter($all_pubs, fn($p) => in_array($p['type'], ['article', 'conference', 'thesis']));
?>

<!DOCTYPE html>
<html lang="en" data-theme="f-lab">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publications | Frequency Lab</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
            padding-right: 1.5rem;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 8px;
            right: 0;
            width: 8px;
            height: 8px;
            background-color: #0ea5e9; /* fresh-sky-500 */
            border-radius: 50%;
        }
        .section-title::before {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, #e2e8f0 0%, transparent 100%);
        }
    </style>
</head>
<body class="bg-white font-sans selection:bg-yale-blue-500 selection:text-white">

<main class="min-h-screen">
    
    <!-- Section: Hero (Slate-50 + Decor) -->
    <section class="pt-32 pb-20 bg-slate-50 relative overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute inset-0 pointer-events-none z-0">
            <div class="absolute top-[-10%] right-[-10%] w-[800px] h-[800px] bg-sky-400/10 rounded-full blur-[100px] mix-blend-multiply"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[600px] h-[600px] bg-yale-blue-600/10 rounded-full blur-[120px] mix-blend-multiply"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Hero Content -->
            <div class="text-center space-y-8 mb-12">
                <div class="inline-block px-4 py-1.5 bg-yale-blue-50 text-yale-blue-700 rounded-full text-xs font-bold tracking-widest uppercase border border-yale-blue-100">
                    Research & Impact
                </div>
                <h1 class="text-5xl md:text-7xl font-bold text-slate-900 font-exo tracking-tight">
                    Knowledge & <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-yale-blue-600 to-fresh-sky-500">Insights</span>
                </h1>
                <p class="text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed">
                    Exploring the frontiers of technology through rigorous research, academic publications, and innovative articles.
                </p>

                <!-- Search Bar -->
                <div class="max-w-xl mx-auto mt-8 relative z-10">
                    <form onsubmit="event.preventDefault(); const query = this.search.value; window.location.hash = '/publications?search=' + encodeURIComponent(query);" class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-yale-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                               placeholder="Search titles, authors, or abstract..." 
                               class="block w-full pl-14 pr-6 py-4 bg-white border border-slate-200 rounded-full shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] text-slate-700 placeholder-slate-400 focus:ring-4 focus:ring-yale-blue-500/10 focus:border-yale-blue-500 transition-all outline-none text-base">
                        <?php if($search): ?>
                            <a href="#/publications" onclick="event.preventDefault(); window.location.hash = '/publications';" class="absolute inset-y-0 right-4 flex items-center text-slate-400 hover:text-slate-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <?php if (empty($all_pubs)): ?>
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-slate-900">No publications found</h3>
                    <p class="text-slate-500 mt-1">Try adjusting your search criteria.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Section: Research Profiles (White BG) -->
    <?php if (!empty($profiles)): ?>
    <section class="py-24 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <span class="text-yale-blue-600 font-bold tracking-wider text-xs uppercase mb-2 block">Connect</span>
                <h2 class="text-3xl font-bold text-slate-900 section-title">Research Profiles</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach($profiles as $pub): ?>
                    <div class="group relative h-full"> 
                        <div class="absolute inset-0 bg-gradient-to-br from-yale-blue-50 to-white rounded-2xl border border-yale-blue-100/50 shadow-sm transition-all duration-300 hover:shadow-md hover:border-yale-blue-200 pointer-events-none"></div>
                        <div class="relative p-8 h-full flex flex-col items-center md:items-start text-center md:text-left gap-6">
                            <div class="flex flex-col md:flex-row gap-6 w-full items-center md:items-start">
                                <div class="flex-shrink-0 w-20 h-20 bg-white rounded-full shadow-sm border border-slate-100 flex items-center justify-center text-yale-blue-600 overflow-hidden">
                                     <?php if($pub['image_url']): ?>
                                        <img src="<?php echo htmlspecialchars($pub['image_url']); ?>" alt="" class="w-full h-full object-cover">
                                     <?php else: ?>
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                     <?php endif; ?>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-slate-900 mb-2"><?php echo htmlspecialchars($pub['title']); ?></h3>
                                    <?php if ($pub['abstract']): ?>
                                        <p class="text-slate-500 text-sm leading-relaxed mb-4"><?php echo htmlspecialchars($pub['abstract']); ?></p>
                                    <?php endif; ?>
                                    
                                    <div class="flex flex-wrap gap-3 justify-center md:justify-start z-10 relative">
                                        <a href="<?php echo $pub['link']; ?>" target="_blank" class="inline-flex items-center px-4 py-2 bg-yale-blue-600 text-white text-sm font-medium rounded-lg hover:bg-yale-blue-700 transition-colors shadow-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                            IEEE Profile
                                        </a>
                                        <?php if ($pub['pdf_url']): ?>
                                            <a href="<?php echo $pub['pdf_url']; ?>" target="_blank" class="inline-flex items-center px-4 py-2 bg-white text-slate-700 border border-slate-200 text-sm font-medium rounded-lg hover:bg-slate-50 hover:text-slate-900 transition-colors shadow-sm">
                                                <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                                Activities Portfolio
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Section: Journals (Slate-50 BG) -->
    <?php if (!empty($journals)): ?>
    <section class="py-24 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <span class="text-slate-500 font-bold tracking-wider text-xs uppercase mb-2 block">Published Works</span>
                <h2 class="text-3xl font-bold text-slate-900 section-title">Academic Journals</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($journals as $pub): ?>
                    <div class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(0,0,0,0.1)] hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
                        <div class="flex items-start justify-between mb-4">
                            <div class="p-2.5 bg-slate-50 text-slate-600 rounded-lg group-hover:bg-yale-blue-50 group-hover:text-yale-blue-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <?php if ($pub['publication_date']): ?>
                                <span class="text-xs font-semibold text-slate-400 border border-slate-100 px-2 py-1 rounded-md">
                                    <?php echo date('Y', strtotime($pub['publication_date'])); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-3 leading-snug group-hover:text-cyan-600 transition-colors line-clamp-3">
                            <a href="<?php echo $pub['link']; ?>" target="_blank" class="focus:outline-none">
                                <?php echo htmlspecialchars($pub['title']); ?>
                            </a>
                        </h3>
                        <?php if ($pub['abstract']): ?>
                            <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 mb-4 flex-1"><?php echo htmlspecialchars($pub['abstract']); ?></p>
                        <?php endif; ?>
                        <div class="pt-4 mt-auto border-t border-slate-100 flex items-center justify-between">
                            <a href="<?php echo $pub['link']; ?>" target="_blank" class="inline-flex items-center justify-center px-4 py-2 bg-white text-yale-blue-600 border border-yale-blue-200 text-sm font-medium rounded-lg hover:bg-yale-blue-50 transition-colors w-full group-hover:border-yale-blue-300">
                                Read Journal <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Section: Selected Articles (White BG) -->
    <?php if (!empty($articles)): ?>
    <section class="py-24 bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <span class="text-purple-600 font-bold tracking-wider text-xs uppercase mb-2 block">Highlights</span>
                <h2 class="text-3xl font-bold text-slate-900 section-title">Selected Articles</h2>
            </div>
            
            <div class="space-y-4">
                <?php foreach($articles as $pub): ?>
                    <div class="group bg-white rounded-2xl p-6 md:p-8 border border-slate-200 shadow-sm hover:shadow-xl hover:border-purple-100 transition-all duration-300">
                        <div class="flex flex-col md:flex-row gap-6 md:items-start">
                            
                            <!-- Date Column -->
                            <div class="flex-shrink-0 flex md:flex-col items-center gap-3 md:w-24 border-b md:border-b-0 md:border-r border-slate-100 pb-4 md:pb-0 md:pr-6">
                                <span class="text-4xl font-bold text-slate-200 group-hover:text-purple-200 transition-colors font-exo">
                                    <?php echo $pub['publication_date'] ? date('Y', strtotime($pub['publication_date'])) : '—'; ?>
                                </span>
                                <span class="text-[10px] uppercase font-bold tracking-wider text-slate-400 bg-slate-50 px-2 py-1 rounded">
                                    <?php echo ucfirst($pub['type']); ?>
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-purple-600 transition-colors">
                                    <a href="<?php echo $pub['link']; ?>" target="_blank" class="focus:outline-none">
                                        <?php echo htmlspecialchars($pub['title']); ?>
                                    </a>
                                </h3>
                                
                                <?php if ($pub['authors']): ?>
                                    <div class="flex items-center text-sm text-slate-500 mb-3">
                                        <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        <span class="truncate"><?php echo htmlspecialchars($pub['authors']); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($pub['abstract']): ?>
                                    <p class="text-slate-600 text-sm leading-7 line-clamp-2 group-hover:line-clamp-none transition-all duration-300">
                                        <?php echo htmlspecialchars($pub['abstract']); ?>
                                    </p>
                                <?php endif; ?>

                                <div class="mt-4 flex items-center justify-between md:justify-start gap-4">
                                    <?php if ($pub['publisher']): ?>
                                        <span class="inline-flex items-center text-xs font-semibold text-slate-400 bg-slate-50 px-2.5 py-1 rounded-md">
                                            <?php echo htmlspecialchars($pub['publisher']); ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <a href="<?php echo $pub['link']; ?>" target="_blank" class="inline-flex items-center px-4 py-2 bg-white text-slate-600 border border-slate-200 text-sm font-medium rounded-lg hover:border-yale-blue-500 hover:text-yale-blue-600 transition-all shadow-sm md:ml-auto whitespace-nowrap group-hover:shadow-md">
                                        Read Full Paper <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

</main>

<?php include '../includes/footer.php'; ?>

</body>
</html>
