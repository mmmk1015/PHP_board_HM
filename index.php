<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>日記一覧</title>
</head>
<body>
    <h1>日記一覧</h1>
    <a href="form.html">日記の新規登録</a>
    <?php
    $user = 'root';
    $pass = '';
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=gsf_d12_02;charset=utf8', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT * FROM diary_table';
        $stmt = $dbh->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo '<table>' . PHP_EOL;
        echo '<tr>' . PHP_EOL;
        echo '<th>タイトル</th><th>元気ボルテージ</th><th>気分</th>' . PHP_EOL;
        echo '</tr>' . PHP_EOL;
        foreach ($result as $row) {
            echo '<tr>' . PHP_EOL;
            echo '<td>' . htmlspecialchars($row['title_name'], ENT_QUOTES) . '</td>' . PHP_EOL;
            echo '<td>' . htmlspecialchars($row['voltage'], ENT_QUOTES) . '</td>' . PHP_EOL;
            echo '<td>' .
            match ($row['difficulty']) {
                '1' => '😊',
                '2' => '🙂',
                '3' => '😣',
            } . "</td>" . PHP_EOL;
            echo "<td>" . PHP_EOL;
            echo '<a href="detail.php?id=' . htmlspecialchars($row['id'], ENT_QUOTES) . '">詳細</a>' . PHP_EOL;
            echo '｜<a href="edit.php?id=' . htmlspecialchars($row['id'], ENT_QUOTES) . '">変更</a>' . PHP_EOL;
            echo '｜<a href="delete.php?id=' . htmlspecialchars($row['id'], ENT_QUOTES) . '">削除</a>' . PHP_EOL;
            echo "</td>" . PHP_EOL;
            echo "</tr>" . PHP_EOL;
        }
        echo "</table>" . PHP_EOL;
        $dbh = null;
    } catch (PDOException $e) {
        echo 'エラー発生: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
        exit;
    }
    ?>
</body>
</html>