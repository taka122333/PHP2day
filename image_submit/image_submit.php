<?php
    var_dump($_POST); echo '<br><br>';

    //送信ボタンが押されているかどうか
    if (isset($_POST['send']) === true) {
        var_dump($_FILES); echo '<br><br>';
        $tmp_image = $_FILES['image'];

        //エラーがなく、サイズが0ではないか
        if ($tmp_image['error'] === 0 && $tmp_image['size'] !== 0) {
            if (is_uploaded_file($tmp_image['tmp_name']) === true) {
                $image_info = getimagesize($tmp_image['tmp_name']);
                $image_mime = $image_info['mime'];
                if ($tmp_image['size'] > 1048576) {
                    echo 'アップロードできる画像サイズは、1MBまでです';
                } elseif (preg_match('/^image\/jpeg$/', $image_mime) === 0) {
                    echo 'アップロードできる画像の形式は、JPEG形式だけです';
                } elseif (move_uploaded_file($tmp_image['tmp_name'], './upload_' . time() . '.jpg') === true) {
                    echo '画像のアップロードが完了しました';
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>画像アップロード</title>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" name="send" value="送信">
    </form>
</body>
</html>