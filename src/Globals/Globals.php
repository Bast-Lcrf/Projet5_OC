<?php

namespace src\Globals;

class Globals
{
    private $GET;
    private $POST;

    public function __construct()
    {
        $this->GET = filter_input_array(INPUT_GET) ?? null;
        $this->POST = filter_input_array(INPUT_POST) ?? null;
    }

    /**
     * Get $_GET
     * @param string $key
     * @return mixed
     */
    public function getGET($key = null) {
        if(null !== $key) {
            return $this->GET[$key] ?? null;
        }
        return $this->GET;
    }
    /**
     * Get $_POST
     * @param string $key
     * @return mixed
     */
    public function getPOST($key = null) {
        if(null !== $key) {
            return $this->POST[$key] ?? null;
        }
        return $this->POST;
    }
}