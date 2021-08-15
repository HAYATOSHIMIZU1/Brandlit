<?php
require_once(ROOT_PATH .'/Models/Db.php');

class ArticleLogic extends Db {

  public function findALL(){
    $sql = "SELECT A.title, A.evaluation, A.created_at, U.name as 'username', C.name as 'categoryname', C.id as 'categoryid', A.id as 'articleid', A.url, A.comment FROM article as A
            LEFT JOIN users as U ON A.user_id = U.id
            LEFT JOIN category as C ON A.category_id = C.id
            ORDER BY A.created_at desc
            ";
    $sth = $this->dbh->prepare($sql);
    // $sth->execute();
    $params = $sth->fetchALL(PDO::FETCH_ASSOC);
    return $params;
  }

  public function category($categoryID) {

    $sql = "SELECT A.title, A.evaluation, A.created_at, U.name as 'username', C.name as 'categoryname', C.id as 'categoryid',A.id as 'articleid' FROM article as A
            LEFT JOIN users as U ON A.user_id = U.id
            LEFT JOIN category as C ON A.category_id = C.id
            WHERE C.id = ?";

    //articleIDを配列に入れる
    $arr = [];
    $arr[] = $categoryID;

    try{
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);
      //SQLの結果を返す
      $params = $sth->fetchAll(PDO::FETCH_ASSOC);

      $this->dbh->commit();

      return $params;
    } catch( \Exception $e ) {
      $this->dbh->rollback();
      throw $e;

    }

  }

  public function keepfind($userID) {

    $sql = "SELECT U.name, A.created_at, A.title, A.evaluation, A.id FROM article as A
            LEFT JOIN users as U ON U.id = A.user_id
            LEFT JOIN keep as K ON K.article_id = A.id
            WHERE K.user_id = ?
            ORDER BY K.id ASC
            ";

    //articleIDを配列に入れる
    $arr = [];
    $arr[] = $userID;

    try{
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);
      //SQLの結果を返す
      $params = $sth->fetchAll(PDO::FETCH_ASSOC);

      $this->dbh->commit();

      return $params;
    } catch( \Exception $e ) {
      $this->dbh->rollback();
      throw $e;
    }

  }

  public function goodCheck($checkID) {
    $result = false;
    $sql = "SELECT * FROM good
            WHERE user_id = ? AND article_id = ?";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $checkID[0];
    $arr[] = $checkID[1];
    try {
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);
      $result = $sth->rowCount();

      $this->dbh->commit();
      return $result;
    } catch( \Exception $e) {
      $this->dbh->rollback();
      throw $e;
    }

  }

  public function keepCheck($checkID) {
    $result = false;
    $sql = "SELECT * FROM keep
            WHERE user_id = ? AND article_id = ?";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $checkID[0];
    $arr[] = $checkID[1];
    try {
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);
      $result = $sth->rowCount();

      $this->dbh->commit();
      return $result;
    } catch( \Exception $e) {
      $this->dbh->rollback();
      throw $e;
    }

  }

  public function evalutationCheck($good) {
    $result = false;
    $sql = "SELECT evaluation FROM article WHERE id = ?";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $good['articleID'];

    try {
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $result = $sth->execute($arr);

      $this->dbh->commit();
      return $result;
    } catch(\Exception $e) {
      $this->dbh->rollback();
      throw $e;
    }
  }

  public function goodDel($good) {
    $result = false;
    $sql = "DELETE FROM good
            WHERE user_id = ? AND article_id = ?
            ";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $good['userID'];
    $arr[] = $good['articleID'];
    try {
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);

      $this->dbh->commit();
    } catch( \Exception $e) {
      $this->dbh->rollback();
      throw $e;
    }
  }

  public function adminDel($delID) {
    $result = false;
    $sql = "DELETE FROM article
            WHERE id = ?
            ";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $delID;
    try {
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);

      $this->dbh->commit();
    } catch( \Exception $e) {
      $this->dbh->rollback();
      throw $e;
    }
  }

  public function keepDel($keep) {
    $result = false;
    $sql = "DELETE FROM keep
            WHERE user_id = ? AND article_id = ?
            ";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $keep['userID'];
    $arr[] = $keep['articleID'];
    try {
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);

      $this->dbh->commit();
    } catch( \Exception $e) {
      $this->dbh->rollback();
      throw $e;
    }
  }

  public function evaluationDel($good) {
    $result = false;
    $sql = "UPDATE article SET evaluation = (evaluation - 1)
            WHERE id = ?
            ";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $good['articleID'];
    try {
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);

      $this->dbh->commit();
    } catch( \Exception $e) {
      $this->dbh->rollback();
      throw $e;
    }
  }

  public function goodInsert($good) {
    $result = false;
    $sql = "INSERT INTO good(user_id, article_id)
            VALUES (?, ?)
            ";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $good['userID'];
    $arr[] = $good['articleID'];
    try {
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);

      $this->dbh->commit();
    } catch( \Exception $e) {
      $this->dbh->rollback();
      throw $e;
    }
  }

  public function keepInsert($keep) {
    $result = false;
    $sql = "INSERT INTO keep(user_id, article_id)
            VALUES (?, ?)
            ";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $keep['userID'];
    $arr[] = $keep['articleID'];
    try {
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);

      $this->dbh->commit();
    } catch( \Exception $e) {
      $this->dbh->rollback();
      throw $e;
    }
  }

  public function evaluationInsert($good) {
    $result = false;

    $sql = "UPDATE article SET evaluation = (evaluation + 1)
            WHERE id = ?
            ";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $good['articleID'];
    try {
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);

      $this->dbh->commit();
    } catch( \Exception $e) {
      $this->dbh->rollback();
      throw $e;
    }
  }

  public function upArticle($post){
    $result = false;
    $sql = "INSERT INTO article(user_id, category_id, title, comment, url)
            VALUES (?, ?, ?, ?, ?)";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $post['id'];
    $arr[] = $post['category'];
    $arr[] = $post['title'];
    $arr[] = $post['comment'];
    if(isset($post['siteURL'])){
      $arr[] = $post['siteURL'];
    } else {
      $arr[] = null;
    }

    try{
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);

      $this->dbh->commit();
      $result = true;
      return $result;
    } catch( \Exception $e ) {
      $this->dbh->rollback();
      throw $e;
    }
  }

  public function userArticle($userID){
    $result = false;
    $sql = "SELECT U.name, A.created_at, A.title, A.evaluation, A.id
            FROM (SELECT * FROM article WHERE article.user_id = :id) as A
            LEFT JOIN users as U ON U.id = :id
            ORDER BY created_at DESC";

    try{
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      //パラメータを割り当て
      $sth->bindParam(':id', $userID, PDO::PARAM_INT);
      $sth->execute();
      $toukou = $sth->fetchAll(PDO::FETCH_ASSOC);

      $this->dbh->commit();
      return $toukou;
    } catch( \Exception $e ) {
      $this->dbh->rollback();
      throw $e;
    }

  }

  public function selectArticle($articleID){
    $result = false;
    $sql = "SELECT C.name as 'categoryname', A.title, A.comment, A.url, A.evaluation, U.name as 'username'
            FROM article as A
            LEFT JOIN category as C ON A.category_id = C.id
            LEFT JOIN users as U ON U.id = A.user_id
            WHERE A.id = ? ";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $articleID;

    try{
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);
      $article = $sth->fetch(PDO::FETCH_ASSOC);

      $this->dbh->commit();
      return $article;
    } catch( \Exception $e ) {
      $this->dbh->rollback();
      throw $e;
    }

  }



  public function allselect($user){
    $result = false;
    $sql = "SELECT A.created_at, A.title, A.comment, A.url, U.name as 'username', A.id as 'articleid' FROM article as A
            LEFT JOIN users as U ON U.id = A.user_id
            WHERE U.name = ? ";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $user;

    try{
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);
      $article = $sth->fetchAll(PDO::FETCH_ASSOC);

      $this->dbh->commit();
      return $article;
    } catch( \Exception $e ) {
      $this->dbh->rollback();
      throw $e;
    }
  }


  //ここから続き
  public function UserSelectArticle($user){
    $result = false;
    $sql = "SELECT A.created_at, A.title, A.comment, A.url, U.name as 'username', A.id as 'articleid' FROM article as A
            LEFT JOIN users as U ON U.id = A.user_id
            WHERE U.name = ? AND created_at BETWEEN ? AND ?
            ORDER BY created_at DESC ";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $user[0];
    $arr[] = $user[1];
    $arr[] = $user[2];

    try{
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);
      $article = $sth->fetchAll(PDO::FETCH_ASSOC);

      $this->dbh->commit();
      return $article;
    } catch( \Exception $e ) {
      $this->dbh->rollback();
      throw $e;
    }
  }

  public function DateSelectArticle($user){
    $result = false;
    $sql = "SELECT A.created_at, A.title, A.comment, A.url, U.name as 'username', A.id as 'articleid' FROM article as A
            LEFT JOIN users as U ON U.id = A.user_id
            WHERE created_at BETWEEN ? AND ?
            ORDER BY created_at DESC ";

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $user[0];
    $arr[] = $user[1];

    try{
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);
      $article = $sth->fetchAll(PDO::FETCH_ASSOC);

      $this->dbh->commit();
      return $article;
    } catch( \Exception $e ) {
      $this->dbh->rollback();
      throw $e;
    }
  }


  }
