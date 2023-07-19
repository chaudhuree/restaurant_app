<?php require_once("../config/config.php"); ?>

<?php

class App
{
  public $host = HOST;
  public $dbname = DBNAME;
  public $user = USER;
  public $password = PASSWORD;

  public $link;

  public function __construct()
  {
    $this->connect();
  }

  public function connect()
  {
    $this->link = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->password);
    if ($this->link) {
      echo "Connection successful";
    }
  }
}

$app = new App();
