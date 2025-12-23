<?php
require __DIR__ . '/../config/api.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: create.php');
    exit;
}

$data = [
    'name' => $_POST['name'] ?? '',
    'email' => $_POST['email'] ?? '',
    'gender' => $_POST['gender'] ?? '',
    'status' => $_POST['status'] ?? '',
];

$res = apiRequest('/users', 'POST', $data);

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Create Result</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="<?= isset($_COOKIE['theme']) ? $_COOKIE['theme'] : '' ?>">
    <div class="sidebar">
        <h3>GoRest Portal</h3>
        <ul>
            <li><a href="../index.php">Dashboard</a></li>
            <li><a href="index.php" class="active">User Management</a></li>
            <li><a href="../posts/index.php">Post Management</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="container">
            <h2>Create User Result</h2>
            <?php if ($res['error']): ?>
                <p class="error">Error: <?= htmlspecialchars($res['message'] ?? 'Unknown') ?></p>
            <?php else: ?>
                <pre><?php print_r($res['data']); ?></pre>
            <?php endif; ?>

            <a href="index.php">Back to Users</a>
            <a href="https://github.com/alyasherly" class="watermark-link" target="_blank">Alya Sherly Al Azmy</a>
        </div>
    </div>

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
