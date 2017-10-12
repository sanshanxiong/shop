<div class="row">


      <div class="col-xs-6">
        <form class="form-signin" role="form" method="post" >
            <h2 class="form-signin-heading">New Category</h2>
            <input type="TEXT" name="category_name" class="form-control" placeholder="Category name" required autofocus>

            <button class="btn   btn-primary  " type="submit">Save</button>

            <a href="<?=isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:LinkHelper::createLinkURL("index");?>" class="btn btn-success">Return</a>
        </form>
    </div>
</div>



