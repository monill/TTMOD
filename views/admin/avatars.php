<?php
include "menus.php";
?>
<?php
$title = $this->title;
$blockId = "f-" . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <table class="table table-hover">
            <thead>
                <tr>
                    <th> Username: </th>
                    <th> Avatar: </th>
                    <th> Class: </th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($this->users as $user): ?>
                <tr>
                    <th> <a href="<?= url("/user/id/") . $user->id; ?>"> <?= $user->username; ?> </a> </th>
                    <td> <img src="<?= htmlspecialchars($user->avatar); ?>" width="10%" alt="Avatar" /> </td>
                    <td> <?= $user->class; ?> </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    <!-- end content -->
    </div>
</div>
<br />
