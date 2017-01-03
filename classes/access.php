<?php

/**
 * Created by PhpStorm.
 * User: aequalis
 * Date: 21/12/16
 * Time: 2:57 PM
 */
class Access
{
    public $page;

    public function __construct($page)
    {
        $this->page = $page;
    }

    public function accessPage($page)
    {
        $resourcePageContents = file_get_contents($page);
        return $resourcePageContents;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}