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
  require_once('../common/common.php');

  $post=sanitize($_POST);
  $staff_code=$_POST['code'];
  $staff_name=$post['name'];
  $staff_mailadress=$post['mailadress'];
  $staff_syurui=$post['syurui'];
  $staff_naiyou=$post['naiyou'];


  if($staff_name=='') {
    print 'お客様名が入力されていません。<br />';
  }
  else {
    print 'お客様名:';
    print $staff_name;
    print '<br />';
  }

  if($staff_mailadress==''){
    print 'メールアドレスが入力されていません。<br />';
  }
  else{
    print 'メールアドレス:';
    print $staff_mailadress;
    print '<br />';
  }

  if($staff_syurui==''){
    print 'お問合せの種類が入力されていません。<br />';
  }
  else{
    print 'お問合せの種類:';
    print $staff_syurui;
    print '<br />';
  }

  if($staff_naiyou==''){
    print '内容が入力されていません。<br />';
  }
  else{
    print '内容:';
    print $staff_naiyou;
    print '<br />';
  }

  if($staff_name==''||$staff_mailadress==''||$staff_syurui==''||$staff_naiyou==''){
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';
  }
  else{
    print '<form method="post" action="staff_edit_done.php">';
    print '<input type="hidden" name="code" value="'.$staff_code.'">';
    print '<input type="hidden" name="name" value="'.$staff_name.'">';
    print '<input type="hidden" name="mailadress" value="'.$staff_mailadress.'">';
    print '<input type="hidden" name="syurui" value="'.$staff_syurui.'">';
    print '<input type="hidden" name="naiyou" value="'.$staff_naiyou.'">';
    print '<br />';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" value="ＯＫ">';
    print '</form>';
  }
  ?>
</body>
</html>
