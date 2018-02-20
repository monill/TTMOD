<?php
$title = "Notice";
$blockId = "b-" . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        Welcome To TTMOD<br /><br />The modd open source torrent tracker view our <a href="<?= url("/forum"); ?>"> Forum </a> for support

    <!-- end content -->
    </div>
</div>
<br />
