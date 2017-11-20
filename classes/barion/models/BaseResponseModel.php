<?php namespace Indikator\SellProducts\Classes\Barion\Models;

use Indikator\SellProducts\Classes\Barion\Models\ApiErrorModel;

class BaseResponseModel
{
    public $Errors;
    public $RequestSuccessful;

    function __construct()
    {
        $this->Errors = array();
        $this->RequestSuccessful = false;
    }

    public function fromJson($json)
    {
        if (!empty($json)) {
            $this->RequestSuccessful = true;
            if (!array_key_exists('Errors', $json) || !empty($json['Errors'])) {
                $this->RequestSuccessful = false;
            }

            if (array_key_exists('Errors', $json)) {
                foreach ($json['Errors'] as $error) {
                    $apiError = new ApiErrorModel();
                    $apiError->fromJson($error);
                    array_push($this->Errors, $apiError);
                }
            } else {
                $internalError = new ApiErrorModel();
                $internalError->ErrorCode = "500";
                if (array_key_exists('ExceptionMessage', $json)) {
                    $internalError->Title = $json['ExceptionMessage'];
                    $internalError->Description = $json['ExceptionType'];
                } else {
                    $internalError->Title = "Internal Server Error";
                }

                array_push($this->Errors, $internalError);
            }
        }
    }
}
