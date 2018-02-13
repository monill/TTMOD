<?php
use App\Libs\Session;
?>

<?php if (Session::get("success")): ?>
    <div class="alert alert-success">
        <?php echo Session::flash("success"); ?>
    </div>
<?php endif; ?>

<?php if (Session::get("info")): ?>
    <div class="alert alert-info">
        <?php echo Session::flash("info"); ?>
    </div>
<?php endif; ?>

<?php if (Session::get("warning")): ?>
    <div class="alert alert-warning">
        <?php echo Session::flash("warning"); ?>
    </div>
<?php endif; ?>

<?php if (Session::get("danger")): ?>
    <div class="alert alert-danger">
        <?php echo Session::flash("danger"); ?>
    </div>
<?php endif; ?>
