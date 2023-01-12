<?php
session_start();
include('functions.php');
 
// ★ポイント1★
if (isset($_SESSION['id']) && ($_SESSION['time'] + 3600 > time())) {
    $_SESSION['time'] = time();
 
    $members=$db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member=$members->fetch();
    } else {
    header('Location: login_form.php');
    exit();
}
 
// ★ポイント2★
if (!empty($_POST)){
    if (isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {
        $message=$db->prepare('INSERT INTO posts SET created_by=?, message=?, created=NOW()');
        $message->execute(array($member['id'] , $_POST['message']));
        header('Location: board.php');
        exit();
    }else {
        header('Location: login_form.php');
        exit();
    }
}
 
// ★ポイント3★
$posts=$db->query('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.created_by ORDER BY p.created DESC');
 
 
$TOKEN_LENGTH = 16;
$tokenByte = openssl_random_pseudo_bytes($TOKEN_LENGTH);
$token = bin2hex($tokenByte);
$_SESSION['token'] = $token;
 
?>
 
<!DOCTYPE html>
<html lang="ja">
 
<body>
 
<form action='' method="post">
<input type="hidden" name="token" value="<?=$token?>">
<?php if (isset($error['login']) &&  ($error['login'] =='token')): ?>
    <p class="error">不正なアクセスです。</p>
<?php endif; ?>
<div class="edit">
<p><?php echo htmlspecialchars($member['name'], ENT_QUOTES); ?>さん、ようこそ</p>
<textarea name="message" cols='50' rows='10'><?php echo htmlspecialchars($message??"", ENT_QUOTES); ?></textarea>
</div>
 
<input type="submit" value="投稿する" class="button02">
</form>
 
<?php foreach($posts as $post): ?>
<div class="message">
<?php echo htmlspecialchars($post['message'], ENT_QUOTES); ?>
<span class="name"><?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?> | <?php echo htmlspecialchars($post['created'], ENT_QUOTES); ?> | 
 
<?php endforeach; ?>
</body>