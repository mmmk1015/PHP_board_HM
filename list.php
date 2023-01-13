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
        } . '</td>' . PHP_EOL;
        echo '</tr>' . PHP_EOL;
    }
    echo '</table>' . PHP_EOL;
    $dbh = null;
} catch (PDOException $e) {
    echo 'エラー発生: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>