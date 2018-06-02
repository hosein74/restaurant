<?php


require_once "function.php";
require_once getLang();


if (isLogin() && $_SESSION['type'] == 2)
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
<script>

    function pop(id) {
        $.ajax(
            {
                url: "ajax-card.php",
                data: {type:"pop",id:id},
                type: "GET",
            })
            .done(function () {
                //alert('pop');
            })
            .fail(function (xhr, status, errorThrown) {
                alert( "Sorry, there was a problem!" );
            })
            .always(function () {
                // alert('done');
            })
    }
    function plus(id) {
    $.ajax(
        {
            url: "ajax-card.php",
            data: {type:"plus",id:id},
            type: "GET",
        })
        .done(function () {
            //alert('plus');
        })
        .fail(function (xhr, status, errorThrown) {
            alert( "Sorry, there was a problem!" );
        })
        .always(function () {
            // alert('done');
        })
}
function updateText() {
    $.ajax(
        {
            url: "ajax-card.php",
            data: {type:"update"},
            type: "GET",
            dataType: "json",
        })
        .done(function (json) {
            $('label.id').each(function () {
                text = $(this).text();
                 if ($.inArray(text,json)!== -1)
                {
                    $(this).prev().removeClass('plus').addClass('pop');
                    $(this).prev().text("<?php echo $pop?>");
                }
                else
                 {
                     $(this).prev().removeClass('pop').addClass('plus');
                     $(this).prev().text("<?php echo $plus?>");

                 }
            });


        })
        .fail(function (xhr, status, errorThrown) {
            alert( "Sorry, there was a problem!" );
        })
        .always(function () {
            // alert('done');
        })
}
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
                    "                <button class=\"btn btn-primary  \" ></button>\n" +
                    "                <label class='id' hidden for=''>"+value['product_id']+"</label>\n" +
                    "            </div>\n" +
                    "        </div>")
            })
            updateText();
        })
        .fail(function (xhr, status, errorThrown) {
            alert( "Sorry, there was a problem!" );
        })
        .always(function () {
           // alert('done');
        })

}
   $(document).ready(function () {
       $(document).on('click','.plus', function(){
           id = $(this).next().text();
           plus(id);
           $(this).removeClass('plus').addClass('pop');
           $(this).text("<?php echo $pop?>");
       });
       $(document).on('click','.pop', function(){
           id = $(this).next().text();
           pop(id);
           $(this).removeClass('pop').addClass('plus');
           $(this).text("<?php echo $plus?>");
       });
       getProduct(1,6);
   });
</script>
