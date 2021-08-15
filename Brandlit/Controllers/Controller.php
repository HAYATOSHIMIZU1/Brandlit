<?php
require_once(ROOT_PATH .'/Models/User.php');
require_once(ROOT_PATH .'/Models/Article.php');

class Controller {
  private $request;
  private $session;
  private $User;
  private $Article;

  public function __construct() {
    //リクエストパラメータ取得
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;
    $this->request['session'] = $_SESSION;

    //モデルオブジェクトの生成
    $this->User = new UserLogic();

    //別モデルと連携
    $dbh = $this->User->get_db_handler();
    $this->Article = new ArticleLogic($dbh);
  }

  public function newRecord(){
    if(empty($this->request['post'])){
      $result = false;
      return $result;
    }
    $result = $this->Article->upArticle($this->request['post']);
    return $result;
  }

  public function mainArticle(){
    $all = $this->Article->findALL();
    return $all;
  }

  public function delArticle($delID){
    $this->Article->adminDel($delID);
  }

  public function Article($categoryID){
    if( $categoryID == 11 ){
      $categoryArticle = $this->Article->findALL();
    } else {
      $categoryArticle = $this->Article->category($categoryID);
    }
    return $categoryArticle;
  }

  public function myKeep($userID) {
    $keep = $this->Article->keepfind($userID);
    return $keep;
  }

  public function good($good) {
    $result = false;

    $arr = [];
    $arr[] = $good['userID'];
    $arr[] = $good['articleID'];

    $check = $this->Article->goodCheck($arr);
    $evaluation = $this->Article->evalutationCheck($good);
    if($check === false){
      return $result;
    }
    if($check > 0){
      $this->Article->goodDel($good);
      $this->Article->evaluationDel($good);
      //return $evaluation;
    } else {
      $this->Article->goodInsert($good);
      $this->Article->evaluationInsert($good);
      //return $evaluation;
    }
  }

  public function keep($keep) {
    $result = false;

    $arr = [];
    $arr[] = $keep['userID'];
    $arr[] = $keep['articleID'];

    $keepcheck = $this->Article->keepCheck($arr);
    if($keepcheck === false){
      return $result;
    }
    if($keepcheck > 0){
      $this->Article->keepDel($keep);
    } else {
      $this->Article->keepInsert($keep);
    }
  }


 public function selectArticle($user){
   $result = $this->Article->allselect($user);
   return $result;
 }

 public function UserArticle($user){
   $arr = [];
   $arr[] = $user[0];
   $arr[] = $user[1];
   $arr[] = $user[2];

   $result = $this->Article->UserSelectArticle($arr);
   return $result;
 }

  public function DateArticle($user){
    $arr = [];
    $arr[] = $user[0];
    $arr[] = $user[1];

    $result = $this->Article->DateSelectArticle($arr);
    return $result;
  }

}

 ?>
