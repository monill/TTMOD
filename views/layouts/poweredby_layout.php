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

    <img class="embed-responsive" src="<?= URL; ?>/imgs/dev_page_badges.png" alt="Powered By">

    <!-- end content -->
    </div>
</div>
<br />
