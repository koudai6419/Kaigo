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
// AIされたプライマリーキーのcodeを渡している。
    $staff_code=$_GET['staffcode'];

    // ローカル環境接続ーーーーーーーーーーーーーーー
    $dbn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
    $user = 'root';
    $pass = '';
    // ーーーーーーーーーーーーーーーーーーーーーーーー
    $dbh = new PDO($dbn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// codeを使ってデータをSELECTしている。
    $sql='SELECT name, mailadress, syurui, naiyou FROM users WHERE code=?';
    $stmt=$dbh->prepare($sql);
    $data[]=$staff_code;
    $stmt->execute($data);

    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
    $staff_name=$rec['name'];
    $staff_mailadress=$rec['mailadress'];
    $staff_syurui=$rec['syurui'];
    $staff_naiyou=$rec['naiyou'];

    $dbh=null;
  }
  catch(Exception $e)
  {
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
  }
?>

修正<br />
<br />
コード<br />
<?php print $staff_code; ?>
<br />
<br />
<form method="post" action="staff_edit_check.php">
  <input type="hidden" name="code" value="<?php print $staff_code; ?>">
  お客様名<br />
  <input type="text" name="name" style="width:200px" value="<?php print $staff_name; ?>"><br />
  メールアドレス<br />
  <input type="text" name="mailadress" style="width:200px" value="<?php print $staff_mailadress; ?>"><br />
  お問合せの種類<br />
  <input type="text" name="syurui" style="width:200px" value="<?php print $staff_syurui; ?>"><br />
  内容<br />
  <input type="text" name="naiyou" style="width:200px" value="<?php print $staff_naiyou; ?>"><br />
  <br />
  <input type="button" onclick="history.back()" value="戻る">
  <input type="submit" value="OK">
</form>

</body>
</html>
