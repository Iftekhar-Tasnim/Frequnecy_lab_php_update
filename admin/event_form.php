<?php
require_once '../includes/auth.php';
$auth->requireLogin();

// Initialize variables
$is_edit = false;
$id = '';
$title = '';
$description = '';
$event_date = '';
$error_msg = '';
$success_msg = '';

// Check if editing
if (isset($_GET['id'])) {
    $is_edit = true;
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM gallery_events WHERE id = ?");
    $stmt->execute([$id]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$event) {
        header('Location: events.php');
        exit;
    }

    $title = $event['title'];
    $description = $event['description'];
    $event_date = $event['event_date'];
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $event_date = !empty($_POST['event_date']) ? $_POST['event_date'] : null;
    
    // Validation
    if (empty($title)) {
        $error_msg = "Event Title is required.";
    } else {
        try {
            if ($is_edit) {
                $stmt = $pdo->prepare("UPDATE gallery_events SET title=?, description=?, event_date=? WHERE id=?");
                $stmt->execute([$title, $description, $event_date, $id]);
                $success_msg = "Event updated successfully!";
            } else {
                $stmt = $pdo->prepare("INSERT INTO gallery_events (title, description, event_date) VALUES (?, ?, ?)");
                $stmt->execute([$title, $description, $event_date]);
                header('Location: events.php');
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
    <title><?php echo $is_edit ? 'Edit' : 'Add'; ?> Event - Frequency Lab Admin</title>
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
                        <h1 class="text-2xl font-bold text-slate-900"><?php echo $is_edit ? 'Edit Event' : 'Add New Event'; ?></h1>
                        <p class="text-sm text-slate-500 mt-1">
                            <?php echo $is_edit ? 'Update event details.' : 'Create a new event.'; ?>
                        </p>
                    </div>
                    <a href="events.php" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Back to Events
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
                        <label class="block text-sm font-medium text-gray-700 mb-2">Event Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" required 
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                               placeholder="e.g. Tech Fest 2024">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Event Date</label>
                        <input type="date" name="event_date" value="<?php echo htmlspecialchars($event_date ?? ''); ?>" 
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="4" 
                                  class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                                  placeholder="Brief description of the event..."><?php echo htmlspecialchars($description); ?></textarea>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex flex-col sm:flex-row gap-3">
                         <button type="submit" class="flex-1 flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                            <?php echo $is_edit ? 'Update Event' : 'Create Event'; ?>
                        </button>
                        <a href="events.php" class="flex-1 flex justify-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition-all">
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
