<?php
session_start();
include('functions.php');
 
 
if (isset($_SESSION['id']) && ($_SESSION['time'] + 3600 > time())) {
    $_SESSION['time'] = time();
 
    $members=$db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member=$members->fetch();
    } else {
    header('Location: login_form.php');
    exit();
}
 
 
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
 
 
$posts=$db->query('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.created_by ORDER BY p.created DESC');
 
 
$TOKEN_LENGTH = 16;
$tokenByte = openssl_random_pseudo_bytes($TOKEN_LENGTH);
$token = bin2hex($tokenByte);
$_SESSION['token'] = $token;
 
?>
 
<!DOCTYPE html>
<html lang="ja">
 
<body>
<!-- ★ログアウト★ -->
<header>
<div class="head">
<h1>週末プラン投稿画面</h1>
<span class="logout"><a href="login_form.php">ログアウト</a></span>
 
</div>
</header>
 
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
<!-- ★削除★ -->
 
<?php if($_SESSION['id'] == $post['created_by']): ?>
<a href="message_delete.php?id=<?php echo htmlspecialchars($post['message_id'], ENT_QUOTES); ?>">削除</a>]<?php endif; ?></span></p>
<?php endforeach; ?>
</body>
</html>