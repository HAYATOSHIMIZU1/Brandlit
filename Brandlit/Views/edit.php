<?php
session_start();
require_once(ROOT_PATH .'Models/User.php');
if(isset($_SESSION)){
  $userName = $_SESSION['user']['name'];
  $userEmail = $_SESSION['user']['email'];
  $userID = $_SESSION['user']['id'];
}

if( isset($_SESSION['err']) ){
  $err = 1;
} else {
  $err = 2;
}

 ?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>編集ページ</title>
  <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
<div id="wrapper">
  <?php require_once(ROOT_PATH .'Views/header1.php');?>
  <div id="form">
    <form action="edit_comp.php" method="post" id="edit">
      <div class="formwrapper">
        <p>Name</p>
        <input type="text" name="name" size="20" placeholder="田中　太郎" class="in" id="name" required>
        <p id="none1" class="red">※20文字以内で名前を入力してください。</p>
        <p>Email</p>
        <p class="red err<?php echo $err;?>">※入力されたemailは既に使用されています。</p>
        <input type="email" name="email" size="20" placeholder="xxx＠xxx" class="in" id="email" required>
        <p id="none2" class="red">※@マークの形式で入力してください。</p>
        <p>Password</p>
        <input type="password" name="password" size="12" pattern="^[0-9A-Za-z]+$" minlength="8" maxlength="12" class="in" id="pass" required>
        <p id="none3" class="red">※半角英数字で8～12文字で入力してください</p>
        <p>Password(確認用)</p>
        <input type="password" size="12" pattern="^[0-9A-Za-z]+$" minlength="8" maxlength="12" class="in" id="pass2" required>
        <p id="none4" class="red">※確認用パスワードが一致しません。同じパスワードを入力してください。</p>
        <input type="button" value="確認" class="btn" id="open">
      </div>
      <div class="popup">
        <p>上記の内容で編集してよろしいですか？</p>
        <input type="hidden" name="id" value="<?php echo $userID;?>">
        <div class="inlineB"><input type="submit" value="編集する" class="btn"></div>
        <div class="inlineB"><input type="button" value="戻る" class="btn inblk" id="close"></div>
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
        var pass_val = $('#pass').val();
        var pass2_val = $('#pass2').val();

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
        if( pass_val === "" || ( pass_val.match(/^[a-zA-Z0-9]+$/) != pass_val )){
          $('#none3').css('display','block');
          $(".popup").css('opacity','0');
          $(".formwrapper").css('pointer-events','auto');
          return false;
        } else {
            $('#none3').css('display','none');
          }
        if(pass_val != pass2_val){
          $('#none4').css('display','block');
          $(".popup").css('opacity','0');
          $(".formwrapper").css('pointer-events','auto');
          return false;
        } else {
          $('#none4').css('display','none');
        }
    });
    $("#open").on("click", function() {
      $(".popup").css('opacity','1').fadeIn();
      $(".formwrapper").css('pointer-events','none');
    });

    $("#close").on("click", function() {
      $(".popup").css('opacity','0');
      $(".formwrapper").css('pointer-events','auto');
    });

  });

</script>
</body>
</html>
