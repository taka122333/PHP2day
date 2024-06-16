<?php
var_dump($_POST);

//書き込み
if (isset($_POST['send']) === true) {
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    if ($name !== '' && $comment !== '') {
        $fp = fopen('data2.txt', 'a');
        if (flock($fp, LOCK_EX) === true) {
            fwrite($fp, $name . "\t" . $comment . "\n");
            flock($fp, LOCK_UN);
        }
    } else {
        echo '名前もしくは、コメントが記入されていません';
    }
}

//ファイルに書き込まれたデータを読み込む
$fp = fopen('data2.txt', 'r');
$lineArray3 = [];
while ($res = fgets($fp)) {
    $lineArray = explode("\t", $res);
    if (isset($lineArray[0]) && isset($lineArray[1])) {
        $lineArray2 = [
            'name' => $lineArray[0],
            'comment' => $lineArray[1],
        ];
    } else {
        $lineArray2 = null;
    }

    $lineArray3[] = $lineArray2;
}
fclose($fp);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板2</title>
</head>
<body>
    <form method="post" action="">
        名前<input type="text" name="name" value=""><br>
        コメント<textarea name="comment" rows="4" cols="20"></textarea><br>
        <input type="submit" name="send" value="書き込む">
    </form>
    <?php
        if ($lineArray3[0] !== null) {
            foreach ($lineArray3 as $value) {
                echo '名前：' . $value['name'] . '<br>';
                echo 'コメント：' . $value['comment'] . '<br><br>';
            }
        }
    ?>
</body>
</html>