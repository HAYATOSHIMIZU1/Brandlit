<?php
require_once(ROOT_PATH .'/Models/Db.php');

class UserLogic extends Db {
  private $table = 'users';

  public function __construct($dbh = null) {
    parent::__construct($dbh);
  }
  /*
  *ユーザーを登録する
  *@param array $userData
  *@return bool $result
  */
  public function createUser( $userData ){
    $result = false;

    $sql = 'INSERT INTO users(name,email,password)
            VALUES (?, ?, ?)';

    //ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $userData['name'];
    $arr[] = $userData['email'];
    $arr[] = password_hash($userData['password'],PASSWORD_DEFAULT);

    try{
      $this->dbh->beginTransaction();

      $sth = $this->dbh->prepare($sql);
      $result = $sth->execute($arr);
      $this->dbh->commit();

      return $result;
    } catch( \Exception $e ) {
      $this->dbh->rollback();
      throw $e;
    }
  }

  public function check( $email ) {
    $result = false;
    $sql = 'SELECT COUNT(*) as count FROM `users` WHERE email = ?';

    $arr = [];
    $arr[] = $email;
    try{
        $sth = $this->dbh->prepare($sql);
        $sth->execute($arr);
        //SQLの結果を返す
        $user = $sth->fetch();
        return $user;
    } catch(\Exception $e){
      $this->dbh->rollback();
      throw $e;
    }
  }

  public function login( $email, $password ){
    $result = false;
    //ユーザーをemailから検索して取得
    $user = $this->getUserByEmail( $email );
    if( empty($user) ){
      $result = 0;
      return $result;
    }

    //パスワード照会
    if(password_verify( $password, $user['password']) === true ){
      session_regenerate_id(true);
      $result = true;
      return $result;
    } else {
      $result = 1;
      return $result;
    }
  }

  /**
  * emailからユーザーを取得
  * @param string $email
  * @return array bool $user false
  */
  public function getUserByEmail( $email ) {

    $result = false;

    $sql = 'SELECT * FROM users WHERE email = ? ';

    //emailを配列に入れる
    $arr = [];
    $arr[] = $email;

    try{
      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);

      //SQLの結果を返す
      $user = $sth->fetch();
      return $user;
    } catch(\Exception $e) {
      $this->dbh->rollback();
      throw $e;
    }
  }

  public function password_edit($user){
    $result = false;

    $sql = 'UPDATE users
            SET password = ?
            WHERE email = ? ';

    //emailを配列に入れる
    $arr = [];
    $arr[] = password_hash($user[0],PASSWORD_DEFAULT);
    $arr[] = $user[1];

    try{
      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);

      //SQLの結果を返す
      $result = true;
      return $result;
    } catch(\Exception $e) {
      $this->dbh->rollback();
      throw $e;
    }

  }

  public function deleteUser( $userID ){
    $result = 2;

    $sql = 'DELETE FROM users WHERE users.id = ?';

    $arr = [];
    $arr[] = $userID;

    try {
      $sth = $this->dbh->prepare($sql);
      $sth->execute($arr);
      //SQLの結果を返す
      $user = $sth->fetch();
      $result = 1;
      return $result;
    } catch(\Exception $e) {
      $this->dbh->rollback();
      throw $e;
    }

  }

    /*
    *ユーザーを登録する
    *@param array $userData
    *@return bool $result
    */
    public function updateUser( $userData ){
      $result = 2;

      $sql = "UPDATE users
              SET name = ?, email = ?, password = ?
              WHERE users.id = ?";

      //ユーザーデータを配列に入れる
      $arr = [];
      $arr[] = $userData['name'];
      $arr[] = $userData['email'];
      $arr[] = password_hash($userData['password'],PASSWORD_DEFAULT);
      $arr[] = $userData['id'];

      try{
        $this->dbh->beginTransaction();

        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($arr);
        $this->dbh->commit();

        return $result;
      } catch( \Exception $e ) {
        $this->dbh->rollback();
        throw $e;
      }
    }

    public function usercheck($user){
      $result = false;

      $sql = 'SELECT * FROM users WHERE name = ? AND email = ?';

      //ユーザーデータを配列に入れる
      $arr = [];
      $arr[] = $user[0];
      $arr[] = $user[1];

      try{
        $this->dbh->beginTransaction();

        $sth = $this->dbh->prepare($sql);
        $sth->execute($arr);
        $result = $sth->rowCount();
        $this->dbh->commit();

        return $result;
      } catch( \Exception $e ) {
        $this->dbh->rollback();
        throw $e;
      }

    }

}

 ?>
