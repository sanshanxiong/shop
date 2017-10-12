<!--categories-->
<div class="title">
    <span class="title_icon">
        <img src="<?=ROOT_URL.'public/images/front/bullet5.gif'?>" alt="" title="" />
    </span>
    Categories
</div>
<ul class="list">
    <?php foreach($categories as $category) :?>
    <li><a href="<?=LinkHelper::createLinkURL('category','book').'/'.$category['id']?>"><?=$category['category_name']?></a></li>
    <?php endforeach ?>
</ul>