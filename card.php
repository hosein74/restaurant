<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/31/2018
 * Time: 2:41 AM
 */


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
    <div class="card m-3">
        <form action="mcard.php" method="post">
            <table class="table table-striped" <?php echo " ".$direction?> >
                <thead>
                <tr class="bg-warning">
                    <th scope="col"><?php echo $number?></th>
                    <th scope="col"><?php echo $food?></th>
                    <th scope="col"><?php echo $price?></th>
                    <th scope="col"><?php echo $count?></th>
                    <th scope="col"><?php echo $cost?></th>
                </tr>
                </thead>
                <tbody id="pCard">
                </tbody>
            </table>
            <div class="form-group d-flex justify-content-center ">
                <input class="btn btn-success " type="submit" value="<?php echo $regReq?>">
            </div>
        </form>
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

    $(document).on('change','.count',function () {
        if (parseInt($(this).val()) < 1)
            $(this).val(1);
        td = $(this).parent();
        price = td.prev();
        cost = td.next();
        cost.text((price.text()* parseInt($(this).val())));
        sum = 0;
        $(".cost").each(function () {
            sum = sum + parseInt($(this).text());
        })
        $(".fcost").text(sum);
    })
    function setCard() {
        $.ajax(
            {
                url: "ajax-card.php",
                data: {type:"getCard"},
                type: "GET",
                dataType:"json",
            })
            .done(function (json) {
                //alert(json);
                sum = 0;
                $.each(json,function (key,val) {
                    $('#pCard').append("<tr id='"+val['product_id']+"'>\n" +
                        "            <th scope=\"row\" class=\"number\">"+(key+1)+"</th>\n" +
                        "            <td class=\"food\">"+val['product_name']+"</td>\n" +
                        "            <td class=\"price\">"+val['product_cost']+"</td>\n" +
                        "            <td class=\"+val['product_id']+\"' >\n" +
                        "                <input name='count["+val['product_id']+"]'  class='count' type=\"number\" style=\"width: 100px\" value=\"1\"   class=\"btn btn-warning  \"></input>\n" +
                        "            </td>\n" +
                        "            <td class=\"cost\">"+val['product_cost']+"</td>\n" +
                        "        </tr>")
                    sum = sum + parseInt(val['product_cost']);
                })
                $('#pCard').append("<tr class='table-warning' >\n" +
                    "            <th scope=\"row\" ></th>\n" +
                    "            <td ></td>\n" +
                    "            <td ></td>\n" +
                    "            <td >\n" +
                    "            </td>\n" +
                    "            <td class=\"fcost \">"+sum+"</td>\n" +
                    "        </tr>")

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
                dataType: "json"
            })
            .done(function (json) {
                count = parseInt(json['allCount']);
                page = parseInt(count / 6);
                if ((count % 10) != 0)
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
        setCard();
        //getProduct(1,6);
    });
</script>
