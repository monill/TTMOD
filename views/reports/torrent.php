<?php
$title = "Report Torrent";
$blockId = "b-" . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

    <b>Are you sure you would like to report torrent:</b>
    <br />
    <a href="<?= url("/torrent/view/") . $this->tname->id; ?>"> <b> <?= $this->tname->name; ?> </b> </a>?
    <br /><br />

    <b> Reason </b> (required):

    <form method="post" action="<?= url("/report/addtreport"); ?>" autocomplete="off">
        <input type="hidden" name="tid" value="<?= $this->tname->id; ?>" />
        <input type="text" size="100" name="reason" />
        <input type="submit" value="Confirm" />
    </form>

    <!-- end content -->
    </div>
</div>
<br />
