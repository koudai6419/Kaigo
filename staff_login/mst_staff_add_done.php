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
    $staff_pass=$post['pass'];

    // $staff_name=htmlspecialchars($staff_name,ENT_QUOTES,'UTF-8');
    // $staff_pass=htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');


    // ローカル環境接続ーーーーーーーーーーーーーーー
    $dbn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
    $user = 'root';
    $pass = '';
    // ーーーーーーーーーーーーーーーーーーーーーーーー
    $dbh = new PDO($dbn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql='INSERT INTO mst_staff (name, password) VALUES (?, ?)';
    $stmt=$dbh->prepare($sql);
    $data[]=$staff_name;
    $data[]=$staff_pass;
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
  <a href="staff_login.html">戻る</a>

</body>
</html>
