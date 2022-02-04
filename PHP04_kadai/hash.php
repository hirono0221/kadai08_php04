<?php
// Phpのみの場合は、基本的に省略します。htmlも含むときはNG
$pw = password_hash('test1', PASSWORD_DEFAULT);
echo $pw;
echo '<br>';

$pw = password_hash('test2', PASSWORD_DEFAULT);
echo $pw;
echo '<br>';

$pw = password_hash('test3', PASSWORD_DEFAULT);
echo $pw;