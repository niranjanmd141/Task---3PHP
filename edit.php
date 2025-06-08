<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$title = $content = "";
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch();
    $title = $post['title'];
    $content = $post['content'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
        $stmt->execute([$_POST['title'], $_POST['content'], $_POST['id']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
        $stmt->execute([$_POST['title'], $_POST['content']]);
    }
    header("Location: dashboard.php");
    exit();
}
include 'includes/header.php';
?>
<h2><?php echo isset($_GET['id']) ? 'Edit Post' : 'New Post'; ?></h2>
<form method="POST">
  <input type="text" name="title" placeholder="Title" value="<?php echo htmlspecialchars($title); ?>" required>
  <textarea name="content" placeholder="Content" rows="5" required><?php echo htmlspecialchars($content); ?></textarea>
  <?php if (isset($_GET['id'])) echo '<input type="hidden" name="id" value="' . $_GET['id'] . '">'; ?>
  <button type="submit">Update</button>
</form>
</div></body></html>
