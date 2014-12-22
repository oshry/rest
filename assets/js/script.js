$(document).ready(function() {
          function ajax(data,type, datatype){
              $.ajax({
                    url: "sort.php",
                    data: data,
                    type: type,
                    dataType: datatype,
                    success: function(res) {
                        var tmpl = $("#matches_tmpl").html();
                        var html = Mustache.to_html(tmpl, res);
                        $("#data").html(html);
                    }
              });
          }  
          var data = {matchType: 0};
          ajax(data, "post", "json");
          $("input[type=radio]").change(function(){
                  var matchType = $("input[type=radio]:checked").attr("value");
                  var data = {matchType: matchType};
                  ajax(data, "post", "json");  
          });
        $("#car_form").submit(function(event){
            event.preventDefault();
            
        });
 });