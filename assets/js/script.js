$(document).ready(function() {
        //New Car
        $("#car_form").submit(function(event){
            event.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                url: "cars",
                data: data,
                type: "post",
                success: function(res) {
                    location.reload();
                }
            });
        });
        //Edit Car
        $(".car_edit").submit(function(event){
            event.preventDefault();
            id = $(this).attr('id');
            id = id.replace("car_edit", "");
            var data = $(this).serialize();
            $.ajax({
                url: "cars/"+id,
                data: data,
                type: "put",
                success: function(res) {
                    location.reload();
                }
            });
        });
        //Delete Car
        $(".delete").click(function(e){
            var id = $(this).attr('id');
            id = id.replace("delete", "");
            $.ajax({
                url: "cars/"+id,
                type:"delete",
                success: function(res){
                    location.reload();
                }
            });

        });
        //Show Car Edit Form
        $('.edit').click(function(){
            var id = $(this).attr('id');
            id = id.replace("edit", "");
            $("#toggle"+id).toggle( "slow", function() {
                // Animation complete.
             });
        });
        //Change Continent Event
        $('input[name="continent"]:radio' ).change(function(){
            var continent = $(this).val();
            window.location.href = "http://rest/"+continent;
        });
 });