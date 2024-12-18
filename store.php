<?php
require_once('functions.php');
savePostedData($_POST);
header('Location: ./index.php');










// ★require_once()：引数に渡したファイルで定義されている関数などを使用できるようにする関数。今回はfunctions.phpを引数に指定。
// ★functions.php内にあるcreateData関数にPOSTデータを渡すことが可能になる
// ★header関数を用いてリダイレクト先を指定する。
// ★$_POSTは連想配列。$_POST = ['name' => 'value'] inputタグのname属性がキー、value属性がバリューとなるような連想配列として格納される。

