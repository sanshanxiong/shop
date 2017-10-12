

    <p class="more_details">
    <div id="myupdateDiv">
        <?php foreach($model['msgs'] as $msg) :?>
            <p style="text-indent: 2em; padding-left: 20px; padding-right: 20px; font-size: 12px;">
                <?=$msg['msg']?> </p>
            <p style="padding-left: 290px; color: #808080">
                <?=$msg['msgtime']." by ".$msg['username']?>
            </p>

        <?php endforeach ?>
    </div>
    <form id="commentform" method="post">
        <div style="padding:5px;text-align:center">
            <br />
            <textarea rows="6" cols="40" id="comment" name="comment"></textarea>
            <input type="hidden" name="bookid" id="bookid" value="<?=$bookid?>"/>
            <br />
            <button type="button" id="submit">提交</button>

        </div>
    </form>
    <div id="errmsg"></div>
    <div> <?php echo LinkHelper::PagerAreafront($model['pagerData']); ?></div>
<script language="JavaScript">
    $(document).ready(function(){
        $('#submit').click(function(){

           var comment = $('#comment').val();

            if (comment == '' ) {
                $('#errmsg').html('<font color="red">留言内容为空</font>');
                //$('#send_ajax').attr('disabled','');//不好用
                return false;
            }

           params =$('#commentform').serialize();

            $.ajax({
                url:"<?=LinkHelper::createLinkURL('add','comment','home')?>", //后台处理程序
                type:'POST',       //数据传送方式
                dataType:'json',   //接受数据格式
                data:params,       //要传送的数据
                success:update_page,//回传函数(这里是函数名字)
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                    //
                    // alert(textStatus);
                }
            });
        })
    });
    function update_page(data){
        $('#myupdateDiv').html("");
        select = $('#myupdateDiv');
         $.each(data['msgs'],function(i,item){

              node =$('<p style="text-indent: 2em; padding-left: 20px; padding-right: 20px; font-size: 12px;"></p>').appendTo(select);
              node.html(item.msg);
              node2 =$('<p style="padding-left: 290px; color: #808080"></p>').appendTo(select);
              node2.html(item.msgtime +" "+item.username);

        });
    }


</script>

