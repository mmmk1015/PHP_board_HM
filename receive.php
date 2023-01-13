<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>出力結果</title>
</head>
<body>
    <?php
    // print_r($_POST);
    echo htmlspecialchars($_POST['title_name'], ENT_QUOTES);
    echo '<br>';
    echo match ($_POST['category']) {
        '1' => 'がっこう',
        '2' => 'ならいごと',
        '3' => 'おうち',
    } . '<br>';
    echo match ($_POST['difficulty']) {
        '1' => '😊',
        '2' => '🙂',
        '3' => '😣',
    } . '<br>';
    if (is_numeric($_POST['voltage'])) {
        echo number_format($_POST['voltage']);
    }
    echo '<br>';
    echo nl2br(htmlspecialchars($_POST['howto'], ENT_QUOTES));
    echo '<br>';
    ?>
</body>
</html>