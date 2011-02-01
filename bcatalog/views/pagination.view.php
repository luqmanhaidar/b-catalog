<?php
    $stack_length = 8;
    $start_page = $stack_length * floor($page_num / $stack_length);
    $end_page = ($start_page + $stack_length) < $page_qnt ? $start_page + $stack_length : $page_qnt;

    $distance = $page_qnt - $page_num;

?>
<div class="page-nav">
    <ul>
        <li <? echo ($start_page==0) ? "class='passive'" : ""; ?> >&larr;</li>
        <?php
            $q = ($start_page + 1);
            do{
                echo (($q == $page_num) ? "<li class='current' >" : "<li>").$q."</li>";
                $q++;
            }while($q < $end_page);
        ?>
        
        <?php if($end_page-1 < $page_qnt && $start_page+1!=$end_page): ?>
        <li class="passive">...</li>
        <li><?php echo $page_qnt; ?></li>
        <?php endif; ?>
        <li <?php echo (($start_page+1)==$end_page) ? "class='passive'" : ""; ?> >&rarr;</li>
    </ul>
</div>