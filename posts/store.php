<?php
require __DIR__ . '/../config/api.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: create.php');
    exit;
}

$data = [
    'user_id' => intval($_POST['user_id'] ?? 0),
    'title'   => $_POST['title'] ?? '',
    'body'    => $_POST['body'] ?? '',
];

$res = apiRequest('/posts', 'POST', $data);

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Create Post Result</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="<?= isset($_COOKIE['theme']) ? $_COOKIE['theme'] : '' ?>">
    <div class="sidebar">
        <h3>GoRest Portal</h3>
        <ul>
            <li><a href="../index.php">Dashboard</a></li>
            <li><a href="../users/index.php">User Management</a></li>
            <li><a href="index.php" class="active">Post Management</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="container">
            <h2>Create Post Result</h2>
            <?php if ($res['error']): ?>
                <p class="error">Error: <?= htmlspecialchars($res['message'] ?? 'Unknown') ?></p>
                <?php if(isset($res['data'])): ?>
                    <pre><?php print_r($res['data']); ?></pre>
                <?php endif; ?>
            <?php else: ?>
                <p>Post created successfully!</p>
                <pre><?php print_r($res['data']); ?></pre>
            <?php endif; ?>

            <a href="index.php">Back to Posts</a>
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
