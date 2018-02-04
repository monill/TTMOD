<?php
use App\Libs\Helper;
use App\Libs\Database;

$db = Database::getInstance();

$title = "Advanced Statistics";
$blockId = "b-" . sha1($title);

$dateTime = Helper::dateTime(Helper::gmtime() - (3600 * 24));

$datet = Helper::dateTime();


$users = Helper::rowCount("users");
$registered =  number_format($users[13]);
$comments = Helper::rowCount("comments");
$ncomments = number_format($comments[13]);
$messages = Helper::rowCount("messages");
$nmessages = number_format($messages[13]);
$tor = Helper::rowCount("torrents");
$ntor = number_format($tor[13]);

$totaltoda = Helper::rowCount("users", "WHERE users.lastlogin >= '$dateTime'");
$totaltoday = number_format($totaltoda[13]);

$regtoda = Helper::rowCount("users", "WHERE users.created_at >= '$dateTime'");
$regtoday = number_format($regtoda[13]);

$todayto = Helper::rowCount("torrents", "WHERE torrents.created_at >= '$dateTime'");
$todaytor = number_format($todayto[13]);

$guest = Helper::getGuests();
$guests = number_format($guest[13]);

$seeder = Helper::rowCount("peers", "WHERE seeder = 'yes'");
$seeders = $seeder[13];

$leecher = Helper::rowCount("peers", "WHERE seeder = 'no'");
$leechers = $leecher[13];

$member = Helper::rowCount("users", "WHERE UNIX_TIMESTAMP('" . $datet . "') - UNIX_TIMESTAMP(users.lastlogin) < 900");
$members = number_format($member[13]);

$totalonline = $members + $guests;

$downs = $db->select1("SELECT SUM(downloaded) AS totaldl FROM `users`");

while ($a = $downs) {
    $totaldownloaded = $downs->totaldl;
    break;
}

$ups =  $db->select1("SELECT SUM(uploaded) AS totalul FROM `users`");
while ($row = $ups) {
	$totaluploaded = $ups->totalul;
    break;
}

$localpeers = $leechers + $seeders;

?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
        <!-- content -->

        <ul class="list-unstyled">
        	<p> <strong> Torrents </strong> </p>
        	<li> <i class="fa fa-folder-open-o"></i> Tracking: <strong> <?= $ntor; ?> Torrents </strong> </li>
        	<li> <i class="fa fa-calendar-o"></i> New Today: <strong> <?= $todaytor; ?> </strong> </li>
        	<li> <i class="fa fa-refresh"></i> Seeders: <strong> <?= number_format($seeders); ?> </strong> </li>
        	<li> <i class="fa fa-arrow-circle-down"></i> Leechers: <strong> <?= number_format($leechers); ?> </strong> </li>
        	<li> <i class="fa fa-arrow-circle-up"></i> Peers: <strong> <?= number_format($localpeers); ?> </strong> </li>
        	<li> <i class="fa fa-download"></i> Downloaded: <strong> <span class="label label-danger"> <?= Helper::makeSize($totaldownloaded); ?> </span> </strong> </li>
        	<li> <i class="fa fa-upload"></i> Uploaded: <strong> <span class="label label-success"> <?= Helper::makeSize($totaluploaded); ?> </span> </strong> </li>

        	<hr />

        	<p> <strong> Member List </strong> </p>
        	<li> We Have: <strong> <?= $registered; ?> members </strong> </li>
        	<li> New Today: <strong> <?= $regtoday; ?> </strong> </li>
        	<li> Visitors Today: <strong> <?= $totaltoday; ?> </strong> </li>

        	<hr />

        	<p> <strong> Online </strong> </p>
        	<li> Total online: <strong> <?= $totalonline; ?> </strong> </li>
        	<li> Member List: <strong> <?= $members; ?> </strong> </li>
        	<li> Guests Online: <strong> <?= $guests; ?> </strong> </li>
        	<li> Comments Posted: <strong> <?= $ncomments; ?> </strong> </li>
        	<li> Messages Sent: <strong> <?= $nmessages; ?> </strong> </li>
        </ul>

        <!-- end content -->
    </div>
</div>
<br />
