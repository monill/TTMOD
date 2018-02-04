<?php
use App\Libs\RSS;

$title = "RSS";
$blockId = "b-" . sha1($title);
$feedUrl = "";
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <?php if (!$feedUrl): ?>
            <p class="text-center">This would need editing with an rss feed of your choice.</p>
        <?php else: ?>
            <?php $xml = new RSS($feedUrl); ?>
        <?php endif; ?>

    <!-- end content -->
    </div>
</div>
<br />
