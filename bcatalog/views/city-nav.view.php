<div class="city-nav">
    <span class="curr-city" city_id="<?php echo $city_id; ?>"><?php echo $city_name; ?></span>&nbsp;
    <span class="city-list-trigger">выбрать другой город</span>
</div>
<div class="city-list">
    <div class="head"><img src="<?php echo BASE_URL."img/layout/arr.png"; ?>"/><span class="close">скрыть</span></div>
    <div class="content">
        <table>
            <tr class="city-search">
                <td colspan="3">
                    <input type="text" length="150" value="введите название города">
                    <img src="<?php echo BASE_URL."img/layout/search-icon.png"; ?>" />
                </td>
            </tr>
            <tr class="head">
                <td class="select-base regions">&nbsp;</td>
                <td class="select-base areas"><div class="area-center">Минск</div></td>
                <td class="select-base cities"><span class="show-all">показать все города области</span></td>
            </tr>
            <tr>
                <td class="select-base regions">
                    <ul class="current">
                        <?php foreach($regions as $region): ?>
                        <li region_id="<?php echo $region->region_id; ?>" reg_center="<?php echo $region->center_id; ?>"><?php echo $region->name; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
                <td class="select-base areas">
                    <?php foreach($regions as $region): ?>
                    <ul region_id="<?php echo $region->region_id; ?>">
                        <?php foreach($region->areas as $area): ?>
                        <li area_id="<?php echo $area->area_id; ?>"><?php echo $area->name; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endforeach; ?>
                </td>
                <td class="select-base cities">
                    <?php foreach($regions as $region): ?>
                    <ul region_id="<?php echo $region->region_id; ?>">
                        <?php foreach($region->areas as $area): ?>
                            <?php foreach($area->cities as $city): ?>
                            <li area_id="<?php echo $city->area_id; ?>" city_id="<?php echo $city->city_id; ?>" ><?php echo $city->name; ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php endforeach; ?>
                </td>
            </tr>
        </table>
    </div>
</div>