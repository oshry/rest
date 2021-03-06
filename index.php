<?php
//die(getenv(DOMAIN_NAME));
require 'vendor/autoload.php';
require_once './language.php';
$path = $_SERVER['REQUEST_URI'];
$paths = explode("/", $path);
//Get Continent From Url
$filter_key = $paths[1];
//Load Url With The Right Data
$cars_list = json_decode(file_get_contents('http://rest/cars/'.$filter_key.'?dataType=json'), true);
//Filter List
$filter_options = array('All', 'Asia', 'American', 'Japan');
//Filter List To View
if(isset($filter_key) AND $filter_key!=''){
    //Filter Exist
    foreach($filter_options as $filter){
        if($filter == $filter_key){
            $filters[] = array('name'=>$filter, 'checked'=>'checked');
        }else{
            $filters[] = array('name'=>$filter, 'checked'=>'');
        }
    }
}else{
    $first=1;
    foreach($filter_options as $filter){
            if($first){
                $filters[] = array('name'=>$filter, 'checked'=>'checked');
                $first = false;
                continue;
            }
            $filters[] = array('name'=>$filter, 'checked'=>'');
    }
}
$cars_filter = array("filter"=>$filters);
//Load Language
$language = new language();
$lang_form = $language->form();
$m = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/views'),
));
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>REST</title>
  <link rel="stylesheet" href="assets/css/layout.css?v=1.0">
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="assets/js/script.js"></script>
</head>
<body>
    <?php
        echo $m->render('cars_filter', $cars_filter);
        echo $m->render('cars_list', $cars_list);
        echo $m->render('form', $lang_form);
    ?>
</body>
</html>


