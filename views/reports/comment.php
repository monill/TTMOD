<?php
$title = "Report";
$blockId = "b-" . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <b>Are you sure you would like to report Comment:</b>
        <br /><br />
        <b> " <?= $this->com->comment; ?> " </b>?
        <br /><br />

        <p>Please note, this is <b>not</b> to be used to report leechers, we have scripts in place to deal with them</p>

        <b>Reason</b> (required):
        <form method="post" action="<?= url("/report/addcreport"); ?>" autocomplete="off">
            <input type="hidden" name="cid" value="<?= $this->com->id; ?>" />
            <input type="text" size="100" name="reason" />
            <input type="submit"  value="Confirm" />
        </form>

    <!-- end content -->
    </div>
</div>
<br />
