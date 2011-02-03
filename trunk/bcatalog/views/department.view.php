<?php
/*
 * все переменные — одноименные свойства объекта Department
 */
?>

<tr dept_type="<?php echo $type; ?>">
    <td class="title-col">
        <div class="name"><?php echo $Name; ?></div>
        <div class="work-time">
            <?php echo processWorkHoursToHRD($Work_hour, $Type, $Wprk_day); ?>
        </div>
    </td>
    <td class="addr-col">
        <?php echo $Adress; ?><br/>
        <div class="note">
            <?php echo $Comment; ?>
        </div>
    </td>
    <td class="map-col">
        <img src="<?php echo BASE_URL; ?>img/layout/map-icon<?php echo empty($map_link) ? "-passive" : ""; ?>.png" alt="место на карте" />
    </td>
    <td class="phone-col">
        <?php echo $Phone; ?>
    </td>
</tr>