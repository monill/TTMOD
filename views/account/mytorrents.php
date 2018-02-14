<?php

$title = "this->user->username";
$blockId = "f-" . sha1($title);

?>

<div class="card">
    <div class="card-header">
        User: <?php echo $title ?> - (Account Profile)
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

    <?php include 'body.php'; ?>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col"> Type </th>
                <th scope="col"> Name </th>
                <th scope="col"> Comments </th>
                <th scope="col"> Downs </th>
                <th scope="col"> Seeds </th>
                <th scope="col"> Leechers </th>
                <th scope="col"> Completed </th>
                <th scope="col"> Added </th>
                <th scope="col"> Edit </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (isset($this->mytors) ? $this->mytors : $this->mytors as $mytor): ?>
                <tr>
                    <th> <?= $mytor->catname; ?> </th>
                    <td> <?= htmlspecialchars(substr($mytor->name, 0, 30)) . "..."; ?> </td>
                    <td> <?= $mytor->comments; ?> </td>
                    <td> <?= $mytor->downs; ?> </td>
                    <td> <?= $mytor->seeders; ?> </td>
                    <td> <?= $mytor->leechers; ?> </td>
                    <td> <?= $mytor->times_completed; ?> </td>
                    <td> <?= date("d-m-Y", strtotime($mytor->created_at)); ?> </td>
                    <td> <a href="<?= url("/torrent/edit/") . $mytor->id; ?>"> Edit </a> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <!-- end content -->
    </div>
</div>
<br />
