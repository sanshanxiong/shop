

    <h3><?=$title?></h3>
    <table class="table ">
        <thead>
        <td>序号</td><td>编号</td><td>书名</td>
        </thead>
       <tbody>
       <?php $i=1; ?>
       <?php foreach($categories as $category) :?>
           <tr>
               <td><span class="badge"> <?=$i++?> </span></td>
               <td><?=$category["id"]?> </td>
               <td> <?=$category["category_name"]?></td>


               <td><a class="btn btn-danger" href="<?=LinkHelper::createLinkURL('delete').DS.$category['id']?>" onclick="return confirm('Are you sure?') " >delete</a>
                <a class="btn btn-primary" href="<?=LinkHelper::createLinkURL('update').DS.$category['id']?>" >update</a> </td>
           </tr>
       <?php endforeach  ?>
       </tbody>

    </table>
   <a href="<?=LinkHelper::createLinkURL('add')?>"class="btn btn-success">Add a New Category</a>


