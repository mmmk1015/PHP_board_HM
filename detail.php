<?php
$user = 'root';
$pass = '';
if (empty($_GET['id'])) {
    echo 'IDを正しく入力してください。';
    exit;
}
 try {
    $id = (int)$_GET['id'];
    $dbh = new PDO('mysql:host=localhost;dbname=gsf_d12_02;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM diary_table WHERE id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo 'タイトル:' . htmlspecialchars($result['title_name'], ENT_QUOTES) . '<br>' . PHP_EOL;
    echo 'できごとカテゴリー:' .
    match ($result['category']) {
        '1' => 'がっこう',
        '2' => 'ならいごと',
        '3' => 'おうち',
    } . '<br>' . PHP_EOL;
    echo '元気ボルテージ:' . htmlspecialchars($result['voltage'],ENT_QUOTES) . '<br>' . PHP_EOL;
    echo '今日の気分:' .
    match ($result['difficulty']) {
        '1' => '😊',
        '2' => '🙂',
        '3' => '😣',
    } . '<br>' . PHP_EOL;
    echo '作り方:<br>' . nl2br(htmlspecialchars($result['howto'], ENT_QUOTES)) . '<br>' . PHP_EOL;
    $dbh = null;
    echo'<a href="index.php">トップページへ戻る</a>';
} catch (PDOException $e) {
    echo 'エラー発生: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>