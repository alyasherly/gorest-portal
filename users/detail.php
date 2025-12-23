<?php
require __DIR__ . '/../config/api.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    echo "<p class='error'>Invalid user ID.</p>";
    exit;
}

$res = apiRequest("/users/{$id}");
if ($res['error']) {
    echo "<p class='error'>API error: " . htmlspecialchars($res['message'] ?? 'unknown') . "</p>";
    exit;
}
$user = $res['data'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($user['name'] ?? 'User') ?> — User Detail</title>
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
            <h2><?= htmlspecialchars($user['name'] ?? '-') ?></h2>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email'] ?? '-') ?></p>
            <p><strong>Gender:</strong> <?= htmlspecialchars($user['gender'] ?? '-') ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($user['status'] ?? '-') ?></p>

            <a href="index.php">Back</a>

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
