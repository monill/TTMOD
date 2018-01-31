<?php

namespace App\Libs\Torrent;

use App\Libs\Helper;

/**
 * Scrape torrent and return stats
 *
 * @param $scrape
 *   string: Scrape URL
 * @param $hash
 *   string: SHA1 hash (info_hash) of torrent
 * @return
 *  array:
 *    All -1 if failed
 *    - seeds: integer - number of seeders
 *    - leechers: integer - number of leechers
 *    - downloaded: integer - number of complete downloads
 *
 */
class ScrapeUrl
{
    public function __construct($scrape, $hash)
    {
        if (function_exists('curl_exec')) {
            $ch = curl_init();
            $timeout = 30;

            curl_setopt($ch, CURLOPT_URL, $scrape . "?info_hash=" . Helper::escapeUrl($hash));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_HEADER, false);

            $fp = curl_exec($ch);
            curl_close($ch);
        } else {
            ini_set('default_socket_timeout', 10);
            $fp = file_get_contents($scrape . "?info_hash=" . Helper::escapeUrl($hash));
        }

        $ret = array();

        if ($fp) {
            $stats = Bencode::decode($fp);
            $binhash = pack("H*", $hash);
            $binhash = addslashes($binhash);
            $seeds = $stats['files'][$binhash]['complete'];
            $peers = $stats['files'][$binhash]['incomplete'];
            $downloaded = $stats['files'][$binhash]['downloaded'];
            $ret['seeds'] = $seeds;
            $ret['peers'] = $peers;
            $ret['downloaded'] = $downloaded;
        }
        if ($ret['seeds'] === null) {
            $ret['seeds'] = -1;
            $ret['peers'] = -1;
            $ret['downloaded'] = -1;
        }
        return $ret;
    }

    public function __clone() { }
}