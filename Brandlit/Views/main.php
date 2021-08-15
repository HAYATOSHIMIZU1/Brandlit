<?php
session_start();

require_once(ROOT_PATH .'/Controllers/Controller.php');
require_once(ROOT_PATH .'/Models/User.php');

if(isset($_POST['email'])) {
  if($_POST['email'] === "admin@admin"){
    header('Location: admin.php');
  }

  $email = $_POST['email'];
  $password = $_POST['password'];
  //ログイン成功時
  $user = new UserLogic();
  $result = $user->login( $email,$password );
  if($result < 2){
    switch($result){
      case 0:
        $_SESSION['login_err'] = 'IDが一致しませんでした。';
        header('Location: index.php');
        break;
      case 1:
        $_SESSION['login_err'] = 'パスワードが一致しませんでした。';
        header('Location: index.php');
        break;
    }
  }

  $params = $user->getUserByEmail( $email );
  $_SESSION['user'] = $params;
  $userName = $_SESSION['user']['name'];
  $header = 1;
} else {
  $header = 2;
}

if( isset($_SESSION['user']) ) {
  $header = 1;
  $userName = $_SESSION['user']['name'];
}

$user2 = new Controller();
if(isset($_POST['category'])){
  $categoryID = $_POST['category'];
  $article = $user2->Article($categoryID);
} else {
  $article = $user2->mainArticle();
}

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>Brandlit</title>
  <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
<div id="wrapper">
  <?PHP if($header === 1) {
          require_once(ROOT_PATH .'Views/header1.php');
        } else {
          require_once(ROOT_PATH .'Views/header2.php');
        }
  ?>
    <div id="category">
      <form action="main.php" method="post" name="category">
        <p class="cp">カテゴリー別に表示</p>
        <select name="category" class="kadomaru" required>
          <option value="">カテゴリー選択</option>
          <option value="1">20代(男性)</option>
          <option value="2">20代(女性)</option>
          <option value="3">30代(男性)</option>
          <option value="4">30代(女性)</option>
          <option value="5">40代以上(男性)</option>
          <option value="6">40代以上(女性)</option>
        </select>
        <input type="submit" value="絞り込み" class="catesubmit btn">
      </form>
    </div>
    <div id="kizi" class="main">
    <?php
      $i = 0;
      foreach($article as $val){
        $i++;
        if( $i % 2 === 1 ){
          echo "<div class='set'>
                  <div class='kizititle'>
                    <p>".$val['username']."&nbsp;&nbsp;&nbsp;".substr($val['created_at'],0,10)."</p>
                    <p class='title'>".$val['title']."</p>
                    <form action='article.php' method='post' id='Aform'>
                      <input type='hidden' name='articleid' value='".$val['articleid']."' id='articleID'>
                      <input type='submit' value='記事詳細へ' class='kizi'>
                    </form>
                    <p>lit! ".$val['evaluation']."</p>
                  </div>";
        } else {
              echo "<div class='kizititle'>
                      <p>".$val['username']."&nbsp;&nbsp;&nbsp;".substr($val['created_at'],0,10)."</p>
                      <p class='title'>".$val['title']."</p>
                      <form action='article.php' method='post' id='Aform'>
                        <input type='hidden' name='articleid' value='".$val['articleid']."' id='articleID'>
                        <input type='submit' value='記事詳細へ' class='kizi'>
                      </form>
                      <p>lit! ".$val['evaluation']."</p>
                    </div>
                  </div>";
          }
      }
      if( $i % 2 === 1 ){
        echo "</div>";
      }
    ?>
  </div>
  <?php require_once(ROOT_PATH .'Views/footer.php');?>
</div>
</body>
</html>
