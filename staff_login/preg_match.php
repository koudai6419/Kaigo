<?php
$mail ="test@sample.com";
$mail2="あいうえお";
$mail3="___a.a.aa@aaa.aa.aa";

if(preg_match("/^([a-zA-Z0-9\+\-_]+)(\.[\w\+\-_]+)*@([\w\-]+\.)+\w{2,6}$/",$mail)){#$mailの中に○○のパターンがあったら、中身を実行
  echo "正しいアドレスです！";
}else{
  echo "間違ったアドレスです！";
}
