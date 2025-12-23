<?php
require __DIR__ . '/../config/api.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Redirect back to posts index if accessed directly
    header('Location: index.php');
    exit;
}

$post_id = intval($_POST['post_id'] ?? 0);
$data = [
    'post_id' => $post_id,
    'name'    => $_POST['name'] ?? '',
    'email'   => $_POST['email'] ?? '',
    'body'    => $_POST['body'] ?? '',
];

// Note: In GoRest API, creating a comment is usually POST /posts/{id}/comments
// or POST /public/v2/comments with post_id in body. Let's try the direct endpoint.
$res = apiRequest("/posts/{$post_id}/comments", 'POST', $data);

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comment Result</title>
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
            <h2>Comment Submission</h2>
            <?php if ($res['error']): ?>
                <p class="error">Error: <?= htmlspecialchars($res['message'] ?? 'Unknown') ?></p>
                <?php if(isset($res['data'])): ?>
                    <pre><?php print_r($res['data']); ?></pre>
                <?php endif; ?>
            <?php else: ?>
                <p>Comment added successfully!</p>
            <?php endif; ?>

            <br>
            <a href="detail.php?id=<?= $post_id ?>">Back to Post</a>
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
