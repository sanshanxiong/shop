<div class="crumb_nav">
    <a href="index.html">home</a> &gt;&gt; ALL
</div>
<div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>所有图书</div>

<div class="new_products">
    <?php foreach($books as $book ) :?>
        <div class="new_prod_box">
            <a href="<?=LinkHelper::createLinkURL('detail').'/'.$book['id']?>"><?=$book['name']?></a>
            <div class="new_prod_bg">
                <a href="<?=LinkHelper::createLinkURL('detail').'/'.$book['id']?>"><img src="images/thumb1.gif" alt="" title="" class="thumb" border="0" /></a>
            </div>
        </div>
    <?php endforeach ?>


    <div class="pagination">

        <?php echo LinkHelper::PagerAreafront($pagerData); ?>
    </div>

</div>


<div class="clear"></div>