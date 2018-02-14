<?php
$title = "Staff's";
$blockId = "b-" . sha1($title);
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
            <h4> <?php echo $value->class; ?> </h4>
            <hr />
            <?php
                echo $value->username;

                ?>

            <br /><br />

        <?php endforeach; ?>

    <!-- end content -->
    </div>
</div>
<br />

<!-- <b> <?= User::classes($value->class); ?> </b> <br />
<?= $value->username; ?>
<hr /> -->
