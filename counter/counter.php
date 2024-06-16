<?php
if (is_file('count.txt') === false) 
    file_put_contents('count.txt', 0);
$num = intval(file_get_contents('count.txt'));

$num++;
file_put_contents('count.txt', $num);
echo 'count:' . $num;




// file_get_contents → fopen,fgets,fcloseの合わせ技
// file_put_contents → fopen,fwrite,fcloseの合わせ技