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


  // fetch all data
  public function selectAll($query)
  {
    $allRows = $this->link->query($query);
    $allRows->execute();
    $allRows->fetchAll(PDO::FETCH_OBJ);

    if ($allRows) {
      return $allRows;
    } else {
      return false;
    }
  }

  // fetch single data
  public function selectSingle($query)
  {
    $singleRow = $this->link->query($query);
    $singleRow->execute();
    $singleRow->fetch(PDO::FETCH_OBJ);

    if ($singleRow) {
      return $singleRow;
    } else {
      return false;
    }
  }
}

$app = new App();
