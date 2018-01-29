<?php
use App\Libs\Session;
$title = "Invites";
$blockId = 'b-' . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

    <?php \App\Models\User::invite(Session::get('userid')); ?>

    <!-- end content -->
    </div>
</div>
<br />
