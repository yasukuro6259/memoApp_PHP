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
<h2>Practice</h2>
<!-- <pre> -->
<?php   
  if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
    // isset関数 => 変数がセットされていればtrueを返す。されていなければfalseを返す。
    // 'page'はHTMLで得られた情報??
    // if文の中で変数定義して、スコープ外に出してもエラーは出ない
  } else {
    $page = 1;
  }
  // $page=1 => LIMIT 0, 5
  $start = 5 * ($page - 1);

  $memos = $db->prepare('SELECT * FROM memos ORDER BY id DESC LIMIT ?, 5');
  // LIMIT x, y => x ~ yまで
  $memos->bindParam(1, $start, PDO::PARAM_INT);
  // bindParam(?の位置, ?に代入する値, PDO::PARAM_INT)=>PDO::PARAM_INT は$_REQUESTのパラメーターの型を整数に指定して渡すことができる
  $memos->execute();
  // executeのパラメーターで指定すると型を指定できない、パラメーターを型を指定できず、値を渡すことができない。


  // // $dbから全データを取り出して降順にする
  // $memos = $db->query('SELECT * FROM memos ORDER BY id DESC LIMIT 0, 5 ');
  
  // $count = $db->exec('INSERT INTO my_items SET maker_id=1, item_name="もも", price=210, keyword="缶詰、ピンク、甘い"');
  // echo $count . '件のデータを挿入しました'
  //// execを用いてSQLを発行。$countにはそれによって影響を受けたレコード数の値が代入される

  // $records = $db->query('SELECT * FROM my_items');
  // // queryメソッド SQL文で得られた値を受け取る
  // // $recordsはmydbからSQLで発行されたデータを含むインスタンス
  // while ($record = $records->fetch()){
  //   //fetchは$recordsオブジェクト(PDO)が持つメソッドで、得られたデータベース情報を1つ取得するメソッド
  //   print($record['item_name'] . "\n");
  //   //連想配列（$record）の中身を取得 $配列名['キー']
  // }
?>
<article>
  <?php while($memo = $memos->fetch()): ?>
  <p> <a href="memo.php?id=<?php print ($memo['id']) ?>"> <?php print(mb_substr($memo['memo'], 0, 50)); ?> </a> </p>
  <!-- mb_substr関数 => mb_substr(内容, 開始位置, 終了位置 ) -->
  <time> <?php print ($memo['created_at']); ?></time>
  <hr>
  <!-- hrタグは水平方向の罫線 -->
  <?php endwhile; ?>
</article>
<?php if($page >= 2):?>
<a href='index.php?page=<?php print $page - 1 ?>'><?php print ($page - 1) ?>ページへ</a>
|
<?php endif; ?>
<!-- 登録された件数を数字で取得する
最大ページ数が求める
-> 登録された件数を5で割る（数字は切り上げる）
$pageが最大ページ数より小さいときに次ページのリンクをつける -->

<?php
$counts = $db->query('SELECT COUNT(*) as cnt FROM memos' );
// memosテーブルのレコード数を取得し、名前(列名)を「cnt」とした。 
$count = $counts->fetch();
// $countsの情報を取得した。
// 
$max_page = ceil($count['cnt'] / 5);
if ($page < $max_page): ?>
<a href='index.php?page=<?php print $page + 1 ?>'><?php print ($page + 1) ?>ページへ</a>
<?php endif; ?>

<!-- </pre> -->
</main>
</body>    
</html>