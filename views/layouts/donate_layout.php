<?php
$title = "Donation Methods";
$blockId = "b-" . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

    <p class="text-center">This would need to contain your donation code, or something. maybe even a paypal link</p>

    <!-- end content -->
    </div>
</div>
<br />
