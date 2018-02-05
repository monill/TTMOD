<?php

use App\Libs\Database;

$title = "Latest News";
$blockId = "b-" . sha1($title);
$db = Database::getInstance();
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

    <?php $res = $db->select("SELECT * FROM `news` ORDER BY `created_at` DESC LIMIT 10"); ?>

    <script>
    /***********************************************
     * Cross browser Marquee II- ? Dynamic Drive (www.dynamicdrive.com)
     * This notice MUST stay intact for legal use
     * Visit http://www.dynamicdrive.com/ for this script and 100s more.
     ***********************************************/

    var delayb4scroll = 2000 //Specify initial delay before marquee starts to scroll on page (2000=2 seconds)
    var marqueespeed = 1 //Specify marquee scroll speed (larger is faster 1-10)
    var pauseit = 1 //Pause marquee onMousever (0=no. 1=yes)?

    ////NO NEED TO EDIT BELOW THIS LINE////////////

    var copyspeed = marqueespeed
    var pausespeed = (pauseit == 0) ? copyspeed : 0
    var actualheight = ''

    function scrollmarquee() {
        if (parseInt(cross_marquee.style.top) > (actualheight * (-1) + 8)) {
            cross_marquee.style.top = parseInt(cross_marquee.style.top) - copyspeed + "px"
        } else {
            cross_marquee.style.top = parseInt(marqueeheight) + 8 + "px"
        }
    }

    function initializemarquee() {
        cross_marquee = document.getElementById("vmarquee")
        cross_marquee.style.top = 0
        marqueeheight = document.getElementById("marqueecontainer").offsetHeight
        actualheight = cross_marquee.offsetHeight
        if (window.opera || navigator.userAgent.indexOf("Netscape/7") != -1) { //if Opera or Netscape 7x, add scrollbars to scroll and exit
            cross_marquee.style.height = marqueeheight + "px"
            cross_marquee.style.overflow = "scroll"
            return
        }
        setTimeout('lefttime=setInterval("scrollmarquee()",30)', delayb4scroll)
    }

    <?php if (count($res) > 3): ?>

    if (window.addEventListener) {
        window.addEventListener("load", initializemarquee, false)
    } else if (window.attachEvent) {
        window.attachEvent("onload", initializemarquee)
    } else if (document.getElementById) {
        window.onload = initializemarquee
    }

    <?php endif; ?>

    </script>

	<div id="marqueecontainer" onmouseover="copyspeed=pausespeed" onmouseout="copyspeed=marqueespeed">
        <div id="vmarquee">
            <!--YOUR SCROLL CONTENT HERE-->

        <?php if (count($res)): ?>
            <dl>
                <?php foreach ($res as $key => $value): ?>
                    <dt>
                        <?php //TODO  #fix href link ?>
                        <a href="comments.php?type=news&amp;id=<?php echo $value->id; ?>">
                            <strong><?php echo $value->title; ?></strong>
                        </a>
                    </dt>
                    <dd>
                        <strong> Posted: </strong> <?php echo date("d-m-Y", strtotime($value->created_at)); ?>
                    <dd>

                <?php endforeach; ?>
            </dl>
        <?php else: ?>
            <p class="text-center"> No news currently at this time </p>
        <?php endif; ?>
        </div>
    </div>

    <!-- end content -->
    </div>
</div>
<br />
