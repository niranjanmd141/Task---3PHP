<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';
include 'includes/header.php';
$posts = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC")->fetchAll();
?>
<h2>📋 Blog Dashboard</h2>

<div class="top-bar">
  <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?> | <a href="logout.php">Logout</a></p>
  <a href="edit.php"><button>➕ New Post</button></a>
</div>

<form class="search-form" method="GET" action="dashboard.php">
  <input type="text" name="search" placeholder="Search posts by title or content..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
  <button type="submit">🔍 Search</button>
</form>

<ul>
<?php
$search = isset($_GET['search']) ? "%".$_GET['search']."%" : null;
if ($search) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE title LIKE ? OR content LIKE ? ORDER BY created_at DESC");
    $stmt->execute([$search, $search]);
    $posts = $stmt->fetchAll();
} else {
    $posts = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC")->fetchAll();
}
?>

<?php foreach ($posts as $post): ?>
  <li>
    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
    <small>🕒 <?php echo $post['created_at']; ?></small><br>
    <a href="edit.php?id=<?php echo $post['id']; ?>">✏️ Edit</a> |
    <a href="delete.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?')">❌ Delete</a>
  </li>
<?php endforeach; ?>
</ul>

<div class="pagination">
  <a href="#">« Prev</a>
  <a href="#">1</a>
  <a href="#">2</a>
  <a href="#">3</a>
  <a href="#">Next »</a>
</div>
