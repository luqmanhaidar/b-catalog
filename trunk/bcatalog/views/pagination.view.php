<?php
    $stack_length = 8;
    $k = ($page_num / $stack_length);
    $k = $k == 1 ? 0 : $k;
    $start_page = $stack_length * floor($k);
    $end_page = ($start_page + $stack_length) < $page_qnt ? $start_page + $stack_length : $page_qnt;

    $distance = $page_qnt - $page_num;

?>
<div class="page-nav" page_length="<?php echo $page_length; ?>">
    <ul>
        <li class="prev<? echo (($start_page+1)==$page_num) ? " passive" : ""; ?>" >&larr;</li>
        <?php
            $q = ($start_page + 1);
            do{
                echo "<li class='".(($q == $start_page +1) ? (($q == $page_num) ? "first current" : "first") : (($q == $page_num) ? "current" : ""))."'>".$q."</li>";
                $q++;
            }while($q <= $end_page);
        ?>
        
        <?php if($end_page < $page_qnt && $start_page+1!=$end_page): ?>
        <li class="next-range">...</li>
        <li class="last"><?php echo $page_qnt; ?></li>
        <?php endif; ?>
        <li class="next<?php echo (($start_page+1)==$end_page || $end_page >= $page_qnt) ? " passive" : ""; ?>" >&rarr;</li>
    </ul>
</div>