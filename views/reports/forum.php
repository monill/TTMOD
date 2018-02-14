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

        <b>Are you sure you would like to report the following forum post:</b>
        <br />
        <a href=""> <b> subject </b> </a>?
        <br /><br />

        <b> Reason </b> (required):
        <form method="post" action="<?= url("/report/addfreport"); ?>" autocomplete="off">
            <input type="hidden" name="fid" value="forumid" />
            <input type="hidden" name="forumpost" value="forumpost">
            <input type="text" size="100" name="reason" />
            <input type="submit" value="Confirm" />
        </form>

    <!-- end content -->
    </div>
</div>
<br />
