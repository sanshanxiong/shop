<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign in &middot; Twitter Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?=ROOT_URL.'public/css/bootstrap.css'?>"   rel="stylesheet">
    <style type="text/css">
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 300px;
            padding: 19px 29px 29px;
            margin: 0 auto 20px;
            background-color: #fff;
            border: 1px solid #e5e5e5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            box-shadow: 0 1px 2px rgba(0,0,0,.05);
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            font-size: 16px;
            height: auto;
            margin-bottom: 15px;
            padding: 7px 9px;
        }

    </style>




</head>

<body>

<div class="container">

    <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" name="username" value="<?=$username?>" class="input-block-level" placeholder="Email address">
        <input type="password" name="password" value="<?=$password?>" class="input-block-level" placeholder="Password">
        <label class="checkbox">
            <input type="checkbox" name="remember" value="remember" > Remember me
        </label>
        <?=$msg ?>

        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
        <input type="hidden" name="returnUrl" value="<?=$returnUrl?>">
    </form>

</div> <!-- /container -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?=ROOT_URL.'public/js/jquery'?>" ></script>
<script src="<?=ROOT_URL.'public/js/bootstrap.js'?>"></script>


</body>
</html>



</body>

</html>