<?php
# 送信先のアドレス
$mailto = "";
# 送信後画面からの戻り先
$toppage = "./index.html";


// ローカル環境接続ーーーーーーーーーーーーーーー
$dbn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
$user = 'root';
$pass = '';
// ーーーーーーーーーーーーーーーーーーーーーーーー

#========================================
#入力情報の受け取りと加工
#========================================
$name = $_POST["name"];
$mailadress = $_POST["mailadress"];
// $age = $_POST["age"];
// $gender = $_POST["gender"];
$syurui = $_POST["syurui"];
$naiyou = $_POST["naiyou"];

#無効化
$name = htmlentities($name,ENT_QUOTES, "UTF-8");
$mailadress = htmlentities($mailadress,ENT_QUOTES, "UTF-8");
// $age = htmlentities($age,ENT_QUOTES, "UTF-8");
// $gender = htmlentities($gender,ENT_QUOTES, "UTF-8");
$syurui = htmlentities($syurui,ENT_QUOTES, "UTF-8");
$naiyou = htmlentities($naiyou,ENT_QUOTES, "UTF-8");

#改行処理
$name = str_replace("\r\n", "", $name);
$mailadress = str_replace("\r\n", "", $mailadress);
// $age = str_replace("\r\n", "", $age);
// $gender = str_replace("\r\n", "", $gender);
$syurui = str_replace("\r\n", "", $syurui);
$naiyou = str_replace("\n", "\t", $naiyou);

#入力チェック
if ($name==""){error("名前が未入力です");}
if (!preg_match("/\w+@\w+/",$mailadress)){error("メールアドレスが不正です"); }
// if ($age==""){error("年齢が未入力です");}
// if ($gender==""){error("性別が未入力です");}
if ($syurui==""){error("種類が未入力です");}
if ($naiyou==""){error("内容が未入力です");}

# 分岐チェック
if ($_POST["mode"] == "post") { conf_form(); }
else if($_POST["mode"] == "send") { send_form(); }

#-----------------------------------------------------------
#  確認画面
#-----------------------------------------------------------
function conf_form(){
  global $name;
  global $mailadress;
  // global $age;
  // global $gender;
  global $syurui;
  global $naiyou;

  # テンプレート読み込み
  $conf = fopen("tmpl/conf.tmpl","r") or die;
  $size = filesize("tmpl/conf.tmpl");
  $data = fread($conf , $size);
  fclose($conf);

  # 文字置き換え
  $data = str_replace("!name!", $name, $data);
  $data = str_replace("!mailadress!", $mailadress, $data);
  // $data = str_replace("!age!", $age, $data);
  // $data = str_replace("!gender!", $gender, $data);
  $data = str_replace("!syurui!", $syurui, $data);
  $data = str_replace("!naiyou!", $naiyou, $data);

     # 表示
     echo $data;
     exit;
  }

  #-----------------------------------------------------------
  #  エラー画面
  #-----------------------------------------------------------
  function error($msg){
    $error = fopen("tmpl/error.tmpl","r");
    $size = filesize("tmpl/error.tmpl");
    $data =  fread($error , $size);
    fclose($error);

    #文字置き換え
    $data = str_replace("!message!", $msg, $data);

    #表示
    echo $data;
    exit;
  }

  #-----------------------------------------------------------
  #  CSV書込
  #-----------------------------------------------------------
  function send_form(){
    global $dbn;
    global $user;
    global $pass;
    global $name;
    global $mailadress;
    // global $age;
    // global $gender;
    global $syurui;
    global $naiyou;

    try{
      $dbh = new PDO($dbn, $user, $pass);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if ($dbh == null){
        # DB接続に失敗したときここは実行されず、catch内が実行される
      }else{
        #INSERT文の定義
        $sql = "INSERT INTO users (name, mailadress, syurui, naiyou) VALUES (:name, :mailadress, :syurui, :naiyou)";
        # プリペアードステートメント
        $stmt = $dbh->prepare($sql);

        #bindParamによるパラメータ－と変数の紐付け
        $stmt -> bindParam(':name',$name);
        $stmt -> bindParam(':mailadress',$mailadress);

    // 項目が多くてコードの入力と手直しによるミスが増えるので年齢・性別は削除
        // $stmt -> bindParam(':age',$age);
        // $stmt -> bindParam(':gender',$gender);

        $stmt -> bindParam(':syurui',$syurui);
        $stmt -> bindParam(':naiyou',$naiyou);

        #入力内容の指定
        $name = $_POST["name"];
        $mailadress = $_POST["mailadress"];
        // $age = $_POST["age"];
        // $gender = $_POST["gender"];
        $syurui = $_POST["syurui"];
        $naiyou = $_POST["naiyou"];

        #INSERTの実行
        $stmt->execute();
      }
    }catch (PDOException $e){
      echo "エラー内容：".$e->getMessage();
      die();
    }

    $user_input = array($name,$mailadress,$syurui,$naiyou);
    mb_convert_variables("SJIS","UTF-8",$user_input);
    $fh = fopen("user.csv","a");
    flock($fh,LOCK_EX);
    fputcsv($fh, $user_input);
    flock($fh,LOCK_UN);
    fclose($fh);

    # テンプレート読み込み
    $conf = fopen("tmpl/send.tmpl","r") or die;
    $size = filesize("tmpl/send.tmpl");
    $data = fread($conf , $size);
    fclose($conf);

    #文字置き換え
    global $toppage;
    $data = str_replace("!top!", $toppage, $data);
    #表示
    echo $data;
    exit;
  }
