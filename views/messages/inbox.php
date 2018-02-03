<?php
$title = "Inbox";
$blockId = 'b-' . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
        <!-- content -->

        <div class="row header">
            <div class="col-xs-4 col-md-4">
                <b>Inbox</b>
            </div>
            <div class="col-xs-4 col-md-4">
                <a href="<?= url("/messages/outbox"); ?>">Outbox</a>
            </div>
            <div class="col-xs-4 col-md-4">
                <a href="<?= url("/messages/compose"); ?>">Compose</a>
            </div>
        </div>
        <br /><br />

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">
                        <input type="checkbox" onclick="toggleChecked(this.checked);this.form.remove.disabled=true;" />
                    </th>
                    <th scope="col">Sender:</th>
                    <th scope="col">Subject:</th>
                    <th scope="col">Date:</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($this->msgs) > 0): ?>
                    <?php foreach (isset($this->msgs) ? $this->msgs : $this->msgs as $msg): ?>
                        <tr>
                            <th scope="row">
                                <input type="checkbox" name="msgs[<?= $msg->id; ?>]"  onclick="this.form.remove.disabled=true;" />
                            </th>
                            <td>
                                <a href="<?= url("/user/id/") . $msg->sender; ?>"> username </a>
                            </td>
                            <td>
                                <?php if ($msg->readed == 0): ?>
                                    <b> <?= $msg->subject ?> </b>
                                <?php else: ?>
                                    <?= $msg->subject; ?>
                                <?php endif; ?>
                             </td>
                            <td><?= date("d-m-Y", strtotime($msg->created_at)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <th scope="row"> </th>
                        <td colspan="3"><b>No message at moment</b></td>
                        <td> </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if (count($this->msgs) > 0): ?>
            <div class="col-sm-12 col-md-5">
                <button type="submit" class="btn btn-danger" onclick="this.form.remove.disabled=!this.form.remove.disabled;">Delete Selected</button>
                <button type="submit" class="btn btn-primary" onclick="this.form.mark.disabled=!this.form.mark.disabled;">Mark as read</button>
            </div>
        <?php endif; ?>

        <!-- end content -->
    </div>
</div>
<br />
