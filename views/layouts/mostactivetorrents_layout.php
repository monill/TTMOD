<?php

	// begin_block(T_("MOST_ACTIVE"));

	// $where = "WHERE banned = 'no' AND visible = 'yes'";
	//uncomment the following line to exclude external torrents
	//$where = "WHERE external !='yes' AND banned ='no' AND visible = 'yes'"

	// $expires = 600; // Cache time in seconds
	// if (($rows = $TTCache->Get("mostactivetorrents_block", $expires)) === false) {
	// 	$res = SQL_Query_exec("SELECT id, name, seeders, leechers FROM torrents $where ORDER BY seeders + leechers DESC, seeders DESC, added ASC LIMIT 10");
    //
	// 	$rows = array();
	// 	while ($row = mysqli_fetch_assoc($res))
	// 		$rows[] = $row;
    //
    //
	// }
    //
	// if ($rows) {
	// 	foreach ($rows as $row) {
	// 			$char1 = 20; //cut length
	// 			$smallname = htmlspecialchars(CutName($row["name"], $char1)); ?>

				<!-- <div class="pull-left"><a href='torrents-details.php?id=1' title='nome '> smallname </a></div> -->
				<!-- <div class="pull-right"><span class="label label-success">S: seeders </span> -->
                    <!-- <span class="label label-warning">L: leechers </span></div> -->

		<?php
	#}

// } else {
?>

	<!-- <p> Nothin found</p> -->

<?php
///}
?>

<?php
$title = "Most Active";
$blockId = 'b-' . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->


    <!-- end content -->
    </div>
</div>
<br />
