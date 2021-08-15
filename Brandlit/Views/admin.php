<?php

session_start();
require_once(ROOT_PATH .'/Controllers/Controller.php');
$user = new Controller();
$arr = [];


if(!empty($_POST['name'])){
  $username = $_POST['name'];
  $article = $user->selectArticle($username);
  if($_POST['date1'] && $_POST['date2']){
    $arr[] = $_POST['name'];
    $arr[] = $_POST['date1'];
    $arr[] = $_POST['date2'];
    $article = $user->UserArticle($arr);
  }
} else {
  if(!empty($_POST['date1'])){
    $arr[] = $_POST['date1'];
    $arr[] = $_POST['date2'];
    $article = $user->DateArticle($arr);
  }
  if(!empty($_POST['all'])){
    $article = $user->mainArticle();
  }
  if(!empty($_POST['delid'])){
    $user->delArticle($_POST['delid']);
  }
}
if(empty($_POST['name']) && empty($_POST['date1'])){
  $article = $user->mainArticle();
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>ログインページ</title>
  <script src="js/jquery-3.6.0.min.js"></script>
  <style>
    .admin {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: auto;
    }
    table {
      table-layout:fixed;
      margin: 0 auto;
    }
    table th, table td {
      padding: 0 10px;
    }
    form {
      margin: 10px;
    }
    a {
      color: #4f52ff;
    }
    .dateform {
      padding : 20px 0;
    }
    input[type="text"],
    input[type="date"],
    input[type="submit"]
    {
      border: 1px solid #000;
      border-radius: 5px;
    }
    .all {
      border-top: 1px dashed #000;
      padding-top: 10px;
    }
    .comment {
      width: 300px;
      word-break: keep-all;
    }
  </style>
</head>
<body>
  <?php require_once(ROOT_PATH .'Views/header2.php');?>
  <div class="admin" style="margin: 20px;">管理者ページ</div>
  <div id="category">
    <form action="admin.php" method="post">
      投稿者:<input type="text" name="name">
      <div class="dateform">
        日付:<input type="date" name="date1" value="">～<input type="date" name="date2" value="">
        <input type="submit" value="の記事を表示">
      </div>
    </form>
  
  </div>
  <div class="admin">
    <table border="1" style="border-collapse: collapse">
      <tr>
        <th>投稿日時</th>
        <th>投稿者</th>
        <th>タイトル</th>
        <th>コメント</th>
        <th>URL</th>
      </tr>
      <?php
        foreach($article as $val){
          echo "<tr>
                  <td>".$val['created_at']."</td>
                  <td>".$val['username']."</td>
                  <td>".$val['title']."</td>
                  <td class='comment'>".$val['comment']."</td>
                  <td><a href='".$val['url']."' target='_blank'>".$val['url']."</a></td>
                  <td class='delete'>
                    <form action='admin.php' method='post' class='adform'>
                      <input type='hidden' value='".$val['articleid']."' name='delid'>
                      <input type='submit' value='削除'>
                    </form>
                  </td>
                </tr>";
        }
      ?>
    </table>
  </div>
  <?php require_once(ROOT_PATH .'Views/footer.php');?>
<script type="text/javascript">

</script>
</body>
</html>
