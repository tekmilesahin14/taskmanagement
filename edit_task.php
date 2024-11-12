<?php
include 'config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM tasks WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$task = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $sql = "UPDATE tasks SET title = ?, description = ?, due_date = ?, status = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $description, $due_date, $status, $id]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Görev Düzenle</title>
    <style>
        body{
            background-color: lightsalmon;
            margin: 0;
            font-family: Arial ,sans-serif;
        }
        .form-container{
            width: 300px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
        }
        button{
            display: block;
            width: 50%;
            padding: 12px;
            font-size: 18px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="text"],textarea,select,input[type="date"]{
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="form-container">
<h2>Görev Düzenle</h2>
<form method="post" action="edit_task.php?id=<?= $id ?>">
    <label for="title">Başlık:</label>
    <input type="text" id="title" name="title" value="<?= htmlspecialchars($task['title']) ?>" required><br><br>

    <label for="description">Açıklama:</label>
    <textarea id="description" name="description" required><?= htmlspecialchars($task['description']) ?></textarea><br><br>

    <label for="due_date">Tarih:</label>
    <input type="date" id="due_date" name="due_date" value="<?= htmlspecialchars($task['due_date']) ?>" required><br><br>

    <label for="status">Durum:</label>
    <select id="status" name="status">
        <option value="pending" <?= $task['status'] == 'pending' ? 'selected' : '' ?>>Yapılmadı</option>
        <option value="completed" <?= $task['status'] == 'completed' ? 'selected' : '' ?>>Yapıldı</option>
    </select><br><br>

    <button type="submit">Değişiklikleri Kaydet</button>
</form>
</div>
</body>
</html>
