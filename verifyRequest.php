<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 6/2/2018
 * Time: 3:10 PM
 */


require_once "function.php";
require_once "model/request.php";
require_once "model/listrequest.php";
require_once getLang();


if (isLogin() && $_SESSION['type'] == 1)
{
    $allReq = request::getAllRequests();

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
    <script src="node_modules/jquery/dist/jquery.min.js"></script>

    <div class="card m-3">
        <form action="mcard.php" method="post">
            <table class="table table-striped" <?php echo " ".$direction?> >
                <thead>
                <tr class="bg-warning">
                    <th scope="col"><?php echo $number?></th>
                    <th scope="col"><?php echo $req_code?></th>
                    <th scope="col"><?php echo $date?></th>
                    <th scope="col"><?php echo $cost?></th>
                    <th scope="col"><?php echo $status?></th>
                    <th scope="col"><?php echo $verify?></th>
                </tr>
                </thead>
                <tbody id="prequest">
                <?php
                foreach ($allReq as $key => $value)
                {?>
                    <tr>
                        <th scope="row"><?php echo $key+1?></th>
                        <td><?php echo $value['request_id']?></td>
                        <td><?php echo $value['request_date']?></td>
                        <td><?php
                            $l = listrequest::getProductsOfRequest($value['request_id']);
                            $sum =0;
                            //print_r($l);
                            foreach ($l as $p)
                            {
                                $sum = $sum + ((int)$p['product_cost']*$p['listrequest_num']);
                            }
                            echo $sum;
                        ?></td>
                        <td><?php
                            if ($value['request_type'] == 1)
                                echo $inpay;
                            else if ($value['request_type'] == 2)
                                    echo $insubmit;
                            else if ($value['request_type'] == 3)
                                echo $submit;
                            ?></td>
                        <td ><button class="btn btn-warning verify" id="<?php  echo $value['request_id']?>" type="button" name="button">
                                <?php if ($value['request_type'] == 3)
                                {
                                    echo $submit;
                                    ?>
                                    <script>
                                        $("#<?php  echo $value['request_id']?>").prop('disabled', true);
                                    </script>
                                <?php
                                }
                                else{
                                    echo $send;
                                }

                                ?></button></td>

                    </tr>
                <?php
                }
                    ?>
                </tbody>
            </table>

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
<script>



    $(document).ready(function () {
        $(document).on('click','.verify', function(){
            obj = $(this);
            id =$(this).attr('id');
            $.ajax({
                url:"ajax-request.php",
                data:{type:'verify',id:id},
                type:"GET",
                datatype:"json"
            }).done(function (json) {
                    obj.text("<?php echo $submit?>");
                    obj.prop('disabled', true);
            }).fail(function (xhr, status, errorThrown) {
                alert( "Sorry, there was a problem!" );
            })
        });
    });
</script>
