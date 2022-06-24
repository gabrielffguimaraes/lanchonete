<?php

class StatusController extends StatusDAO
{

    public function __construct()
    {

        $this->open();
    }

    public function list($req,$res)
    {
        $status = $this->getStatus("",false);
        return $res->withJson($status,200);
    }

}
