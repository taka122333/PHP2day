<?php
//データの取得
$data = '';

$fp = fopen('data.txt', 'r');

$flg = true;
$count = 0;
while ($flg === true) {
    $res = fgets($fp);
    if ($res === false) {
        $flg = false;
    }
    $data .= $res;
    $count++;
    //名前、コメントを1まとめとして改行
    if ($count %2 === 0) {
        $data .= '<br>';
    }
}
fclose($fp);

//データの書き込み
var_dump($_POST);

if (isset($_POST['send']) === true) {
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    if ($name !== '' && $comment !== '') {
        $fp = fopen('data.txt', 'a');
        if (flock($fp, LOCK_EX) === true) {
            fwrite($fp, $name . "\n" . $comment . "\n");
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    } else {
        echo '名前、またはコメントが記入されていません';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板</title>
</head>
<body>
    <form method="post" action="">
        名前：<input type="text" name="name" value=""><br>
        コメント：<textarea name="comment" rows="8" cols="30"></textarea><br>
        <input type="submit" name="send" value="書き込む">
    </form>
    <?php echo $data; ?>
</body>
</html>