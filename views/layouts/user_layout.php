<?php
use App\Libs\Session;
$title = Session::get('username');
$blockId = 'b-' . sha1($title);

$avatar = "https://placehold.it/192x300";
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <img src="<?php echo $avatar; ?>" alt="Avatar" class="thumbnail center-block" />
        <ul class="list-group">
            <li class="list-group-item"> Downloaded : <span class="label label-danger pull-right"> 10 BG </span></li>
            <li class="list-group-item"> Uploaded : <span class="label label-success pull-right"> 10 BG </span></li>
            <li class="list-group-item"> Class : <span class="label label-danger pull-right"> Member </span></li>
            <li class="list-group-item"> Privacy : <span class="label label-danger pull-right"> Normal </span></li>
            <li class="list-group-item"> Ratio : <span class="label label-danger pull-right"> 0.00 </span></li>
        </ul>
        <br />
        <div class="text-center">
            <a href="account.php" class="btn btn-primary"> Account </a>
            <a href="<?= url('/admin'); ?>" class="btn btn-warning"> Admin Panel </a>
        </div>
        <br />

    <!-- end content -->
    </div>
</div>
<br />
