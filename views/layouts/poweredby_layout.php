<?php
$title = "Powered By";
$blockId = 'b-' . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?= $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?= $blockId; ?>">
    <!-- content -->

    <p class="center-block"><img src="<?= URL; ?>/img/dev_page_badges.png" width="98%"></p>

    <!-- end content -->
    </div>
</div>
<br />
