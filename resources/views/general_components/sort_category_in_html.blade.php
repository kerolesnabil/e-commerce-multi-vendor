<?php if(count($categories)): ?>
    <?php foreach($categories as $item): ?>
        <option value="{{$item->id}}" {{(($item->id==$id) ? 'selected':'')}}>
            {{$item->name .(($child==true)?'-'.$parent:'')}}
        </option>

        <?php
            echo SortCategoryInSelect($item->children,false,true,$item->name);
        ?>

    <?php endforeach; ?>
<?php endif; ?>
