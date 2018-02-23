<?php

namespace App\Libs;

class Cache
{
    public $cacheDir = CACHE;
    public $cacheType = "disk"; // disk = Save cache to disk, memcache = Use memcache, apc = Use APC, xcache = Use XCache

    public function __construct()
    {
        switch ($this->cacheType) {
            case "memcache":
                $this->obj = new \Memcache();
                if (!$this->obj->connect("127.0.0.1", 112111)) {
                    $this->cacheType = "disk";
                }
                break;

            case "apc":
                if (function_exists("apc_store")) {
                    return "";
                }
                break;

            case "xcache":
                if (function_exists("xcache_set")) {
                    return "";
                }
                break;

            default:
                $this->cacheType = "disk";
                break;
        }
    }

    private function __clone() { }

    public function set($var, $val, $expire = 0)
    {
        if ($expire == 0) {
            return false;
        }

        switch ($this->cacheType) {
            case "memcache":
                return $this->obj->set(SNAME . "_" . $var, $val, 0, $expire);
                break;

            case "apc":
                return apc_store($var, $val, $expire);
                break;

            case "disk":
                $fp = fopen($this->cacheDir . "$var.cache", "w");
                fwrite($fp, serialize($val));
                fclose($fp);
                exit();
                break;

            case "xcache":
                return xcache_set($var, serialize($val), $expire);
                break;

            default:
                return "";
        }
    }

    public function get($var, $expire = 0)
    {
        if ($expire == 0) {
            return false;
        }

        switch ($this->cacheType) {
            case "memcache":
                return $this->obj->get(SNAME . "_" . $var);
                break;

            case "apc":
                return apc_fetch($var);
                break;

            case "disk":
                $file = $this->cacheDir . "$var.cache";
                if (file_exists($file) && (time() - filemtime($file)) < $expire) {
                    return unserialize(file_get_contents($file));
                }
                return false;
                break;

            case "xcache":
                if (xcache_isset($var)) {
                    return unserialize(xcache_get($var));
                }
                return false;
                break;

            default:
                return "";
                break;
        }
    }

    public function delete($var)
    {
        switch ($this->cacheType) {
            case "memcache":
                return $this->obj->delete(SNAME . "_" . $var);
                break;

            case "apc":
                return apc_delete($var);
                break;

            case "disk":
                unlink($this->cacheDir . "$var.cache");
                break;

            case "xcache":
                return xcache_unset($var);
                break;

            default:
                return "";
                break;
        }
    }

}
