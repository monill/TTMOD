<?php

use App\Libs\Helper;

$title = "Server Load";
$blockId = "b-" . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

<!--        --><?php
//            // Users and load information
//            $reguptime = exec("uptime");
//            if ($reguptime) {
//                if (preg_match("/up (.*), *(\d) (users?), .*: (.*), (.*), (.*)/", $reguptime, $uptime)) {
//                    $up = preg_replace("!(\d\d):(\d\d)!", '\1h\2m', $uptime[1]);
//                    $users[0] = $uptime[2];
//                    $users[1] = $uptime[3];
//                    $loadnow = $uptime[4];
//                    $load5 = $uptime[5];
//                    $load15 = $uptime[6];
//                }
//            } else {
//                $up = "--";
//                $users[0] = "NA";
//                $users[1] = "--";
//                $loadnow = "NA";
//                $load5 = "--";
//                $load15 = "--";
//            }
//
//            // Operating system
//            $temp = file_get_contents("/proc/version");
//            if ($temp) {
//
//                $osarray = explode(" ", $temp);
//
//                $distros = [
//                    "Gentoo" => "/etc/gentoo-release",
//
//                    "Fedora Core" => "/etc/fedora-release",
//
//                    "Slackware" => ["/etc/slackware-version", "/etc/slackware-release"],
//
//                    "Cobalt" => "/etc/cobalt-release",
//
//                    "Debian" => ["/etc/debian_version", "/etc/debian_release"],
//
//                    "Mandrake" => ["/etc/mandrake-release", "/etc/mandrakelinux-release"],
//
//                    "Yellow Dog" => "/etc/yellowdog-release",
//
//                    "Red Hat" => ["/etc/redhat-release", "/etc/redhat_version"],
//
//                    "Arch Linux" => "/etc/arch-release"
//                ];
//
//                $distro = "";
//                if (file_exists("/etc/lsb-release")) {
//                    $lsb = file_get_contents("/etc/lsb-release");
//                    preg_match('!DISTRIB_DESCRIPTION="(.*)"!', $lsb, $distro);
//                    $distro = $distro[1];
//                } else {
//                    do {
//                        if (file_exists($distros[1])) {
//                            $distro = file_get_contents($distros[1]);
//                            $distro = "$distros[0] " . preg_replace("/[^0-9]*([0-9.]+)[^0-9.]{0,1}.*/", "\\1", $distro);
//                            break;
//                        }
//                        array_shift($distros);
//                        array_shift($distros);
//                    } while (count($distros));
//                }
//
//                if (!$distro) {
//                    $distro = "Unknown Distro";
//                }
//
//                $operatingsystem = "$distro ($osarray[0] $osarray[2])";
//            } else {
//                $operatingsystem = "(N/A)";
//            }
//
//            // RAM usage
//            $meminfo = @file_get_contents("/proc/meminfo");
//            preg_match("!^MemTotal:\s*(.*) kB!m", $meminfo, $memtotal);
//            $memtotal = $memtotal[1] * 1024;
//            preg_match("!^MemFree:\s*(.*) kB!m", $meminfo, $memfree);
//            $memfree = $memfree[1] * 1024;
//            preg_match("!^Buffers:\s*(.*) kB!m", $meminfo, $buffers);
//            $buffers = $buffers[1] * 1024;
//            preg_match("!^Cached:\s*(.*) kB!m", $meminfo, $cached);
//            $cached = $cached[1] * 1024;
//
//            $memused = Helper::makeSize($memtotal - $memfree - $buffers - $cached);
//            $memtotal = Helper::makeSize($memtotal);
//        ?>
<!---->
<!--            <ul class="list-unstyled">-->
<!--                <li> Current Users: <strong> --><?php //echo $users['0']; ?><!-- </strong> </li>-->
<!--                <li> Current Load: <strong> --><?php //echo $loadnow; ?><!-- </strong> </li>-->
<!--                <li> Load 5 mins ago: <strong> --><?php //echo $load5; ?><!-- </strong> </li>-->
<!--                <li> Load 15 mins ago: <strong> --><?php //echo $load15; ?><!-- </strong> </li>-->
<!--                <hr />-->
<!--                <li>OS: <strong> --><?php //echo $operatingsystem; ?><!-- </strong> </li>-->
<!--                <li> RAM Used: <strong> --><?php //echo $memused; ?><!-- / --><?php //echo $memtotal; ?><!-- </strong> </li>-->
<!--                <li> Uptime: <strong> --><?php //echo $up; ?><!-- </strong> </li>-->
<!--            </ul>-->


    <!-- end content -->
    </div>
</div>
<br />
