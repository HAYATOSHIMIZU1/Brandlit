<?php
session_start();
require_once(ROOT_PATH .'/Controllers/Controller.php');
require_once(ROOT_PATH .'/Models/Article.php');

$userName = $_SESSION['user']['name'];
$userEmail = $_SESSION['user']['email'];
$userID = $_SESSION['user']['id'];

$user = new ArticleLogic();
$toukou = $user->userArticle($userID);
if(!isset($toukou)){
  $toukou = 0;
}

$user2 = new Controller();
$keep = $user2->myKeep($userID);
if(!isset($keep)){
  $keep = 0;
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
  <?php require_once(ROOT_PATH .'Views/header1.php');?>
  <div id="user">
    <p>Name：<?php echo $userName;?></p>
    <p>Email(ID)：<?php echo $userEmail;?></p>
    <p><a href="edit.php">アカウント編集</a><a href="delete.php">アカウント削除</a></p>
  </div>
  <div id="tk">
    <div id="toukou">
      <h2 class="fixed">投稿記事</h2>
      <div class="a">
        <?php
        $i = 0;
        if( $toukou == 0){
          echo "投稿記事がありません。";
        } else {
          foreach($toukou as $val){
            $i++;
            $time = substr($val['created_at'], 0, 11);
            if( $i % 2 === 1 ){
              echo "<div class='set'>
                      <div class='kizititle'>
                      <p>".$val['name']."&nbsp;".$time."</p>
                      <p class='title'>".$val['title']."</p>
                      <p>lit!数&nbsp;".$val['evaluation']."</p>
                      <form action='article.php' method='post' id='Aform'>
                        <input type='hidden' name='articleid' value='".$val['id']."' id='articleID'>
                        <input type='submit' value='記事詳細へ' class='kizi'>
                      </form>
                    </div>";
                } else {
                  echo "<div class='kizititle'>
                          <p>".$val['name']."&nbsp;".$time."</p>
                          <p class='title'>".$val['title']."</p>
                          <p>lit!数&nbsp;".$val['evaluation']."</p>
                          <form action='article.php' method='post' id='Aform'>
                            <input type='hidden' name='articleid' value='".$val['id']."' id='articleID'>
                            <input type='submit' value='記事詳細へ' class='kizi'>
                          </form>
                        </div>
                      </div>";
                }
          }
          if( $i % 2 === 1 ){
            echo "</div>";
          }
        }
        ?>
      </div>
    </div>
    <div id="keep">
      <h2 class="fixed">keep記事</h2>
      <div class="a">
        <?php
        $i = 0;
        if( $keep == 0){
          echo "Keepした記事がありません。";
        } else {
          foreach($keep as $val){
            $i++;
            $time = substr($val['created_at'], 0, 11);
            if( $i % 2 === 1 ){
              echo "<div class='set'>
                      <div class='kizititle'>
                      <p>".$val['name']."&nbsp;".$time."</p>
                      <p class='title'>".$val['title']."</p>
                      <p>lit!数&nbsp;".$val['evaluation']."</p>
                      <form action='article.php' method='post' id='Aform'>
                        <input type='hidden' name='articleid' value='".$val['id']."' id='articleID'>
                        <input type='submit' value='記事詳細へ' class='kizi'>
                      </form>
                    </div>";
                } else {
                  echo "<div class='kizititle'>
                          <p>".$val['name']."&nbsp;".$time."</p>
                          <p class='title'>".$val['title']."</p>
                          <p>lit!数&nbsp;".$val['evaluation']."</p>
                          <form action='article.php' method='post' id='Aform'>
                            <input type='hidden' name='articleid' value='".$val['id']."' id='articleID'>
                            <input type='submit' value='記事詳細へ' class='kizi'>
                          </form>
                        </div>
                      </div>";
                }
          }
          if( $i % 2 === 1 ){
            echo "</div>";
          }
        }
        ?>
      </div>
    </div>
  </div>
  <?php require_once(ROOT_PATH .'Views/footer.php');?>
</div>
</body>
</html>
