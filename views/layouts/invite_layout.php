<?php
use App\Libs\Session;
use App\Libs\Database;

$db = Database::getInstance(); //TODO fix this
$user = $db->select1("SELECT invites FROM `users` WHERE `id` = :idd LIMIT 1", ["idd" => 7]); //Session::get('userid')
$invites = $user->invites;
$inv = $invites > 0 ? "s" : "";

$title = "Invites";
$blockId = 'b-' . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

    <?php
        echo '<p class="text-center">' . "Voce tem " . $invites . " convite" . $inv . '</p>';
        if ($invites > 0) {
            echo '<p class="text-center"><a href="'. url('/invite') . '"> Enviar um convite </a></p>';
        }
    ?>

    <!-- end content -->
    </div>
</div>
<br />
