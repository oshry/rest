<?php
require 'vendor/autoload.php';
require_once './sort1.php';
$sort = new proccess();
$language = new language();
$data = $sort->processRequest(0);
$lang_form = $language->form();
//echo "<pre>",print_r($data),"</pre>";die();
$table = '<table>
          <tr>
            <th>#Pos</th>
            <th>Model</th>
            <th>Price</th>
            <th>Image</th>
          </tr>
          {{#matches}}
              <tr>
          <td>{{pos}}</td>
          <td title="{{continent}}">{{model}}</td>
          <td>{{price}}</td>
          <td>{{image}}</td>
          </tr>
          {{/matches}}
          <tr id="last">
          <td></td>
          <td></td>
          <td>{{#sum}}{{sum}}{{/sum}}</td>
                  <td></td>
          </tr>
     </table>
      {{^matches}}
            No matches found
      {{/matches}}';
$form = '<form id="car_form" action="/sort.php" method="post" accept-charset="utf-8">
        <fieldset>
            <div class="line" >
                <label for="model">{{model}}</label>
                <input type="text" name="model">
            </div>
            <div class="line" >
                <label for="price">{{price}}</label>
                <input type="text" name="price">
            </div>
            <div class="line" >
                <label for="image">{{image}}</label>
                <input type="text" name="image">
            </div>
            <div class="line" >
                <label for="continent">{{continent}}</label>
                <input type="text" name="continent">
            </div>
            <input type="submit" value="{{submit}}">
        </fieldset>
    </form>';

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Test</title>
  <link rel="stylesheet" href="assets/css/layout.css?v=1.0">
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="assets/js/script.js"></script>
  <!--<script src="//cdnjs.cloudflare.com/ajax/libs/mustache.js/0.7.0/mustache.min.js"></script>-->
</head>
<body>
    <?php
        $m = new Mustache_Engine;
        echo $m->render($table, $data);

        $show_form = new Mustache_Engine;
        echo $show_form->render($form, $lang_form);
        //die('let\'s rest');
    ?>
    <div id="data"></div>

</body>
</html>


