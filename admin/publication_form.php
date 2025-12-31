<?php
require_once '../includes/auth.php';
require_once '../config/db.php';

// Auth Check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$pub = [
    'title' => '', 'type' => 'article', 'link' => '', 'publisher' => '', 
    'publication_date' => '', 'abstract' => '', 'authors' => '', 
    'tags' => '', 'is_featured' => 0, 'image_url' => '', 'pdf_url' => ''
];

// Load existing data
if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM publications WHERE id = ?");
    $stmt->execute([$id]);
    if ($stmt->rowCount() > 0) {
        $pub = $stmt->fetch();
        // Decode JSON tags to string for input
        $tags_array = json_decode($pub['tags'], true);
        $pub['tags'] = is_array($tags_array) ? implode(', ', $tags_array) : '';
    }
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $title = $_POST['title'];
    $link = $_POST['link'];
    $publisher = $_POST['publisher'];
    $publication_date = !empty($_POST['publication_date']) ? $_POST['publication_date'] : null;
    $abstract = $_POST['abstract'];
    $authors = $_POST['authors'];
    $image_url = $_POST['image_url'];
    
    // Handle File Upload
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $filename = $_FILES['image_file']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $new_filename = uniqid('pub_', true) . '.' . $ext;
            // Target: assets/uploads/publications (relative to root)
            // Admin is in /admin/ so we go up one level
            $upload_dir = '../assets/uploads/publications/';
            
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $dest_path = $upload_dir . $new_filename;
            
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $dest_path)) {
                // Save path relative to pages/ directory for consistency with previous data
                // Or better, save relative to root and handle ../ in view.
                // Current convention seems to be storing relative paths that work from pages/
                // If dest_path is '../assets/...', then for pages/publications.php it is also '../assets/...'
                $image_url = '../assets/uploads/publications/' . $new_filename;
            } else {
                $error = "Failed to move uploaded file.";
            }
        } else {
            $error = "Invalid file type. Only JPG, PNG, GIF, and WEBP are allowed.";
        }
    } elseif (empty($image_url)) {
        // If no new file and no manual URL, keep the old one
        $image_url = $_POST['current_image_url'];
    }

    $pdf_url = $_POST['pdf_url'];
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    
    // Process Tags
    $tags_input = explode(',', $_POST['tags']);
    $tags_clean = array_map('trim', $tags_input);
    $tags_clean = array_filter($tags_clean); // remove empty
    $tags_json = json_encode(array_values($tags_clean));

    try {
        if ($id > 0) {
            $sql = "UPDATE publications SET type=?, title=?, link=?, publisher=?, publication_date=?, abstract=?, authors=?, tags=?, image_url=?, pdf_url=?, is_featured=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$type, $title, $link, $publisher, $publication_date, $abstract, $authors, $tags_json, $image_url, $pdf_url, $is_featured, $id]);
        } else {
            $sql = "INSERT INTO publications (type, title, link, publisher, publication_date, abstract, authors, tags, image_url, pdf_url, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$type, $title, $link, $publisher, $publication_date, $abstract, $authors, $tags_json, $image_url, $pdf_url, $is_featured]);
        }
        echo "<script>window.location.href='publications.php';</script>";
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $id > 0 ? 'Edit' : 'Add'; ?> Publication - Frequency Lab Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen">
<div class="flex h-screen overflow-hidden">
    
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col overflow-hidden">
        <?php include 'includes/mobile_header.php'; ?>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-4 md:p-8">
            <div class="max-w-4xl mx-auto">
                <div class="mb-6 flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-slate-900"><?php echo $id > 0 ? 'Edit' : 'Add New'; ?> Publication</h1>
                    <a href="publications.php" class="text-slate-500 hover:text-slate-900 transition-colors font-medium flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>Back to List
                    </a>
                </div>

                <?php if(isset($error)): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-3"><p class="text-sm text-red-700"><?php echo htmlspecialchars($error); ?></p></div>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data" class="space-y-8 pb-12">
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left Column: Main Info -->
                        <div class="lg:col-span-2 space-y-8">
                            
                            <!-- Core Info Card -->
                            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                                <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                                    <h3 class="font-semibold text-slate-800">Core Information</h3>
                                    <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Required</span>
                                </div>
                                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Title</label>
                                        <input type="text" name="title" required value="<?php echo htmlspecialchars($pub['title']); ?>" 
                                               class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-sm py-2.5">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Type</label>
                                        <select name="type" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-sm py-2.5">
                                            <?php 
                                            $types = ['journal', 'conference', 'profile', 'article', 'thesis'];
                                            foreach($types as $t) {
                                                $selected = $pub['type'] == $t ? 'selected' : '';
                                                echo "<option value='$t' $selected>" . ucfirst($t) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Publisher / Platform</label>
                                        <input type="text" name="publisher" value="<?php echo htmlspecialchars($pub['publisher']); ?>" 
                                               class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-sm py-2.5" placeholder="e.g. IEEE, ResearchGate">
                                    </div>

                                    <div class="col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 mb-2">External Link (DOI/Profile)</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                                <i class="fas fa-link text-xs"></i>
                                            </div>
                                            <input type="url" name="link" required value="<?php echo htmlspecialchars($pub['link']); ?>" 
                                                   class="w-full pl-9 border-slate-300 rounded-lg shadow-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-sm py-2.5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detailed Info Card -->
                            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                                <div class="px-6 py-4 bg-slate-50 border-b border-slate-100">
                                    <h3 class="font-semibold text-slate-800">Content Details</h3>
                                </div>
                                <div class="p-6 grid grid-cols-1 gap-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Publication Date</label>
                                            <input type="date" name="publication_date" value="<?php echo $pub['publication_date']; ?>" 
                                                   class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-sm py-2.5">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Tags</label>
                                            <input type="text" name="tags" value="<?php echo htmlspecialchars($pub['tags']); ?>" 
                                                   class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-sm py-2.5" placeholder="e.g. AI, IoT">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Authors</label>
                                        <input type="text" name="authors" value="<?php echo htmlspecialchars($pub['authors']); ?>" 
                                               class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-sm py-2.5">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Abstract</label>
                                        <textarea name="abstract" rows="5" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-sm py-2.5"><?php echo htmlspecialchars($pub['abstract']); ?></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Right Column: Assets & Actions -->
                        <div class="space-y-8">
                            
                            <!-- Save Action (Sticky-ish) -->
                            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sticky top-4 z-10">
                                <button type="submit" class="w-full flex items-center justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-md hover:shadow-lg">
                                    <i class="fas fa-save mr-2"></i> Save Publication
                                </button>
                                <div class="mt-4 pt-4 border-t border-slate-100">
                                    <label class="flex items-center space-x-3 cursor-pointer p-2 hover:bg-slate-50 rounded-lg transition-colors">
                                        <div class="relative inline-block w-10 h-6 align-middle select-none transition duration-200 ease-in">
                                            <input type="checkbox" name="is_featured" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer border-slate-300 checked:right-0 checked:border-blue-600 outline-none focus:outline-none" <?php echo $pub['is_featured'] ? 'checked' : ''; ?>/>
                                            <label class="toggle-label block overflow-hidden h-6 rounded-full bg-slate-300 cursor-pointer checked:bg-blue-600"></label>
                                        </div>
                                        <span class="text-sm font-medium text-slate-700">Feature this item</span>
                                    </label>
                                    <style>
                                        /* Custom Toggle Switch Styles */
                                        .toggle-checkbox:checked { right: 0; border-color: #2563eb; }
                                        .toggle-checkbox:checked + .toggle-label { background-color: #2563eb; }
                                    </style>
                                </div>
                            </div>

                            <!-- Assets Card -->
                            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                                <div class="px-6 py-4 bg-slate-50 border-b border-slate-100">
                                    <h3 class="font-semibold text-slate-800">Media & Files</h3>
                                </div>
                                <div class="p-6 space-y-6">
                                    <!-- Image Upload -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-3">Cover Image</label>
                                        
                                        <?php if (!empty($pub['image_url'])): ?>
                                            <div class="mb-4 relative group">
                                                <img src="<?php echo str_starts_with($pub['image_url'], '../') ? $pub['image_url'] : '../' . $pub['image_url']; ?>" alt="Preview" class="w-full h-48 object-cover rounded-lg border border-slate-200 shadow-sm">
                                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                                    <p class="text-white text-xs">Current Image</p>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:bg-slate-50 transition-colors">
                                            <i class="fas fa-image text-slate-400 text-3xl mb-2"></i>
                                            <div class="text-sm text-slate-600">
                                                <label for="image_file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                    <span>Upload a file</span>
                                                    <input id="image_file" name="image_file" type="file" class="sr-only" accept="image/*">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-slate-500">PNG, JPG, GIF up to 5MB</p>
                                        </div>
                                        <input type="hidden" name="current_image_url" value="<?php echo htmlspecialchars($pub['image_url']); ?>">
                                        
                                        <div class="mt-4">
                                            <label class="block text-xs font-medium text-slate-500 mb-1">Or use image URL</label>
                                            <input type="text" name="image_url" value="<?php echo htmlspecialchars($pub['image_url']); ?>" class="w-full border-slate-300 rounded-lg shadow-sm text-xs py-2">
                                        </div>
                                    </div>

                                    <!-- PDF Link -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">PDF Download URL</label>
                                        <input type="text" name="pdf_url" value="<?php echo htmlspecialchars($pub['pdf_url']); ?>" 
                                               class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-sm py-2.5" placeholder="/assets/docs/file.pdf">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
<script src="js/admin.js"></script>
</body>
</html>
