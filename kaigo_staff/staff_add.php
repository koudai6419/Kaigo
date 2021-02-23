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
  追加<br />
  <br />
  <form method="post" action="staff_add_check.php">
    お客様名を入力してください。<br />
    <input type="text" name="name" style="width:200px"><br />
    メールアドレス<br />
    <input type="text" name="mailadress" style="width:200px"><br />
    お問合せの種類<br />
    <select name="syurui">
      <option value="未選択">選択してください</option>
      <option value="お問い合わせ">お問い合わせ</option>
      <option value="資料請求">資料請求</option>
    </select>
    <br />
    内容<br />
    <input type="text" name="naiyou" style="width:200px"><br />
    <br />
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
  </form>
</body>
</html>
