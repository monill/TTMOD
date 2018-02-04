<?php
$title = "Staff";
$blockId = 'b-' . sha1($title);
use App\Models\User;
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
        <!-- content -->

        <?php foreach ($this->staffs as $value): ?>

            <?=
                ($value->class = $value->class) ? $value->class : $value->class
             ?>



        <?php endforeach; ?>

        <!-- end content -->
    </div>
</div>
<br />

<!-- <b> <?= User::classes($value->class); ?> </b> <br />
<?= $value->username; ?>
<hr /> -->
