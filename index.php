<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://use.fontawesome.com/53f39c7df3.js"></script>
    <title>HoneyHuntersTestApp</title>
    <!--  -->
    <style>

    </style>
</head>

<body>
    <header>
        <div class="container">
            <div class="row space40">
                <div class="col-md-4"><img class="img-responsive" src="/img/logo.png" alt=""></div>
            </div>
            <div class="row">
                <div class="pic text-center"><img src="/img/contact.png" alt=""></div>
                <form action="" method="POST" role="form">
                    <div class="form-group col-md-5">
                        <div class="form-group">
                            <label for="">Имя <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name_txt"> </div>
                        <div class="form-group">
                            <label for="">E-mail <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email_txt"> </div>
                    </div>
                    <div class="form-group col-md-6 col-md-offset-1">
                        <label for="">Комментарий <span class="text-danger">*</span></label>
                        <textarea rows="4" type="text" class="form-control" name="message_txt"></textarea>
                    </div>
                    <div class="form-group col-xs-12">
                        <button id="post" type="submit" class="btn btn-danger btn-lg pull-right"><big>Записать</big></button>
                    </div>
                </form>
            </div>
        </div>
    </header>
    <main>
        <section class="form">
            <div class="container"> </div>
        </section>
        <section class="comments">
            <div class="container">
                <div class="items row">
                    <?php
                    include_once("config.php");

                    $Result = mysql_query("SELECT id,name,email,message FROM comments");

                    while($row = mysql_fetch_array($Result))
                    {
                    echo '<div class="item col-xs-12 col-sm-6 col-md-4 col-lg-3 text-center"><div class="panel panel-custom" id="item_'.$row["id"].'">';
                    echo '<div class="panel-heading"><h3 class="panel-title">'.$row["name"].'</h3></div>';
                    echo '<div class="panel-body">';
                    echo '<a href="mailto:'.$row["email"].'">'.$row["email"].'</a>';
                    echo '<br><p>'.$row["message"].'</p>';
                    echo '</div></div></div>';
                    }

                    mysql_close($useDB);
                    ?> </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </main>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3"><img class="img-responsive" src="/img/logo.png" alt=""></div>
                <div class="social col-md-2 col-md-offset-7">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <a href="https://vk.com">
                                <span class="fa-stack fa-2x">
                                    <i class="fa fa-circle-thin fa-stack-2x" aria-hidden="true"></i>
                                    <i class="fa fa-vk fa-stack-1x" aria-hidden="true"></i>
                                </span>
                            </a>
                        </div>
                        <div class="col-md-6 text-center">
                            <a href="https://facebook.com">
                                <span class="fa-stack fa-2x">
                                    <i class="fa fa-circle-thin fa-stack-2x" aria-hidden="true"></i>
                                    <i class="fa fa-facebook fa-stack-1x" aria-hidden="true"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#post").click(function (e) {
                e.preventDefault();
                if (($('[name="name_txt"]').val() === '') 
                    && ($('[name="email_txt"]').val() === '') 
                    && ($('[name="message_txt"]').val() === '')) 
                {
                    alert('Введите текст!');
                    return false;
                }
                var myData = 'name_txt=' + $('[name="name_txt"]').val() + '&email_txt=' + $('[name="email_txt"]').val() + '&message_txt=' + $('[name="message_txt"]').val(); //post variables
                
                jQuery.ajax({
                    type: "POST",
                    url: "action.php",
                    dataType: "text",
                    data: myData,
                    success: function (response) {
                        $(".comments .items").append(response);
                        $('[name*=""').val('');
                        $('html, body').animate({ scrollTop: $('.comments .item:last').offset().top }, 500);
                    }
                    , error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            });
        });
    </script>
</body>

</html>