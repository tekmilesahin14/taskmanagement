<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Görev Yönetim Uygulaması</title>

</head>
<body>
<h1>Görev Listesi</h1>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    h1 {
        text-align: center;
        color: #333;
    }
    .task-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .task-table th, .task-table td {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: left;
    }
    .task-table th {
        background-color: #f4f4f4;
    }
    .task-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .task-table td .status {
        font-weight: bold;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }
    .status.completed {
        background-color: #4CAF50; /* Yeşil renk */
    }
    .status.pending {
        background-color: #FF9800; /* Turuncu renk */
    }
    .action-links a {
        margin-right: 10px;
        color: #007BFF;
        text-decoration: none;
    }
    .action-links a:hover {
        text-decoration: underline;
    }
    .add-task-link {
        display: block;
        width: 150px;
        margin: 10px auto;
        padding: 10px;
        text-align: center;
        background-color: #007BFF;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }
    .add-task-link:hover {
        background-color: #0056b3;
    }

</style>
<!-- Yeni Görev Ekle Linki -->
<a href="add_task.php" class="add-task-link">Yeni Görev Ekle</a>

<!-- Görev Listesi Tablosu -->
<table class="task-table">
    <tr>
        <th>Başlık</th>
        <th>Açıklama</th>
        <th>Tarih</th>
        <th>Durum</th>
        <th>İşlemler</th>
    </tr>

    <!-- Burada veritabanındaki görevler listelenecek -->
    <?php
    include 'config.php';

    $sql = "SELECT * FROM tasks";
    $stmt = $pdo->query($sql);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tasks as $task): ?>
        <tr>
            <td><?= htmlspecialchars($task['title']) ?></td>
            <td><?= htmlspecialchars($task['description']) ?></td>
            <td><?= htmlspecialchars($task['due_date']) ?></td>
            <td>
                <input type="checkbox" class="status-checkbox"
                       data-id="<?= $task['id'] ?>" <?= $task['status'] == 'completed' ? 'checked' : '' ?>>
                <?= $task['status'] == 'completed' ? 'Yapıldı' : 'Yapılmadı' ?>
            </td>
            <td class="action-links">
                <a href="edit_task.php?id=<?= $task['id'] ?>">Düzenle</a>
                <a href="delete_task.php?id=<?= $task['id'] ?>"
                   onclick="return confirm('Bu görevi silmek istediğinize emin misiniz?')">Sil</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>

