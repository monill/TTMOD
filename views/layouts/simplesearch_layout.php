<?php
$title = "Quick Search";
$blockId = "b-" . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <form method="post" action="<?= url("/torrents/search"); ?>" class="form-inline">
            <div class="input-group">
                <input type="text" name="search" class="form-control" />
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary"> Search </button>
                </span>
            </div>
        </form>

    <!-- end content -->
    </div>
</div>
<br />
