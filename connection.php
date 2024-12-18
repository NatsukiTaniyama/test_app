<?php
require_once('config.php');

function connectPdo()
{
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}

function createTodoData($todoText)
{
    $dbh = connectPdo();
    $sql = 'INSERT INTO todos (content) VALUES ("' . $todoText . '")';
    $dbh->query($sql);
}

function getAllRecords()
{
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';
    return $dbh->query($sql)->fetchAll();
}

function updateTodoData($post)
{
    $dbh = connectPdo();
    $sql = 'UPDATE todos SET content = "' . $post['content'] . '" WHERE id = ' . $post['id']; //$sqlにUPDATE文を格納する
    $dbh->query($sql); //queryメソッドでSQL文を実行しデータが更新される
}

function getTodoTextById($id)
{
    $dbh = connectPdo();
    $sql = "SELECT * FROM todos WHERE deleted_at IS NULL AND id = {$id}"; //変数は波括弧で囲んで記述。ダブルクォーテーションで囲まれると変数展開が行われる。
    $data = $dbh->query($sql)->fetch();
    return $data['content'];
}

function deleteTodoData($id)
{
    $dbh = connectPdo();
    $now = date('Y-m-d H:i:s');
    $sql = "UPDATE todos SET deleted_at = '$now' WHERE deleted_at IS NULL AND id = {$id}";
    $dbh->query($sql);
}







// ★PDOという定義済みのクラスをインスタンス化している。PODとはDBとやりとりをすることができるメソッドが含まれているクラス。
// ★DBへ接続するconnectPdo関数を呼びだし、その返り値を$dbhに格納する
// ★$sql を queryメソッドの引数に渡して実行することで、INSERT文を実行することができる。

// ★$e の中にはtry{}でインスタンス化されたPDOインスタンスが格納されている?
// ★tryやcatchは例外処理を実装する際に使用。例外が発生する可能性がある処理を、try {  }の中に書く。
// ★$spl にはtodosテーブルから、削除されていないレコードを全件取得する という内容のSQL文を格納している。
// ★$dbh->query($sql) でDBに対して作成したSQL文を実行し、fetchAll() で実行結果を全件配列で取得、そしてその結果をreturnしている。
// ★queryメソッドはPDOStatement オブジェクトを返す。 失敗した場合に false を返す。