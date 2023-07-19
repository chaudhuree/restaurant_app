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

  // validate input is empty or not
  public function validate($arr)
  {
    if (in_array("", $arr)) {
      echo "Please fill all the fields";
    }
  }

  // insert data

  public function insert($query, $arr, $path)
  {
    if ($this->validate($arr) == "empty") {
      echo "<script>alert('one or more fields are empty')</script>";
    } else {
      $insert_one = $this->link->prepare($query);
      $insert_one->execute($arr);
      // after inserting back to this given path
      header("location:" . $path);
    }
  }
  // update data

  public function update($query, $arr, $path)
  {
    if ($this->validate($arr) == "empty") {
      echo "<script>alert('one or more fields are empty')</script>";
    } else {
      $update_one = $this->link->prepare($query);
      $update_one->execute($arr);

      header("location:" . $path);
    }
  }
  // delete data

  public function delete($query, $path)
  {

    $update_one = $this->link->query($query);
    $update_one->execute();

    header("location:" . $path);
  }
}

$app = new App();
