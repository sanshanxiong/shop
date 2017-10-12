
<div class="col-md-12">
    <p>
        <ul class="nav nav-pills" >
        <li role="presentation"><a href="<?= LinkHelper::createLinkURL('all').'/category-ALL'?>"><h4>ALL</h4></a></li>
            <?php foreach($categories as $value) :?>
              <li role="presentation" <?=$value["id"]==$category_id?"class='active'":""?>">
                <a href="<?= LinkHelper::createLinkURL('all').'/category-'.$value["id"]?>">
                  <h4><?=$value["category_name"] ?> </h4>
                </a>
               </li>
            <?php endforeach ?>
        </ul>
    </p>
</div>
<div class="col-md-12">

        <table class="table  ">
            <thead>
            <td>序号</td><td>编号</td><td>书名</td><td>价钱</td><td>数量</td>
            </thead>
            <tbody>
            <?php $i= ($pagerData['pageIndex']-1)*$pagerData['pageSize']+1;; ?>
            <?php foreach($books as $book) :?>
                <tr>
                    <td><span class="badge"> <?=$i++?> </span></td>
                    <td><?=$book["id"]?> </td>
                    <td><a href="<?=LinkHelper::createLinkURL("show").'/'.$book["id"]?>"> <?=$book["name"]?></a></td>
                    <td><?=$book["price"]?> </td>
                    <td><?=$book["count"]?> </td>
                    <td>
                        <a class="btn btn-danger"
                           href="<?=LinkHelper::createLinkURL('delete').DS.$book['id'] ?>"
                           onclick="return confirm('Are you sure?') " >delete</a>
                        <a class="btn btn-info" href="<?=LinkHelper::createLinkURL('update').DS.$book['id']?>" >
                            update</a>
                    </td>
                </tr>
            <?php endforeach  ?>
            </tbody>
        </table>


</div>
<div class="col-md-8 ">


    <?php echo LinkHelper::PagerArea($pagerData,$category_id); ?>



</div>
<div class="col-md-12">

    <a href="<?=LinkHelper::createLinkURL('add')?>"class="btn btn-success">Add a New Book</a>
</div>




