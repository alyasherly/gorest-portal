<?php
require __DIR__ . '/../config/api.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    echo "<p class='error'>Invalid post ID.</p>";
    exit;
}

$res = apiRequest("/posts/{$id}");
if ($res['error']) {
    echo "<p class='error'>API error: " . htmlspecialchars($res['message'] ?? 'unknown') . "</p>";
    exit;
}
$post = $res['data'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($post['title'] ?? 'Post') ?> — Post Detail</title>
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
            <h2><?= htmlspecialchars($post['title'] ?? '-') ?></h2>
            <p><strong>User ID:</strong> <?= htmlspecialchars($post['user_id'] ?? '-') ?></p>
            <hr>
            <p><?= nl2br(htmlspecialchars($post['body'] ?? '')) ?></p>
            <hr>

            <!-- Comments Section -->
            <h3>Comments</h3>
            <?php
            // Fetch comments for this post
            $commentsRes = apiRequest("/posts/{$id}/comments");
            $comments = $commentsRes['data'] ?? [];
            ?>

            <?php if (empty($comments)): ?>
                <p>No comments yet.</p>
            <?php else: ?>
                <ul style="list-style: none; padding: 0;">
                    <?php foreach ($comments as $c): ?>
                        <li class="list-item" style="margin-bottom: 15px;">
                            <strong><?= htmlspecialchars($c['name']) ?></strong> <small>(<?= htmlspecialchars($c['email']) ?>)</small>
                            <p style="margin-top: 5px;"><?= nl2br(htmlspecialchars($c['body'])) ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <hr>
            <h3>Add Comment</h3>
            <form action="store_comment.php" method="post">
                <input type="hidden" name="post_id" value="<?= $id ?>">
                <div class="form-row">
                    <label>Name</label>
                    <input type="text" name="name" required placeholder="Your Name">
                </div>
                <div class="form-row">
                    <label>Email</label>
                    <input type="email" name="email" required placeholder="Your Email">
                </div>
                <div class="form-row">
                    <label>Comment</label>
                    <textarea name="body" rows="3" required placeholder="Write your comment..."></textarea>
                </div>
                <button class="button" type="submit">Submit Comment</button>
            </form>
            <br>
            <hr>

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
