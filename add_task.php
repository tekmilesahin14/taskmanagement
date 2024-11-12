<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = 'pending';

    $sql = "INSERT INTO tasks (title, description, due_date, status) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $description, $due_date, $status]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Görev Ekle</title>
    <style>
        body {
            background-color: lightsalmon;
            margin: 0;
            font-family: Arial, sans-serif;
        }
form-container{
  display: block;
   margin-bottom: 5px;
    font-size: 14px;
 font-weight: bold;
}

input[type="text"], textarea, input[type="date"]{
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
        /* Buton Ortalamak */
        button {
            display: block;
            width: 50%; /* Butonun genişliğini formun genişliğine uyacak şekilde ayarlar */
            padding: 12px;
            font-size: 18px; /* Butonun yazı boyutunu büyütür */
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        .form-container {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
        }


    </style>
</head>
<body>
<div class="form-container">
<h2>Yeni Görev Ekle</h2>
<form method="post" action="add_task.php">
    <div class="input">
    <label for="title" >Görev Başlığı:</label>
    <input type="text" id="title" name="title" class="baslik" required><br><br>

    <label for="description">Görev Açıklaması:</label>
    <textarea id="description" name="description" class="description" required></textarea><br><br>

    <label for="due_date">Teslim Tarihi:</label>
    <input type="date" id="due_date" name="due_date" class="duedate" required><br><br>

    <button type="submit" >Görevi Ekle</button>
    </div>
</form>
</div>
</body>
</html>
