<?php

class StatusController extends StatusDAO
{

    public function __construct()
    {

        $this->open();
    }

    public function list($req,$res)
    {
        $status = $this->getStatus();
        return $res->withJson($status,200);
    }

}
