<div class="title">
    <span class="title_icon">
        <img src="<?=ROOT_URL.'public/images/front/bullet4.gif'?>" alt="" title="" />
    </span>Partners
</div>

<ul class="list">
    <?php foreach($partners as $partner) :?>
    <li><a href="#"><?=$partner['name']?></a></li>
    <?php endforeach ?>
</ul>

