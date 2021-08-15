<?php
session_start();
require_once(ROOT_PATH .'/Models/Article.php');

$articleID = $_POST['articleid'];
$select = new ArticleLogic();
$article = $select->selectArticle($articleID);

if(isset($_SESSION['user'])){
  $userName = $_SESSION['user']['name'];
  $userEmail = $_SESSION['user']['email'];
  $userID = $_SESSION['user']['id'];

  $checkID = [];
  $checkID [] = $userID;
  $checkID [] = $articleID;

  $check = $select->goodCheck($checkID);
  $keepcheck = $select->keepCheck($checkID);

  //$checkKeep = キープしているか判定

  if($check > 0){
    $goodcolor = "color";
  } else {
    $goodcolor = "color0";
  }

  if(!isset($article)){
    $article = 0;
  }
  //キープしていれば、#keep_btnの文字色を変更
  if($keepcheck > 0){
    $keepcolor = "kcolor";
  } else {
    $keepcolor = "kcolor0";
  }
  $header = 1;
} else {
  $header = 2;
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
  <div id="kizi">
    
    <div id="syousai">
      <h2>投稿者</h2>
      <p><?php echo $article['username'];?></p>
      <h2>BrandName</h2>
      <p><?php echo $article['title'];?></p>
      <h2>COMMENT</h2>
      <p><?php echo nl2br($article['comment']);?></p>
      <?php
        if( $article['url'] != null ){
          echo "<h2>サイトURL</h2><p class='blue'><a href='".$article['url']."' target='_blank'>".$article['url']."</a></p>";
        }
      ?>
    </div>
    <?php

    if(isset($_SESSION['user'])){
      echo '<form action="#" method="post" id="good">
        <input type="hidden" name="Auser_id" value="'.$article['username'].'" class="AuserID">
        <input type="hidden" name="user_id" value="'.$userID.'" class="userID">
        <input type="hidden" name="article_id" value="'.$articleID.'" class="article">
        <div>
          <p><input type="button" name="good" id="good_btn" class="'.$goodcolor.'" value="lit!"></p>
          <p class="good">'.$article['evaluation'].'</p>
          <p class="keepbtn"><input type="button" name="keep" id="keep_btn" class="'.$keepcolor.'" value="keep"></p>
        </div>
      </form>';
    }
     ?>

  </div>
  <?php require_once(ROOT_PATH .'Views/footer.php');?>
</div>
<script>
  $(document).ready(function(){
    var color = $('#good_btn').attr('class');
    var kcolor = $('#keep_btn').attr('class');

    if(color != 'color'){
      $('#good_btn').removeClass('color0');
    }
    if(kcolor != 'kcolor'){
      $('#keep_btn').removeClass('kcolor0');
    }
  });

  $(function(){
    $('#good_btn').on('click',function(){
      var userID = $('.userID').val();
      var articleID = $('.article').val();
      var num = $('.good').text();

      $.ajax({
        type: 'POST',
        url: 'ajaxgood.php',
        datatype: 'json',
        data: {
          userID: userID,
          articleID: articleID
        }
      }).done(function(data){
        console.log('Ajax Success');
        $('.d').text(userID);
        $('.c').text(articleID);
        $('#good_btn').toggleClass("color");
        var c = $('#good_btn').attr("class");
        if(c === 'color'){
          num ++;
          $('.good').text(num);
        } else {
          num --;
          $('.good').text(num);
        }
        console.log(c);
        //役に立った!!の総数を表示
        //$('good').text(data);
        //役に立った!!取り消し時の文字色

        //役に立った!!押した時の文字色

      }).fail(function(msg){
        console.log('Ajax Error');
      });
    });

    //keep_btnが押された時の非同期処理
    $('#keep_btn').on('click',function(){
      var userID = $('.userID').val();
      var articleID = $('.article').val();
      var num = $('.keep').text();

      $.ajax({
        type: 'POST',
        url: 'ajaxkeep.php',
        datatype: 'json',
        data: {
          userID: userID,
          articleID: articleID
        }
      }).done(function(data){
        console.log('Ajax Success');
        $('.d').text(userID);
        $('.c').text(articleID);
        $('#keep_btn').toggleClass("kcolor");
      }).fail(function(msg){
        console.log('Ajax Error');
      });
    });
  });
</script>
</body>
</html>
