<?php
$err_msg1 = '';
$err_msg2 = '';

$family_name = (isset($_POST['family_name']) === true) ? $_POST['family_name'] : '';
$first_name = (isset($_POST['first_name']) === true) ? $_POST['first_name'] : '';

var_dump($_POST);


//投稿がある場合のみ処理を行う
if (isset($_POST['send']) === true) {
    if ($family_name === '') $err_msg1 = '氏を入力してください';
    if ($first_name === '') $err_msg2 = '名を入力してください';
    if ($err_msg1 === '' && $err_msg2 === '') {
        echo 'mail send !<br>';
        exit('this task stop!');
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム</title>
</head>
<body>
    <form method="post" action="">
        氏：<input type="text" name="family_name" value="<?php echo $family_name; ?>">
        <?php echo $err_msg1; ?><br>
        名：<input type="text" name="first_name" value="<?php echo $first_name; ?>">
        <?php echo $err_msg2; ?><br>
        <input type="submit" name="send" value="クリック">
    </form>
</body>
</html>