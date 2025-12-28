<?php
require_once '../includes/auth.php';
$auth->requireLogin();

// Initialize variables
$is_edit = false;
$id = '';
$name = '';
$designation = '';
$category = 'executive';
$bio = '';
// Default display order to max + 1
$stmtOrder = $pdo->query("SELECT MAX(display_order) as max_order FROM team_members");
$rowOrder = $stmtOrder->fetch();
$display_order = ($rowOrder['max_order'] ?? 0) + 1;

$image_path = '';
$social_links = ['linkedin' => '', 'email' => '', 'facebook' => ''];
$error_msg = '';
$success_msg = '';

// Check if editing
if (isset($_GET['id'])) {
    $is_edit = true;
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM team_members WHERE id = ?");
    $stmt->execute([$id]);
    $member = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$member) {
        header('Location: team_members.php');
        exit;
    }

    $name = $member['name'];
    $designation = $member['designation'];
    $category = $member['category'];
    $bio = $member['bio'];
    $display_order = $member['display_order'];
    $image_path = $member['image_path'];
    $social_db = json_decode($member['social_links'], true);
    if (is_array($social_db)) {
        $social_links = array_merge($social_links, $social_db);
    }
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $designation = trim($_POST['designation']);
    $category = $_POST['category'];
    $bio = trim($_POST['bio']);
    $display_order = (int)$_POST['display_order'];
    
    // Process Social Links
    $submitted_socials = [
        'linkedin' => trim($_POST['social_linkedin'] ?? ''),
        'email' => trim($_POST['social_email'] ?? ''),
        'facebook' => trim($_POST['social_facebook'] ?? '')
    ];
    $social_json = json_encode($submitted_socials);

    // Validation
    if (empty($name) || empty($designation)) {
        $error_msg = "Name and Designation are required.";
    } else {
        try {
            // Handle Image Upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = '../assets/team_uploads/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                
                $file_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $allowed_exts = ['jpg', 'jpeg', 'png', 'webp'];
                
                if (in_array($file_ext, $allowed_exts)) {
                    // Generate unique filename
                    $new_filename = uniqid('team_') . '.' . $file_ext;
                    $target_path = $upload_dir . $new_filename;
                    
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                        // Delete old image if editing
                        if ($is_edit && !empty($image_path) && file_exists('../' . $image_path)) {
                            unlink('../' . $image_path);
                        }
                        $image_path = 'assets/team_uploads/' . $new_filename;
                    } else {
                        $error_msg = "Failed to upload image.";
                    }
                } else {
                    $error_msg = "Invalid file format. Allowed: JPG, PNG, WEBP.";
                }
            }

            if (empty($error_msg)) {
                if ($is_edit) {
                    $stmt = $pdo->prepare("UPDATE team_members SET name=?, designation=?, category=?, bio=?, image_path=?, social_links=?, display_order=? WHERE id=?");
                    $stmt->execute([$name, $designation, $category, $bio, $image_path, $social_json, $display_order, $id]);
                    $success_msg = "Team member updated successfully!";
                } else {
                    $stmt = $pdo->prepare("INSERT INTO team_members (name, designation, category, bio, image_path, social_links, display_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$name, $designation, $category, $bio, $image_path, $social_json, $display_order]);
                    // Redirect to list after add to prevent double post
                    header('Location: team_members.php');
                    exit;
                }
            }
        } catch (PDOException $e) {
            $error_msg = "Database Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $is_edit ? 'Edit' : 'Add'; ?> Team Member - Frequency Lab Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen">
<div class="flex h-screen overflow-hidden">
    
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col overflow-hidden">
        <?php include 'includes/mobile_header.php'; ?>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-4 md:p-8">
            <div class="max-w-5xl mx-auto">
                <!-- Page Header -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900"><?php echo $is_edit ? 'Edit Team Member' : 'Add New Member'; ?></h1>
                        <p class="text-sm text-slate-500 mt-1">
                            <?php echo $is_edit ? 'Update the details below to save changes.' : 'Fill in the details to create a new profile.'; ?>
                        </p>
                    </div>
                    <a href="team_members.php" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Back to List
                    </a>
                </div>

                <?php if ($success_msg): ?>
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0"><svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg></div>
                            <div class="ml-3"><p class="text-sm text-green-700"><?php echo htmlspecialchars($success_msg); ?></p></div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if ($error_msg): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0"><svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg></div>
                            <div class="ml-3"><p class="text-sm text-red-700"><?php echo htmlspecialchars($error_msg); ?></p></div>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left Column: Main Info -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
                            <h2 class="text-lg font-semibold text-gray-900 mb-6 border-b pb-2">Profile Information</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-1 md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required 
                                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                                           placeholder="e.g. Dr. John Doe">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Designation / Role <span class="text-red-500">*</span></label>
                                    <input type="text" name="designation" value="<?php echo htmlspecialchars($designation); ?>" required 
                                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                                           placeholder="e.g. CEO">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <select name="category" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none appearance-none transition-all">
                                            <option value="board" <?php if ($category == 'board') echo 'selected'; ?>>Board of Directors</option>
                                            <option value="advisor" <?php if ($category == 'advisor') echo 'selected'; ?>>Advisory Panel</option>
                                            <option value="executive" <?php if ($category == 'executive') echo 'selected'; ?>>Executive Team</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                                    <input type="number" name="display_order" value="<?php echo htmlspecialchars($display_order); ?>" 
                                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                                           placeholder="0">
                                    <p class="text-xs text-gray-500 mt-1">Lower numbers appear first.</p>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bio / Short Description</label>
                                <textarea name="bio" rows="4" 
                                          class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                                          placeholder="A brief bio about the team member..."><?php echo htmlspecialchars($bio); ?></textarea>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
                             <h2 class="text-lg font-semibold text-gray-900 mb-6 border-b pb-2">Social Links</h2>
                             <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn URL</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">in</span>
                                        </div>
                                        <input type="url" name="social_linkedin" value="<?php echo htmlspecialchars($social_links['linkedin'] ?? ''); ?>" 
                                               class="pl-10 w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" 
                                               placeholder="https://linkedin.com/in/...">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                           <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                                        </div>
                                        <input type="email" name="social_email" value="<?php echo htmlspecialchars($social_links['email'] ?? ''); ?>" 
                                               class="pl-10 w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" 
                                               placeholder="john@example.com">
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>

                    <!-- Right Column: Image & Actions -->
                    <div class="space-y-6">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h2 class="text-sm font-semibold text-gray-900 mb-4 uppercase tracking-wide">Profile Photo</h2>
                            
                            <div class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-400 transition-colors bg-gray-50">
                                <?php if (!empty($image_path)): ?>
                                    <img src="../<?php echo htmlspecialchars($image_path); ?>" class="h-32 w-32 object-cover rounded-full shadow-md mb-4 border-4 border-white" alt="Current Image">
                                    <p class="text-sm text-green-600 font-medium mb-2">Current Image Set</p>
                                <?php else: ?>
                                    <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center mb-4 text-gray-400">
                                        <svg class="h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                <?php endif; ?>
                                
                                <label class="cursor-pointer bg-white border border-gray-300 rounded-md shadow-sm px-4 py-2 inline-flex justify-center text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                                    <span><?php echo !empty($image_path) ? 'Change Photo' : 'Upload Photo'; ?></span>
                                    <input type="file" name="image" accept="image/*" class="sr-only">
                                </label>
                                <p class="text-xs text-gray-500 mt-2 text-center">SVG, PNG, JPG or GIF (MAX. 2MB)</p>
                            </div>
                        </div>

                        <!-- Sticky Actions (Desktop) -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-6">
                            <h2 class="text-sm font-semibold text-gray-900 mb-4 uppercase tracking-wide">Publish</h2>
                             <div class="flex flex-col space-y-3">
                                 <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                                    <?php echo $is_edit ? 'Update Member' : 'Save Member'; ?>
                                </button>
                                <a href="team_members.php" class="w-full flex justify-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition-all">
                                    Cancel
                                </a>
                             </div>
                        </div>
                    </div>

                </form>
            </div>
        </main>
    </div>
</div>
<!-- JS for Sidebar -->
<script src="js/admin.js"></script>
</body>
</html>
