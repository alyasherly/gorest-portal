<?php
require __DIR__ . '/../config/api.php';

$page = max(1, intval($_GET['page'] ?? 1));
$per_page = 5;
$search = trim($_GET['search'] ?? '');

$query = "/posts?per_page={$per_page}&page={$page}";
if ($search) {
    $query .= "&title=" . urlencode($search);
}

$res = apiRequest($query);

if ($res['error']) {
    $posts = [];
    $error = $res['message'] ?? 'Unknown error';
} else {
    $posts = $res['data'];
    $error = null;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Posts — GoRest Portal</title>
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
            <h2>Posts</h2>
            <form method="get">
                <div class="form-row">
                    <input type="text" name="search" placeholder="Search title..." value="<?= htmlspecialchars($search) ?>">
                </div>
                <button class="button" type="submit">Search</button>
                <a class="button" href="create.php">+ Add Post</a>
            </form>

            <?php if (isset($error)): ?>
                <p class="error">API error: <?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <?php if (empty($posts)): ?>
                <p class="error">No posts found.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($posts as $p): ?>
                        <li class="list-item">
                            <a href="detail.php?id=<?= $p['id'] ?>"><strong><?= htmlspecialchars($p['title']) ?></strong></a>
                            <br>
                            <small>User ID: <?= htmlspecialchars($p['user_id']) ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?<?= http_build_query(['page' => $page-1, 'search' => $search]) ?>">&laquo; Prev</a>
                <?php endif; ?>
                <a href="?<?= http_build_query(['page' => $page+1, 'search' => $search]) ?>">Next &raquo;</a>
            </div>

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
