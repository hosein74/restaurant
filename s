[1mdiff --git a/admin.php b/admin.php[m
[1mindex 77c34f6..884e009 100644[m
[1m--- a/admin.php[m
[1m+++ b/admin.php[m
[36m@@ -74,7 +74,7 @@[m [melse {[m
                 })[m
                 $("#products").empty()[m
                 $.each(json['product'],function (key,value) {[m
[31m-                    $("#products").append("<div class=\"card \" style=\"width: 25rem;\">\n" +[m
[32m+[m[32m                    $("#products").append("<div class=\"card \" id='p"+value['product_id']+"' style=\"width: 25rem;\">\n" +[m
                         "            <img class=\"card-img-top\" src=\""+value['product_picture']+"\" alt=\"Card image cap\">\n" +[m
                         "            <div class=\"card-body\">\n" +[m
                         "                <h5 class=\"card-title\">"+value['product_name']+"</h5>\n" +[m
[36m@@ -118,7 +118,6 @@[m [melse {[m
 			url: "ajax-deleteproduct.php",[m
             data: {productid:id},[m
             type: "GET"[m
[31m-			[m
 		})[m
 		[m
 		.done(function(){[m
[36m@@ -146,10 +145,11 @@[m [melse {[m
         $(document).on('click','.edit', function(){[m
             name = $(this).prev().prev().text();[m
             cost = $(this).prev().text();[m
[32m+[m[32m            id = $(this).next().text();[m
             $("#exampleModalLongTitle").text("<?php echo $editfood?>");[m
             $("#modal-body").empty();[m
             $("#modal-body").append([m
[31m-                "        <form action='' id='editform' method=\"post\" enctype=\"multipart/form-data\">\n" +[m
[32m+[m[32m                "        <form action='' class='editform' id='"+id+"' method=\"post\" enctype=\"multipart/form-data\">\n" +[m
                 "                    <div class=\"form-row\">\n" +[m
                 "                        <div class=\"form-group col-md-6\">\n" +[m
                 "                            <label for=\"foodname\"><?php echo $foodname?></label>\n" +[m
[36m@@ -174,8 +174,10 @@[m [melse {[m
                 "\n"[m
                 )[m
         });[m
[31m-        $(document).on('submit','editform',function (e) {[m
[32m+[m[32m        $(document).on('submit','.editform',function (e) {[m
             e.preventDefault();[m
[32m+[m[32m            id=$(this).prop('id');[m
[32m+[m[32m            $("#p"+id+"> img").attr('src','pics/cake.jpg');[m
             $.ajax({[m
                 url: "ajax-editproduct.php",[m
                 type: "POST",[m
[36m@@ -185,7 +187,9 @@[m [melse {[m
                 processData:false,[m
                 success: function(data)[m
                 {[m
[31m-[m
[32m+[m[32m                    id=$(this).prop('id');[m
[32m+[m[32m                    $("#p"+id+"> img").attr('src','pics/cake.jpg');[m
[32m+[m[32m                    $("#p"+id).firstElementChild().attr('src',data['picture']);[m
                 }[m
             });[m
         });[m
