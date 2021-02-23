<?php
  session_start();
  session_regenerate_id(true);
  if(isset($_SESSION['login'])==false){
    print 'ログインされていません。<br />';
    print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
  }
  else{
    print $_SESSION['staff_name'];
    print 'さんログイン中<br />';
    print '<br />';
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>サンプルホーム</title>
</head>
<body>
  <?php
  try{
    require_once('../common/common.php');

    $post=sanitize($_POST);
    $staff_name=$post['name'];
    $staff_mailadress=$post['mailadress'];
    $staff_syurui=$post['syurui'];
    $staff_naiyou=$post['naiyou'];

    // ローカル環境接続ーーーーーーーーーーーーーーー
    $dbn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
    $user = 'root';
    $pass = '';
    // ーーーーーーーーーーーーーーーーーーーーーーーー
    $dbh = new PDO($dbn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql='INSERT INTO users (name, mailadress, syurui, naiyou) VALUES (?, ?, ?, ?)';
    $stmt=$dbh->prepare($sql);
    $data[]=$staff_name;
    $data[]=$staff_mailadress;
    $data[]=$staff_syurui;
    $data[]=$staff_naiyou;
    $stmt->execute($data);

    $dbh=null;

    print $staff_name;
    print 'さんを追加しました。<br />';

  }
  catch(Exception $e){
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
  }

  ?>
  <a href="staff_list.php">戻る</a>

</body>
</html>
