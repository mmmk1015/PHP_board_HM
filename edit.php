<?php
$user = 'root';
$pass = '';
if (empty($_GET['id'])) {
    echo 'IDを正しく入力してください。';
    exit;
} 
$id = (int)$_GET['id'];
try {
    $dbh = new PDO('mysql:host=localhost;dbname=gsf_d12_02;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM diary_table WHERE id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $dbh = null;
} catch (PDOException $e) {
    echo 'エラー発生: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>入力フォーム</title>
</head>
<body>
    今日のできごと<br>
    <form method="post" action="update.php?id=<?= htmlspecialchars($result['id'], ENT_QUOTES) ?>">
        タイトル：<input type="text" name="title_name" value="<?= htmlspecialchars($result['recipe_name'], ENT_QUOTES) ?>"><br>
        できごとカテゴリー：
        <select name="category">
            <option hidden>えらんでね</option>
            <option value="1" <?php if ($result['category'] == 1) echo 'selected' ?>>がっこう</option>
            <option value="2" <?php if ($result['category'] == 2) echo 'selected' ?>>ならいごと</option>
            <option value="3" <?php if ($result['category'] == 3) echo 'selected' ?>>おうち</option>
        </select>
        <br>
        今日の気分：
        <input type="radio" name="difficulty" value="1" <?php if ($result['difficulty'] == 1) echo 'checked'?>>😊
        <input type="radio" name="difficulty" value="2" <?php if ($result['difficulty'] == 2) echo 'checked'?>>🙂
        <input type="radio" name="difficulty" value="3" <?php if ($result['difficulty'] == 3) echo 'checked'?>>😣
        <br>
        元気ボルテージ：<input type="number" name="voltage" value="<?= htmlspecialchars($result['voltage'], ENT_QUOTES) ?>">％
        <br>
        できごと：
        <textarea name="howto" cols="40" rows="4" maxlength="320"><?= htmlspecialchars($result['howto'], ENT_QUOTES) ?></textarea>
        <br>
        <input type="submit" value="送信">
    </form>
        <a href="index.php">トップページへ戻る</a>
<body>
<html>
