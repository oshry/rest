<?php
require 'vendor/autoload.php';
require_once './language.php';

$data = file_get_contents('http://rest/cars/');
$data = json_decode($data, true);

$language = new language();
$lang_form = $language->form();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Test</title>
  <link rel="stylesheet" href="assets/css/layout.css?v=1.0">
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="assets/js/script.js"></script>
</head>
<body>
    <?php
        $m = new Mustache_Engine(array(
            'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/views'),
        ));
        ?>
    <div id="data"></div>
        <?php
        echo $m->render('table', $data);
        echo $m->render('form', $lang_form);
    ?>
</body>
</html>


