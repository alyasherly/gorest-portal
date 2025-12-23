<?php
require __DIR__ . '/config/api.php';

// Fetch recent data for dashboard
$recentUsers = apiRequest("/users?per_page=5");
$recentPosts = apiRequest("/posts?per_page=5");

$users = $recentUsers['data'] ?? [];
$posts = $recentPosts['data'] ?? [];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard — GoRest Portal</title>
    <link rel="stylesheet" href="assets/style.css">
    <script>
        // Check theme immediately to prevent flash
        if (localStorage.getItem('theme') === 'ios') {
            document.documentElement.classList.add('ios-theme'); // Use doc element for earlier apply
        }
    </script>
</head>
<body class="<?= isset($_COOKIE['theme']) ? $_COOKIE['theme'] : '' ?>">

    <!-- Sidebar Menu -->
    <div class="sidebar">
        <h3>GoRest Portal</h3>
        <ul>
            <li><a href="index.php" class="active">Dashboard</a></li>
            <li><a href="users/index.php">User Management</a></li>
            <li><a href="posts/index.php">Post Management</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="container" style="margin-top: 0; max-width: 1000px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                <h1>Dashboard</h1>
                <button class="theme-toggle" onclick="toggleTheme()" style="position:static;">Switch Theme</button>
            </div>

            <p>Welcome to the GoRest Enterprise Portal. Manage your resources efficiently.</p>

            <!-- Dashboard Widgets -->
            <div class="dashboard-grid">
                <div class="card">
                    <h4>Latest User</h4>
                    <p class="number"><?= count($users) > 0 ? htmlspecialchars($users[0]['name']) : '-' ?></p>
                </div>
                <div class="card">
                    <h4>Latest Post</h4>
                    <p class="number"><?= count($posts) > 0 ? substr(htmlspecialchars($posts[0]['title']), 0, 20) . '...' : '-' ?></p>
                </div>
                <div class="card">
                    <h4>System Status</h4>
                    <p class="number" style="color: #28a745; font-size: 24px;">Online</p>
                </div>
            </div>

            <div class="dashboard-section">
                <h3>Recently Added Users</h3>
                <?php if (empty($users)): ?>
                    <p>No data available.</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($users as $u): ?>
                            <li class="list-item">
                                <strong><?= htmlspecialchars($u['name']) ?></strong>
                                <span style="color:#888; font-size:12px; margin-left:10px;"><?= htmlspecialchars($u['email']) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <div style="margin-top:10px;">
                    <a href="users/index.php" class="button">View All Users</a>
                </div>
            </div>

            <div class="dashboard-section">
                <h3>Latest Posts</h3>
                <?php if (empty($posts)): ?>
                    <p>No data available.</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($posts as $p): ?>
                            <li class="list-item">
                                <strong><?= htmlspecialchars($p['title']) ?></strong>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <div style="margin-top:10px;">
                    <a href="posts/index.php" class="button">View All Posts</a>
                </div>
            </div>

            <a href="https://github.com/alyasherly" class="watermark-link" target="_blank">Alya Sherly Al Azmy</a>
        </div>
    </div>

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
