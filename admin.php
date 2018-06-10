<?php


require_once "function.php";
require_once getLang();

if (isLogin() && $_SESSION['type'] == 1)
{
    ?>

    <!doctype html>
    <html lang=fa>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
        <?php echo $link?>
    </head>
    <body>

    <?php require_once "nav.php" ?>

    <div class="card-columns m-3 "  id="products">

    </div>
    <div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
            </ul>
        </nav>
    </div>

    </body>
    </html>
    <?php
}
else {

    redirect("index.php");
}
?>
<script src="node_modules/jquery/dist/jquery.min.js"></script>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script>

   
   
    function getProduct(p,c) {
        $.ajax(
            {
                url: "ajax-product.php",
                data: {page:p,count:c},
                type: "GET",
                dataType: "json",
            })
            .done(function (json) {
                count = parseInt(json['allCount']);
                page = parseInt(count / 6);
                if ((count % 6) != 0)
                    page = page +1;
                $(".pagination").empty();
                for (i=1;i<= page;i++)
                {
                    $(".pagination").append("<li class=\"page-item\"><button class=\"page-link\">"+i+"</button></li>\n");
                }
                $(".page-link").click(function () {
                    text= $(this).text();
                    page = parseInt(text);
                    getProduct(page,6);
                })
                $("#products").empty()
                $.each(json['product'],function (key,value) {
                    $("#products").append("<div class=\"card \" style=\"width: 25rem;\">\n" +
                        "            <img class=\"card-img-top\" src=\""+value['product_picture']+"\" alt=\"Card image cap\">\n" +
                        "            <div class=\"card-body\">\n" +
                        "                <h5 class=\"card-title\">"+value['product_name']+"</h5>\n" +
                        "                <p class=\"card-text\">"+value['product_cost']+"</p>\n" +
                        "                <button class=\"btn btn-primary edit  \" data-toggle='modal' data-target='#modalform' ><?php echo $editfood ?></button>\n" +
                        "                <label  hidden for=''>"+value['product_id']+"</label>\n" +
                        "				  <button class=\"btn btn-primary delete  \" ><?php echo $deletefood ?></button>\n"+
                        "                <label   hidden for=''>"+value['product_id']+"</label>\n" +
                        "            </div>\n" +
                        "        </div>")
                });
                $("#products").append("<div class=\"modal fade\" id=\"modalform\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalCenterTitle\" aria-hidden=\"true\">\n" +
                    "                   <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">" +
                    "                       <div class=\"modal-content\">" +
                    "                           <div class=\"modal-header\">" +
                    "                               <h5 class=\"modal-title\" id=\"exampleModalLongTitle\">Modal title</h5>\n" +
                    "                               <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n" +
                    "                                       <span aria-hidden=\"true\">&times;</span>\n" +
                    "                               </button>\n" +
                    "                           </div>\n" +
                    "                           <div class=\"modal-body\" id='modal-body'>\n" +
                    "                                ...\n" +
                    "                           </div>" +
                    "                       </div>\n" +
                    "                   </div>\n" +
                    "               </div>")
			})

            .fail(function (xhr, status, errorThrown) {
                alert( "Sorry, there was a problem!" );
            })
            .always(function () {
                // alert('done');
            })

    }
	
	function deleteproduct(id){
		$.ajax({
			
			url: "ajax-deleteproduct.php",
            data: {productid:id},
            type: "GET"
			
		})
		
		.done(function(){

		})
		
		.fail(function (xhr, status, errorThrown) {
                alert( "Sorry, there was a problem!" );
            })
		
        .always(function () {
                // alert('done');
            })
			
		
	}//end delete food function
	
    $(document).ready(function () {
        $(document).on('click','.delete', function(){
            id = $(this).next().text();
			deleteproduct(id);
            card = $(this).parent().parent();
            card.remove();
        });
        $(document).on('click','.edit', function(){
            name = $(this).prev().prev().text();
            cost = $(this).prev().text();
            $("#exampleModalLongTitle").text("<?php echo $editfood?>");
            $("#modal-body").empty();
            $("#modal-body").append(
                "        <form action='' id='editform' method=\"post\" enctype=\"multipart/form-data\">\n" +
                "                    <div class=\"form-row\">\n" +
                "                        <div class=\"form-group col-md-6\">\n" +
                "                            <label for=\"foodname\"><?php echo $foodname?></label>\n" +
                "                            <input name=\"foodname\" type=\"text\" value='"+name+"' class=\"form-control\" id=\"foodname\" aria-describedby=\"emailHelp\" placeholder=\"<?php echo $foodname?>\">\n" +
                "                        </div>\n" +
                "                        <div class=\"form-group col-md-6\">\n" +
                "                            <label for=\"foodcost\"><?php echo $foodcost?></label>\n" +
                "                            <input name=\"foodcost\" type=\"text\" value='"+cost+"' class=\"form-control\" id=\"foodcost\" aria-describedby=\"emailHelp\" placeholder=\"<?php echo $foodcost?>\">\n" +
                "                        </div>\n" +
                "                        <div class=\"form-group col-md-6\">\n" +
                "                            <label for=\"picture\"><?php echo $picture?></label>\n" +
                "                            <input type=\"file\" name=\"picture\" id=\"picture\">\n" +
                "                        </div>\n" +
                "                    </div>\n" +
                "\n" +
                "\n" +
                "                <div class=\"form-group\">\n" +
                "                    <button type=\"submit\" class=\"btn btn-primary\"><?php echo $editfood?></button>\n" +
                "                </div>\n" +
                "\n" +
                "        </form>\n" +
                "\n"
                )
        });
        $(document).on('submit','editform',function (e) {
            e.preventDefault();
            $.ajax({
                url: "ajax-editproduct.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {

                }
            });
        });
        getProduct(1,6);
    });
</script>


