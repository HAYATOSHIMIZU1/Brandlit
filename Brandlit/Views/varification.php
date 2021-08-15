<?php
session_start();
require_once(ROOT_PATH .'Models/User.php');

if( isset($_SESSION['err']) ){
  $err = 1;
} else {
  $err = 2;
}

if(isset($_SESSION['ninsyouerr'])){
  $nerr = $_SESSION['ninsyouerr'];
}
 ?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>認証ページ</title>
  <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
<div id="wrapper">
  <?php require_once(ROOT_PATH .'Views/header2.php');?>
  <div id="form">
    <form action="passwordedit.php" method="post" id="edit">
      <div class="formwrapper">
        <p>Name</p>
        <p id="none0" class="red"><?php if(isset($nerr)) echo $nerr;?></p>
        <input type="text" name="name" size="20" placeholder="田中　太郎" class="in" id="name" required>
        <p id="none1" class="red">※20文字以内で名前を入力してください。</p>
        <p>Email(ID)</p>
        <p class="red err<?php echo $err;?>">※入力されたemailは既に使用されています。</p>
        <input type="email" name="email" size="20" placeholder="xxx＠xxx" class="in" id="email" required>
        <p id="none2" class="red">※@マークの形式で入力してください。</p>
      </div>
      <div class="ninsyou"><input type="submit" value="認証する" class="btn"></div>
      </div>
    </form>
  </div>
  <?php require_once(ROOT_PATH .'Views/footer.php');?>
</div>
<script type="text/javascript">
  $(function(){
      $('#edit').submit(function(){
        var n_val = $('#name').val();
        var m_val = $('#email').val();

        if( n_val === "" || n_val.length > 20 ){
          $('#none1').css('display','block');
          $(".popup").css('opacity','0');
          $(".formwrapper").css('pointer-events','auto');
          return false;
        } else {
            $('#none1').css('display','none');
          }
        if( m_val === "" || ( m_val.match(/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/) != m_val )){
          $('#none2').css('display','block');
          $(".popup").css('opacity','0');
          $(".formwrapper").css('pointer-events','auto');
          return false;
        } else {
            $('#none2').css('display','none');
          }
    });

  });

</script>
</body>
</html>
