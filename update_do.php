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
  $statement = $db->prepare('UPDATE memos SET memo=? WHERE id=?');
  $statement->bindParam(1, $_POST['memo']);
  $statement->bindParam(2, $_POST['id']);
  $statement->execute();
  // $statement->execute(array($_POST['memo'], $_POST['id']));
  echo "更新が完了しました。"
?>
</pre>
<a href="index.php">一覧に戻る</a>
</main>
</body>    
</html>