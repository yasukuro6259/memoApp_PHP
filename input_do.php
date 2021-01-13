<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/style.css">

<title>PHP</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>    
</header>

<main>
<h2>Practice</h2>
<pre>
<?php
require('dbconnect.php');
$statement = $db->prepare('INSERT INTO memos SET memo =?, created_at=NOW()');
// 投稿した内容をテーブルに保存するコード。(memosテーブルのmemoカラムに"投稿した内容"と"時刻"を挿入する)
// prepare ?部分がユーザーが入力した情報となるところ
// statementオブジェクト(PDOがつながっている？?)
$statement->execute(array($_POST['memo']));
// executeメソッド(SQLを実行するメソッド )、execメソッドと同じものではない。
// executeメソッドのパラメーターにprepareで指定した箇所(?)に入れるものを指定する。
//下記コマンドでも投稿内容をdbに保存できる。
// $statement->bindParam(1, $_POST["memo"]); =>これでも可能。1は?が出てきた順番、?マークが複数ある時や数値を扱う時に使う。
// $statement->execute();
echo 'メッセージが登録されました';
// $db->exec('INSERT INTO memos SET memo ="' .$_POST['memo']. '", created_at=NOW()');
// //$execメソッド dbオブジェクト
// //$_POSTのPOSTはformタグのHTTPメソッド
// // SQLに与える値は適切な処理をしてからでないと、危険な文字列や記号などでSQLが破壊されデータを盗み出される恐れがある。その為、ユーザーが入力した内容はSQLに直接埋め込まないようにする。
?>
</pre>
</main>
</body>    
</html>