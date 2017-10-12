<div class="row">
    <div class="col-xs-6">
        <form class="form-signin" role="form" method="post"  enctype="multipart/form-data">
            <h2 class="form-signin-heading">Manage My Deposit </h2>
            <p><?=$_SESSION["curUser"]['name']."的账户:".$money?>
            <p></p>
            <input type="TEXT" name="num" class="form-control"  placeholder="请输入充值的钱数" autofocus  required>

            <input type="hidden" name="returnUrl" value="<?=$returnUrl?>" />
            <p><?=$msg?></p>
            <button class="btn   btn-primary  " type="submit">Deposite</button>
            <a href="<?=isset($returnUrl)?$returnUrl:LinkHelper::createLinkURL('userinfo','user');?>" class="btn btn-success">Return</a>
        </form>

    </div>
</div>