

<div class="card">
    <div class="card-header">
            Inbox
            <a data-toggle="collapse" href="#" class="showHide" id="f-44caf74675ceb79ba5cc13bafa102509369c2b53" style="float: right;"></a>
    </div>
    <div class="card-body slidingDivf-44caf74675ceb79ba5cc13bafa102509369c2b53">
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
                                <b><?= $msg->subject; ?></b>
                            <?php else: ?>
                                <?= $msg->subject; ?>
                            <?php endif; ?>
                         </td>
                        <td><?= date("d-m-Y", strtotime($msg->created_at)); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>


        </table>
        <div class="col-sm-12 col-md-5">
            <button type="submit" class="btn btn-danger" onclick="this.form.remove.disabled=!this.form.remove.disabled;">Delete Selected</button>
            <button type="submit" class="btn btn-primary" onclick="this.form.mark.disabled=!this.form.mark.disabled;">Mark as read</button>
        </div>

        <!-- end content -->
    </div>
</div>
<br />
