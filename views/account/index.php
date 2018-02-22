<?php

$title = $this->user->username;
$blockId = "f-" . sha1($title);

?>

<div class="card">
    <div class="card-header">
        User: <?php echo $title ?> - (Account Profile)
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

    <?php include_once 'body.php'; ?>

    <table class="f-border comment" cellpadding="10" border="0" width="100%">
        <tr>
            <td width="50%" valign="top">

                <b> Username: </b> <?= $this->user->username; ?> <br /> <br />
                <b> Class: </b> <?= ucfirst($this->user->class); ?> <br /> <br />
                <b> Email: </b> <?= $this->user->email; ?> <br /> <br />
                <b> Joined: </b> <?= date("d-m-Y", strtotime($this->user->actived_at)); ?> <br /><br />
                <b> Age: </b> <?= $this->user->dob; ?> <br /><br />
                <b> Gender: </b> <?= ucfirst($this->user->sex); ?> <br /><br />

                <b> Donated: </b> $ <?= number_format($this->user->donated, 2); ?>  <br /><br />
                <b> Custom Title: </b> <?= $this->user->title; ?> <br /><br />
                <b> Privacy Level: </b> <?= ucfirst($this->user->privacy); ?> <br /><br />
                <b> Signature: </b> <?= $this->user->signature; ?> <br /><br />
                <b> Passkey: </b> <?= $this->user->passkey; ?> <br /><br />

                <b> Points: </b> <?= $this->user->points; ?> <br /><br />
                <b> Signature: </b> <?= $this->user->signature; ?> <br /><br />

                <b> Info: </b> <?= $this->user->info; ?> <br /><br />

                <?php
                //TODO
                //i dont if going finish this

                // if ($CURUSER["invited_by"]) {
                //     $res = SQL_Query_exec("SELECT username FROM users WHERE id=$CURUSER[invited_by]");
                //     $row = mysqli_fetch_assoc($res);
                //     echo "<b>" . T_("INVITED_BY") . ":</b> <a href=\"account-details.php?id=$CURUSER[invited_by]\">$row[username]</a> <br />";
                // }
                // echo "<b>" . T_("INVITES") . ":</b> " . number_format($CURUSER["invites"]) . " <br />";
                // $invitees = array_reverse(explode(" ", $CURUSER["invitees"]));
                // $rows = array();
                // foreach ($invitees as $invitee) {
                //     $res = SQL_Query_exec("SELECT id, username FROM users WHERE id="$invitee" and status="confirmed"");
                //     if ($row = mysqli_fetch_assoc($res)) {
                //         $rows[] = "<a href=\"account-details.php?id=$row[id]\">$row[username]</a>";
                //     }
                // }
                // if ($rows) {
                //     echo "<b>" . T_("INVITED") . ":</b> " . implode(", ", $rows) . " <br />";
                // }
                ?>

            </td>
        </tr>
    </table>
    <br /> <br />

    <!-- end content -->
    </div>
</div>
<br />
