<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
    <title>Book Store</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT_URL.'public/css/front/style.css'?>"  />
    <script type="text/javascript" src="<?=ROOT_URL.'public/js/jquery.min.js' ?>" ></script>
    <script src="<?=ROOT_URL.'public/js/front/lightbox.js' ?>"  type="text/javascript"></script>
    <script src="<?=ROOT_URL.'public/js/front/scriptaculous.js?load=effects' ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?=ROOT_URL.'public/js/front/java.js' ?>" ></script>

</head>
<body>
<div id="wrap">

    <div class="header">
        <div class="logo"><a href="index.html"><img src="<?=ROOT_URL.'public/images/front/logo.gif'?>" alt="" title="" border="0" /></a></div>
        <div id="menu">
            <ul>
                <li class="selected"><a href="<?=LinkHelper::createLinkURL('index','book')?>">home</a></li>
                <li><a href="about.html">about us</a></li>
                <li><a href="<?=LinkHelper::createLinkURL('all','book')?>">books</a></li>
                <li><a href="specials.html">specials books</a></li>
                <li><a href="<?=LinkHelper::createLinkURL('account','user','home')?>">my accout</a></li>
                <li><a href="<?=LinkHelper::createLinkURL('register','user','home')?>">register</a></li>
                <li><a href="details.html">prices</a></li>

                <?php if(isset($_SESSION['curUser'])) :?>
                <li><a href="<?=LinkHelper::createLinkURL('logout','user','home')?>">logout</a></li>
                    <li><a href="<?=LinkHelper::createLinkURL('info','user','home')?>"><?=$_SESSION['curUser']['name']?></a></li>
                <?php endif ?>

            </ul>
        </div>


    </div>


    <div class="center_content">
        <div class="left_content">