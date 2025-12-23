<?php
require __DIR__ . '/../config/api.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Create User</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="<?= isset($_COOKIE['theme']) ? $_COOKIE['theme'] : '' ?>">
    <!-- Sidebar Menu -->
    <div class="sidebar">
        <h3>GoRest Portal</h3>
        <ul>
            <li><a href="../index.php">Dashboard</a></li>
            <li><a href="index.php" class="active">User Management</a></li>
            <li><a href="../posts/index.php">Post Management</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="container">
            <h2>Create User</h2>
            <form action="store.php" method="post">
                <div class="form-row">
                    <label>Name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-row">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-row">
                    <label>Gender</label>
                    <select name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-row">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
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
