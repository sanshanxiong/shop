<h3><?=$title?></h3>
<div class="row">
<table class="table ">
    <thead>
    <td>序号</td><td>编号</td><td>类别名</td>
    </thead>
    <tbody>
    <?php $i= ($pagerData['pageIndex']-1)*$pagerData['pageSize']+1;; ?>
    <?php foreach($categories as $category) :?>
        <tr>
            <td><span class="badge"> <?=$i++?> </span></td>
            <td><?=$category["id"]?> </td>
            <td> <?=$category["category_name"]?></td>

            <td><a class="btn btn-danger" href="<?=LinkHelper::createLinkURL('delete').DS.$category['id']?>" onclick="return confirm('Are you sure?') " >delete</a>
                <a class="btn btn-primary" href="<?=LinkHelper::createLinkURL("update").DS.$category['id']?>" >update</a> </td>
        </tr>
    <?php endforeach  ?>
    </tbody>

</table>
    </div>
<div class="row">
    <div class="col-sm-pull-6"></div>
    <div class="col-sm-4">
        <?php echo LinkHelper::createPagerArea($pagerData); ?>

    </div>

</div>
<div class="row">
    <div></div>
    <a href="<?=LinkHelper::createLinkURL('add')?>"class="btn btn-success">Add a New Book</a>
</div>




