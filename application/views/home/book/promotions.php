<!--promotions-->
<div class="title">
    <span class="title_icon">
        <img src="<?=ROOT_URL.'public/images/front/bullet4.gif'?>" alt="" title="" />
    </span>Promotions
</div>
    <?php foreach($books as $book) :?>
    <div class="new_prod_box">
        <a href="<?=LinkHelper::createLinkURL('detail','book').'/'.$book['id']?>"><?=$book['name']?></a>
        <div class="new_prod_bg">
            <span class="new_icon"><img src="<?=ROOT_URL.'public/images/front/promo_icon.gif'?>" alt="" title="" /></span>
            <a href="<?=LinkHelper::createLinkURL('detail','book').'/'.$book['id']?>"><img src="<?=ROOT_URL.'public/images/front/thumb1.gif'?>" alt="" title="" class="thumb" border="0" /></a>
        </div>
    </div>
    <?php endforeach ?>