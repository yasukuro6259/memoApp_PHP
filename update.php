<?php require('dbconnect.php'); ?>
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
<?php
$id = $_REQUEST['id'];
if (!isset($id) || !is_numeric($id) || $id <= 0){
  print ("idは1以上の数字で設定してください");
  exit();
}
?>
<h2>Practice</h2>
<?php
$memos = $db->prepare('SELECT * FROM memos WHERE id=?');
$memos->bindParam(1, $id, PDO::PARAM_INT);
$memos->execute();
// $memos->execute(array($id));
$memo = $memos->fetch();
?>

<form action="update_do.php" method="post">
  <input type="hidden" name="id" value="<?php print($id); ?>">
  <!-- inputのtype属性を"hidden"とし値(value)をすることで、データを送信する際にid情報ををパラメーターとして渡す。 -->
  <textarea name="memo" cols="50" rows="10"> <?php print($memo['memo']); ?> </textarea><br>
  <button type="submit">更新する</button>
</form>

</main>
</body>
</html>