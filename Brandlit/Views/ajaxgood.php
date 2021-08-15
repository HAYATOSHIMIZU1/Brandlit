<?php
require_once(ROOT_PATH .'/Controllers/Controller.php');

// postがある場合
if(isset($_POST)){

    $good = new Controller();
    $article = $good->good($_POST);

}
