<?php
require_once 'db.php';
$db = new MyDb("search", "root", "root", "test2");
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];
$paths = explode("/", $path);
if(!$paths[0])
    array_shift($paths);

if($paths[0]=='cars') {
    array_shift($paths);
    switch ($method) {
        case 'PUT':
            $id = array_shift($paths);
            parse_str(file_get_contents("php://input"),$post_vars);
            $model = $post_vars['model'];
            $price = $post_vars['price'];
            $image = $post_vars['image'];
            $continent = $post_vars['continent'];
            $price = str_replace(',', '', $price);
            $db->update("UPDATE `test2`.`cars` SET `model` = '$model', `price` = '$price', `image` = '$image', `continent` = '$continent'  WHERE `cars`.`pos` =$id LIMIT 1");
            return true;
            break;
        case 'POST':
            $model = $_POST['model'];
            $price = $_POST['price'];
            $image = $_POST['image'];
            $continent = $_POST['continent'];
            $price = str_replace(',', '', $price);
            $db->insert("INSERT INTO `test2`.`cars` (`pos`, `model`, `price`, `image`, `continent`) VALUES (NULL, '$model', '$price', '$image', '$continent')");
            return true;
            break;
        case 'GET':
            $name = array_shift($paths);
            if (empty($name)) {
                $matches = $db->select("SELECT * FROM `cars`");
            }else{
                switch ($name) {
                    case "Asia":
                        $where = "WHERE continent = 'Asia'";
                        break;
                    case "American":
                        $where = "WHERE continent = 'American'";
                        break;
                    case "Japan":
                        $where = "WHERE continent = 'Japan'";
                        break;
                    default:
                        $where = "";
                }
                $matches = $db->select("SELECT * FROM cars ".$where);
            }

            foreach ($matches as $k => $value) {
                $matches[$k]['price'] = number_format($value['price']);
            }
            $sum = $db->select("SELECT SUM(price) sum FROM `cars`".$where);
            print_r(json_encode(array("matches" => $matches, "sum"=>  number_format($sum[0]['sum']))));
            break;
        case 'DELETE':
            $name = array_shift($paths);
            if (empty($name)) {
                die('Here');
            } else {
                $db->delete("DELETE FROM `test2`.`cars` WHERE `cars`.`pos` = $name LIMIT 1");
            }
            return true;
            break;
    }
}else{
    // We only handle resources under 'cars'
    header('HTTP/1.1 404 Not Found');
    die('not car');
}

?>