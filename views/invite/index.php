<?php
$title = "Invite";
$blockId = "f-" . sha1($title);
?>
<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <?php if ($this->invs > 0): ?>

            <form method="post" action="<?= url("/invite/in"); ?>" autocomplete="off">
                <input type="hidden" name="token" value="<?php echo isset($this->token) ? $this->token : $this->token; ?>" />
                
                <div class="form-group">
                    <label for="Email">Email address:</label>
                    <input type="email" class="form-control" name="email" id="vemail" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">
                        Please make sure this is a valid email address, the recipient will receive a confirmation email.
                    </small>
                </div>
                <button type="submit" class="btn btn-primary">Send an invite</button>
            </form>

            <script>
                //function validateForm() {
                //    var email = document.getElementById('#vemail');
                //
                //    console.log(email);
                //
                //    if (email === "") {
                //        return false;
                //    }
                //    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                //    return regex.test(email);
                //}
                //
                //if(validateForm()) {
                //
                //   var email = document.getElementById('#vemail');
                //
                //   $.ajax({
                //        url: "<?//= url("/invite/in"); ?>//",
                //       type: "POST",
                //       data: {
                //            email: email
                //       },
                //       cache: false
                //   });
                //}
            </script>

        <?php else: ?>

            <p> Your invitation limit has been reached, please check back again later... </p>

        <?php endif; ?>

    <!-- end content -->
    </div>
</div>
<br />
