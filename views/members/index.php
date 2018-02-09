<?php
$title = "Members";
$blockId = "b-" . sha1($title);
use App\Models\User;
//TODO
//fix layout search button and put in the middle
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <form method="post" action="<?= url("/members/search"); ?>" autocomplete="off">
            <input type="hidden" name="token" value="<?php echo isset($this->token) ? $this->token : $this->token; ?>" />
            <div class="row">
                <div class="form-group col-sm-3">
                    <label for="user">Username</label>
                    <input id="user" type="text" class="form-control" name="user" minlength="3" maxlength="25" placeholder="Search.." autofocus />
                </div>
                <div class="form-group col-sm-3">
                    <label for="class"> Class </label>
                    <select id="class" class="form-control" name="class">
                        <option selected disabled> Any Class </option>
                        <option value="member"> Member </option>
                        <option value="memberplus"> Member Plus </option>
                        <option value="vip"> VIP </option>
                        <option value="uploader"> Uploader </option>
                        <option value="moderator"> Moderator </option>
                        <option value="moderatorplus"> Moderator Plus </option>
                        <option value="admin"> Admin </option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"> Search </button>
        </form>

        <p align="center">
            <a href="<?= url("/members"); ?>"> <b> ALL </b> </a> -
            <?php foreach (range("a", "z") as $l): ?>
                <?php $L = strtoupper($l); ?>
                <?php if ($l == ""): ?>
                    <b><?= $L; ?></b>
                <?php  else: ?>
                    <a href="<?= url("/members/letter/") . $l; ?>"> <b> <?= $L; ?> </b> </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </p>
        <br />

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"> Username: </th>
                    <th scope="col"> Member since: </th>
                    <th scope="col"> Class: </th>
                    <th scope="col"> Estate: </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (isset($this->members) ? $this->members : $this->members as $member): ?>
                    <tr>
                        <th> <a href="<?= url("/user/id/") . $member->id; ?>"> <?= $member->username; ?> </a> </th>
                        <td> <?= date("d-m-Y", strtotime($member->created_at)); ?> </td>
                        <td> <?= User::classes($member->class); ?> </td>
                        <td> <img src="<?= URL; ?>/imgs/estates/<?= $member->estate_id; ?>.png" class="estates" alt="Estate" /> </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <!-- end content -->
    </div>
</div>
<br />
