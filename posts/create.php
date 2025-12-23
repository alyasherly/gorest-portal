<?php
require __DIR__ . '/../config/api.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Create Post</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="<?= isset($_COOKIE['theme']) ? $_COOKIE['theme'] : '' ?>">
    <!-- Sidebar Menu -->
    <div class="sidebar">
        <h3>GoRest Portal</h3>
        <ul>
            <li><a href="../index.php">Dashboard</a></li>
            <li><a href="../users/index.php">User Management</a></li>
            <li><a href="index.php" class="active">Post Management</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="container">
            <h2>Create Post</h2>
            <form action="store.php" method="post">
                <div class="form-row">
                    <label>User ID (Required)</label>
                    <input type="text" name="user_id" required placeholder="Enter existing User ID">
                </div>
                <div class="form-row">
                    <label>Title</label>
                    <input type="text" name="title" required>
                </div>
                <div class="form-row">
                    <label>Body</label>
                    <textarea name="body" rows="5" required></textarea>
                </div>

                <button class="button" type="submit">Create</button>
                <a href="index.php">Back</a>
            </form>
            <a href="https://github.com/alyasherly" class="watermark-link" target="_blank">Alya Sherly Al Azmy</a>
        </div>
    </div>

<!-- Theme Toggle -->
<button class="theme-toggle" onclick="toggleTheme()">Switch Theme</button>
<script>
    function toggleTheme() {
        document.body.classList.toggle('ios-theme');
        const isIos = document.body.classList.contains('ios-theme');
        localStorage.setItem('theme', isIos ? 'ios' : 'vista');
    }
    if (localStorage.getItem('theme') === 'ios') {
        document.body.classList.add('ios-theme');
    }
</script>
</body>
</html>
