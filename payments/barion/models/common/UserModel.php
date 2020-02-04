<?php namespace Indikator\SellProducts\Payments\Barion\Models\Common;

use Indikator\SellProducts\Payments\Barion\Helpers\iBarionModel;
use Indikator\SellProducts\Payments\Barion\Models\Common\UserNameModel;

class UserModel implements iBarionModel
{
    public $Name;
    public $Email;

    function __construct()
    {
        $this->Name = "";
        $this->Email = "";
    }

    function fromJson($json)
    {
        if (!empty($json)) {
            $this->Email = $json['Email'];

            $name = new UserNameModel();
            $name->fromJson($json['Name']);
        }
    }
}