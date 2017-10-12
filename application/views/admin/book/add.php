

<div class="row">
      <div class="col-xs-6">
        <form class="form-signin" role="form" method="post"  enctype="multipart/form-data">
            <h2 class="form-signin-heading">New Book</h2>
            <input type="TEXT" name="name" class="form-control" placeholder="Book name" required autofocus>
            <input type="file" name="file" id="file" class="form-control" required />
            <select name="category_id" class="form-control">
                <?php foreach ($categories as $value) :?>
                <option value="<?=$value["id"]?>"><?=$value["category_name"]?></option>
                <?php endforeach ?>
            </select>
            <input name="publishDate" id="publishDate" class=" Wdate" type="text" onfocus="WdatePicker({readOnly:true,isShowClear:false})" />
            <input type="TEXT" name="price" class="form-control" placeholder="Price" required>
            <input type="TEXT" name="count" class="form-control" placeholder="Count" required>
            <!-- 加载编辑器的容器 -->
            <script id="container" name="content" type="text/plain">
            图书内容
            </script>

            <input type="hidden" name="returnUrl" value="<?=$returnUrl?>" />
            <button class="btn   btn-primary  " type="submit">Save</button>
            <a href="<?=isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:ROOT_URL.CUR_PLATFORM.DS.CUR_CONTROLLER.DS."index";?>" class="btn btn-success">Return</a>
        </form>

    </div>
</div>
<!-- 配置文件 -->
<script type="text/javascript" src="<?=ROOT_URL.'/public/controls/ueditor143/ueditor.config.js'?>"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="<?=ROOT_URL.'/public/controls/ueditor143/ueditor.all.js'?>"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container', {
        /*toolbars: [
            ['fullscreen', 'source', 'undo', 'redo'],
            ['bold', 'italic', 'underline', 'fontborder',
                'strikethrough', 'superscript', 'subscript',
                'removeformat', 'formatmatch', 'autotypeset',
                'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor',
                'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc']
        ],*/initialFrameHeight:250
    });

    //对编辑器的操作最好在编辑器ready之后再做
    ue.ready(function() {
        //设置编辑器的内容
        ue.setContent('hello');
        //获取html内容，返回: <p>hello</p>
        var html = ue.getContent();
        //获取纯文本内容，返回: hello
        var txt = ue.getContentTxt();
    });
</script>


