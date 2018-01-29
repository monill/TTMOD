

<?php
$title = "Latest Torrents";
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

		// $expire = 900; // time in seconds
	    //
		// if (($latestuploadsrecords = $TTCache->Get("latestuploadsblock", $expire)) === false) {
		// 	$latestuploadsquery = SQL_Query_exec("SELECT id, name, size, seeders, leechers FROM torrents WHERE banned='no' AND visible = 'yes' ORDER BY id DESC LIMIT 5");
	    //
		// 	$latestuploadsrecords = array();
		// 	while ($latestuploadsrecord = mysqli_fetch_assoc($latestuploadsquery))
		// 		$latestuploadsrecords[] = $latestuploadsrecord;
		// 	$TTCache->Set("latestuploadsblock", $latestuploadsrecords, $expire);
		// }
	    //
		// if ($latestuploadsrecords) {
		// 	foreach ($latestuploadsrecords as $row) {
		// 		$char1 = 20; //cut length
		// 		$smallname = htmlspecialchars(CutName($row["name"], $char1)); ?>
				<!-- <div class="pull-left"><a href="torrents-details.php?id=1" title=" name "> smallname </a></div> -->
				<!-- <div class="pull-right"> Size: <span class="label label-success"> size </span></div> -->
			<?php
		//}
		//} else { ?>
			<p calss="text-center"> Nothing found </p>
		<?php
	//}
	?>
	
	<!-- end content -->
    </div>
</div>
<br />
