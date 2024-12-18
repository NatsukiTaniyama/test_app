<?php
require_once('connection.php');

//取得したデータを表示させる
function getTodoList()
{
    return getAllRecords();
}

function getSelectedTodo($id)
{
    return getTodoTextById($id);
}

function savePostedData($post)
{
    $path = getRefererPath();
    switch ($path) {
        case '/new.php': //新規作成ページからPOSTされたなら
            createTodoData($post['content']);
            break;
        case '/edit.php': //編集ページからPOSTされたなら
            updateTodoData($post);
            break;
        case '/index.php':
            deleteTodoData($post['id']);
            break;
        default:
            break;
    }
}

function getRefererPath()
{
    $urlArray = parse_url($_SERVER['HTTP_REFERER']);
    return $urlArray['path'];
}





// ★データの受け取り・受け渡しとDBへの処理を依頼する機能をまとめたファイル
// ★実装したgetTodoList関数を index.php 内で呼び出して、TODOデータの一覧表示を行います。
//createTodoData($post['content']);調べる contentを変えたらどこを変える必要があるか。