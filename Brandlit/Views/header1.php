<?php
if( $userName === '管理者' ){
  $root = 'admin';
}else{
  $root = 'mypage';
}

?>
<header>
  <div id="header">
    <div class="hdLeft hover">
      <p><a href="main.php">Brandlit</a></p>
    </div>
    <div class="hdRight hover">
      <p><a href="index.php">ログアウト</a></p>
      <p><a href="article_up.php">投稿</a></p>
      <p><a href="<?= $root;?>.php"><?= $userName;?></a></p>
    </div>
  </div>
</header>
