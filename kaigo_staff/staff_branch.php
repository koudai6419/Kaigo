<?php
  session_start();
  session_regenerate_id(true);
  if(isset($_SESSION['login'])==false){
    print 'ログインされていません。<br />';
    print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
  }
// 参照ボタンが押された時の遷移先
  if (isset($_POST['disp'])==true) {
    // 名前を選択されずにボタンだけ押されてた場合NGページへ飛ばす
    if (isset($_POST['staffcode'])==false) {
      header('Location:staff_ng.php');
      exit();
    }
    $staff_code=$_POST['staffcode'];
    header('Location:staff_disp.php?staffcode='.$staff_code);
    exit();
  }
// 修正ボタンが押された時の遷移先(追加のためボタンは押されない)
  if (isset($_POST['add'])==true) {
    header('Location:staff_add.php');
    exit();
  }
// 修正ボタンが押された時の遷移先
  if (isset($_POST['edit'])==true) {
    if (isset($_POST['staffcode'])==false) {
      header('Location:staff_ng.php');
      exit();
    }
    $staff_code=$_POST['staffcode'];
    header('Location:staff_edit.php?staffcode='.$staff_code);
    exit();
  }
// 削除ボタンが押された時の遷移先
  if (isset($_POST['delete'])==true) {
    if (isset($_POST['staffcode'])==false) {
      header('Location:staff_ng.php');
      exit();
    }
    $staff_code=$_POST['staffcode'];
    header('Location:staff_delete.php?staffcode='.$staff_code);
    exit();
  }
?>
