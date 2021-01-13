<?php // mysqlへの接続、try{}catch{} 例外処理
try{
  $db = new PDO('mysql:dbname=mydb; host=localhost; charset=utf8', 'root', 'root');
  // $dbはインスタンス、mydbへのアクセス情報が代入される
  // new PDO('接続文字列','ユーザー名','パスワード')    mydbは自分で設定したDB名
  // PDOクラス => PHP Data Object
} catch(PDOException $e){
    echo 'DB接続エラー: '. $e->getMessage();
  }
  ?>