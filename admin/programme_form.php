<?php
require_once '../includes/auth.php';
$auth->requireLogin();

// Initialize variables
$is_edit = false;
$id = '';
$title = '';
$type = 'event'; // default
$description = '';
$start_date = '';
$error_msg = '';
$success_msg = '';

// Check if editing
if (isset($_GET['id'])) {
    $is_edit = true;
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM programmes WHERE id = ?");
    $stmt->execute([$id]);
    $prog = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$prog) {
        header('Location: programmes.php');
        exit;
    }

    $title = $prog['title'];
    $type = $prog['type'];
    $description = $prog['description'];
    $start_date = $prog['start_date'];
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $type = $_POST['type'];
    $description = trim($_POST['description']);
    $start_date = !empty($_POST['start_date']) ? $_POST['start_date'] : null;
    
    // Validation
    if (empty($title)) {
        $error_msg = "Title is required.";
    } else {
        try {
            if ($is_edit) {
                $stmt = $pdo->prepare("UPDATE programmes SET title=?, type=?, description=?, start_date=? WHERE id=?");
                $stmt->execute([$title, $type, $description, $start_date, $id]);
                $success_msg = "Programme updated successfully!";
            } else {
                $stmt = $pdo->prepare("INSERT INTO programmes (title, type, description, start_date) VALUES (?, ?, ?, ?)");
                $stmt->execute([$title, $type, $description, $start_date]);
                header('Location: programmes.php');
                exit;
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
    <title><?php echo $is_edit ? 'Edit' : 'Add'; ?> Programme - Frequency Lab Admin</title>
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
            <div class="max-w-2xl mx-auto">
                <!-- Page Header -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900"><?php echo $is_edit ? 'Edit Programme' : 'Add New Programme'; ?></h1>
                        <p class="text-sm text-slate-500 mt-1">
                            <?php echo $is_edit ? 'Update programme details.' : 'Create a new programme.'; ?>
                        </p>
                    </div>
                    <a href="programmes.php" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Back to Programmes
                    </a>
                </div>

                <?php if ($success_msg): ?>
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg shadow-sm">
                        <p class="text-sm text-green-700"><?php echo htmlspecialchars($success_msg); ?></p>
                    </div>
                <?php endif; ?>
                
                <?php if ($error_msg): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-sm">
                        <p class="text-sm text-red-700"><?php echo htmlspecialchars($error_msg); ?></p>
                    </div>
                <?php endif; ?>

                <form method="POST" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8 space-y-6">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Programme Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" required 
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                               placeholder="e.g. Annual Tech Fest">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="type" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none appearance-none transition-all">
                                <option value="workshop" <?php if ($type == 'workshop') echo 'selected'; ?>>Workshop</option>
                                <option value="event" <?php if ($type == 'event') echo 'selected'; ?>>Event</option>
                                <option value="competition" <?php if ($type == 'competition') echo 'selected'; ?>>Competition</option>
                                <option value="community" <?php if ($type == 'community') echo 'selected'; ?>>Community</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                        <input type="date" name="start_date" value="<?php echo htmlspecialchars($start_date ?? ''); ?>" 
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="4" 
                                  class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                                  placeholder="Brief description of the programme..."><?php echo htmlspecialchars($description); ?></textarea>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex flex-col sm:flex-row gap-3">
                         <button type="submit" class="flex-1 flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                            <?php echo $is_edit ? 'Update Programme' : 'Create Programme'; ?>
                        </button>
                        <a href="programmes.php" class="flex-1 flex justify-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition-all">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
<script src="js/admin.js"></script>
</body>
</html>
