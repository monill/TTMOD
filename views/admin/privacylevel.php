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

        <center>
            This page displays all users which are enabled, confirmed grouped by their privacy level.
        </center>

        <br />

        <form action="<?= url("/admin/privacylevel") ?>" method="post" onchange="this.form.submit()">
            <b>Privacy Level:</b>
            <select name="type">
                <option value="all">Any</option>
                <option value="public">Public</option>
                <option value="friends">Friends</option>
                <option value="private">Private</option>
            </select>
            <input type="submit" value="Submit">
        </form>

        <br />
        <br />

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col"> Username: </th>
                <th scope="col"> Class: </th>
                <th scope="col"> E-mail: </th>
                <th scope="col"> IP: </th>
                <th scope="col"> Added: </th>
                <th scope="col"> Last Visited: </th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($this->users as $users): ?>
                    <tr>
                        <th> <a href="<?= url("/user/id/") . $users->id; ?>"> <?= $users->username; ?> </a> </th>
                        <td> <?= $users->class; ?> </td>
                        <td> <?= $users->email; ?> </td>
                        <td> <?= $users->ip; ?> </td>
                        <td> <?= date("d-m-Y", strtotime($users->created_at)); ?> </td>
                        <td> <?= date("d-m-Y", strtotime($users->lastlogin)); ?> </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- end content -->
    </div>
</div>
<br />
