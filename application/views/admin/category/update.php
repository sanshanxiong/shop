
<div class="row">


    <div class="col-xs-6">
        <form class="form-signin" role="form" method="post" >
            <h2 class="form-signin-heading">New Book</h2>
            <input  type="hidden" name="id" value="<?=$category['id']?>"/>
            <input type="TEXT" name="name" class="form-control" value="<?=$category['category_name']?>" required autofocus>

            <button class="btn  btn-primary  " type="submit">Save</button>
            <a href="<?=isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:LinkHelper::createLinkURL("index");?>" class="btn btn-success">Return</a>
        </form>
        <a  href="javascript:;" onclick="history.back(-1)"  >返回上一页</a>
    </div>
</div>