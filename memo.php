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
<?php
  require('dbconnect.php');
  $id = $_REQUEST['id'];
  // $_REQUEST['カラム名'] => $_GET、$_POST、$_COOKIE などの内容をまとめた変数(今回は$_GET)
  if(!is_numeric($id) || $id <= 0){
    print ('1以上の数字で指定してください');
    exit();
  }
  
  $memos = $db->prepare('SELECT * FROM memos WHERE id=?');
  $memos->execute(array($id));
  $memo = $memos->fetch();
  ?>
  <article>
    <pre>
      <?php print($memo['memo']); ?> 
      <a href="index.php">戻る</a>
      <a href="update.php?id=<?php print $memo['id']?>">編集</a>
    </pre>
  </article>
</main>
</body>
</html>
