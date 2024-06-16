<?php
$file = new SplFileObject('read.csv'); //","で勝手に区切ってくれる
$file->setFlags(SplFileObject::READ_CSV); //"setFlgs:SplFileObject内の関数。フラグをセットする。"

$i = 1;
$flg = true;

foreach ($file as $line) {
    if ($line[0] === null) continue;
    $divDate = explode('-', $line[1]);
    if (
        preg_match('/^[0-9]{4}$/', trim($line[0])) === 0 || //trim　→ 先頭と末尾の空白を取り除く
        checkdate($divDate[1], $divDate[2], $divDate[0]) === false ||
        preg_match('/^[0-9]$/', $line[2]) === 0
    ) {
        echo $i . '行目にエラーがあります<br>';
        $flg = false;
    }
    $i++;
}

if ($flg === true) {
    echo '正常に終了しました';
}