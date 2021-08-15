<?php
require_once(ROOT_PATH .'/Controllers/Controller.php');

// postがある場合
if(isset($_POST)){

    $keep = new Controller();
    $article = $keep->keep($_POST);

}
