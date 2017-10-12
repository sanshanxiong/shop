
<div class="row">
    <div class="col-xs-6">
        <form class="form-signin" role="form" method="post" >
            <h2 class="form-signin-heading">New Book</h2>
            <input  type="hidden" name="id" value="<?=$book['id']?>"/>
            <input type="TEXT" name="name" class="form-control" value="<?=$book['name']?>" required autofocus>
            <select name="category_id" class="form-control">
                <?php foreach ($categories as $value) :?>
                    <?php if($book["category_id"]==$value["id"]) :?>
                         <option value="<?=$value["id"]?>" selected><?=$value["category_name"]?> </option>
                    <?php else :?>
                        <option value="<?=$value["id"]?>"><?=$value["category_name"]?></option>
                    <?php endif ?>
                <?php endforeach ?>
            </select>
            <input type="TEXT" name="price" class="form-control" value="<?=$book['price']?>" required>
            <input type="TEXT" name="count" class="form-control" value="<?=$book['count']?>" required>
            <!-- 加载编辑器的容器 -->
            <script id="container" name="content" type="text/plain">
            <?=$book["content"]?>
            </script>
            <button class="btn  btn-primary  " type="submit">Save</button>
            <input type="hidden" name="returnUrl" value="<?=$returnUrl?>" />
            <a href="<?=isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:ROOT_URL.CUR_PLATFORM.DS.CUR_CONTROLLER.DS."index";?>" class="btn btn-success">Return</a>
        </form>
        <a  href="javascript:;" onclick="history.back(-1)"  >返回上一页</a>
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

        //获取html内容，返回: <p>hello</p>
        var html = ue.getContent();
        //获取纯文本内容，返回: hello
        var txt = ue.getContentTxt();
    });
</script>


