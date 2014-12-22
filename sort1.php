<?php

class MatchType {
    const ALL = 0;
    const ASIA = 1;
    const AMERICAN = 2;
}
class MyDb {
private $db;

public function __construct($host, $username, $password, $db) {
  $this->db = mysqli_connect($host, $username, $password, $db);
}

public function __destruct() {
  mysqli_close($this->db);
}

public function select($query) {
  return $this->toArray($this->query($query));
}

public function query($query) {
  return mysqli_query($this->db, $query);
}

private function toArray($results) {
  $arr = array();

  while ($row = mysqli_fetch_array($results)) {
    $temp = array();

    foreach ($row as $key => $val) {
      if (is_string($key))
        $temp[$key] = $val;
    }

    array_push($arr, $temp);
  }

  return $arr;
}
}
class proccess
{
    function processRequest($matchType)
    {
        $db = new MyDb("rest", "root", "root", "test2");
        switch ($matchType) {
            case MatchType::ASIA:
                $where = "WHERE continent = 'Asia'";
                break;
            case MatchType::AMERICAN:
                $where = "WHERE continent = 'American'";
                break;
            default:
                $where = "";
        }
        $matches = $db->select("SELECT * FROM cars " . $where);
        foreach ($matches as $k => $value) {
            $matches[$k]['price'] = number_format($value['price']);

        }
        $sum = $db->select("SELECT SUM(price) sum FROM `cars` " . $where);
        return array("matches" => $matches, "sum" => number_format($sum[0]['sum']));
    }
}
class language{
    public function form(){
        return array(
            'model'=>'Model',
            'price'=>'Price',
            'image'=>'Image',
            'continent'=>'Continent',
            'submit'=>'Submit',
        );
    }

}

?>