<?php
$user = 'root';
$pass = '';
$title_name = $_POST['title_name'];
$howto = $_POST['howto'];
$category = (int)$_POST['category'];
$difficulty = (int)$_POST['difficulty'];
$voltage = (int)$_POST['voltage'];
try {
    $dbh = new PDO('mysql:host=localhost;dbname=gsf_d12_02;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'INSERT INTO diary_table (title_name, category, difficulty, voltage, howto) VALUES (?, ?, ?, ?, ?)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $title_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $category, PDO::PARAM_INT);
    $stmt->bindValue(3, $difficulty, PDO::PARAM_INT);
    $stmt->bindValue(4, $voltage, PDO::PARAM_INT);
    $stmt->bindValue(5, $howto, PDO::PARAM_STR);
    $stmt->execute();
    $dbh = null;
    echo'日記の登録が完了しました。';
    echo'<a href="index.php">トップページへ戻る</a>';
} catch (PDOException $e) {
    echo 'エラー発生: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>
