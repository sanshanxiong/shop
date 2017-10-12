
    <!--Featured Books-->
    <div class="title">
        <span class="title_icon">
            <img src="<?=ROOT_URL.'public/images/front/bullet1.gif'?>" alt="" title="" />
        </span>
        Featured books
    </div>
    <?php foreach($books as $book) :?>
    <div class="feat_prod_box">

        <div class="prod_img"><a href="<?=LinkHelper::createLinkURL('detail')?>"><img src="<?=ROOT_URL.'public/images/front/prod1.gif'?>" alt="" title="" border="0" /></a></div>

        <div class="prod_det_box">
            <div class="box_top"></div>
            <div class="box_center">
                <div class="prod_title"><?=$book['name']?></div>
                <p class="details">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                <a href="<?=LinkHelper::createLinkURL('detail').'/'.$book['id']?>" class="more">- more details -</a>
                <div class="clear"></div>
            </div>

            <div class="box_bottom"></div>
        </div>
        <div class="clear"></div>
    </div>
    <?php endforeach ?>

    <!--New Books-->
    <div class="title">
        <span class="title_icon">
            <img src="<?=ROOT_URL.'public/images/front/bullet2.gif'?>" alt="" title="" />
        </span>New books
    </div>
    <div class="new_products">
        <?php foreach($newBooks as $book):?>
        <div class="new_prod_box">
            <a href="<?=LinkHelper::createLinkURL('detail').'/'.$book['id']?>"><?= $book['name']?></a>
            <div class="new_prod_bg">
                <span class="new_icon"><img src="<?=ROOT_URL.'public/images/front/new_icon.gif'?>" alt="" title="" /></span>
                <a href="<?=LinkHelper::createLinkURL('detail').'/'.$book['id']?>"><img src="<?=ROOT_URL.'public/images/front/thumb1.gif'?>" alt="" title="" class="thumb" border="0" /></a>
            </div>
        </div>
        <?php endforeach ?>
    </div>

    <div class="clear"></div>



