<?php namespace Indikator\SellProducts\Payments\Barion;

use Indikator\SellProducts\Payments\Barion\Models\Payment\PreparePaymentRequestModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\PreparePaymentResponseModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\FinishReservationRequestModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\FinishReservationResponseModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\CaptureRequestModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\CaptureResponseModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\CancelAuthorizationRequestModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\CancelAuthorizationResponseModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\RefundRequestModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\RefundResponseModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\PaymentStateRequestModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\PaymentStateResponseModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\PaymentQRRequestModel;
use Indikator\SellProducts\Payments\Barion\Models\ApiErrorModel;
use Indikator\SellProducts\Payments\Barion\Models\BaseResponseModel;

include 'helpers' . DIRECTORY_SEPARATOR . 'loader.php';

class BarionClient
{
    private $Environment;

    private $Password;
    private $APIVersion;
    private $POSKey;

    private $BARION_API_URL = "";
    private $BARION_WEB_URL = "";

    private $UseBundledRootCertificates;

    /**
     *  Constructor
     *
     * @param string $poskey The secret POSKey of your shop
     * @param int $version The version of the Barion API
     * @param string $env The environment to connect to
     * @param bool $useBundledRootCerts Set this to true if you're having problem with SSL connection
     */
    function __construct($poskey, $version = 2, $env = "prod", $useBundledRootCerts = false)
    {
        $this->POSKey = $poskey;
        $this->APIVersion = $version;
        $this->Environment = $env;

        switch ($env) {
            case "test":
                $this->BARION_API_URL = BARION_API_URL_TEST;
                $this->BARION_WEB_URL = BARION_WEB_URL_TEST;
                break;

            case "prod":
            default:
                $this->BARION_API_URL = BARION_API_URL_PROD;
                $this->BARION_WEB_URL = BARION_WEB_URL_PROD;
                break;
        }

        $this->UseBundledRootCertificates = $useBundledRootCerts;
    }

    /* -------- BARION API CALL IMPLEMENTATIONS -------- */


    /**
     * Prepare a new payment
     *
     * @param PreparePaymentRequestModel $model The request model for payment preparation
     * @return PreparePaymentResponseModel Returns the response from the Barion API
     */
    public function PreparePayment(PreparePaymentRequestModel $model)
    {
        $model->POSKey = $this->POSKey;
        $url = $this->BARION_API_URL . "/v" . $this->APIVersion . API_ENDPOINT_PREPAREPAYMENT;
        $response = $this->PostToBarion($url, $model);
        $rm = new PreparePaymentResponseModel();
        if (!empty($response)) {
            $json = json_decode($response, true);
            $rm->fromJson($json);
            if (!empty($rm->PaymentId)) {
                $rm->PaymentRedirectUrl = $this->BARION_WEB_URL . "?" . http_build_query(array("id" => $rm->PaymentId));
            }
        }
        return $rm;
    }

    /**
     *
     * Finish an existing reservation
     *
     * @param FinishReservationRequestModel $model The request model for the finish process
     * @return FinishReservationResponseModel Returns the response from the Barion API
     */
    public function FinishReservation(FinishReservationRequestModel $model)
    {
        $model->POSKey = $this->POSKey;
        $url = $this->BARION_API_URL . "/v" . $this->APIVersion . API_ENDPOINT_FINISHRESERVATION;
        $response = $this->PostToBarion($url, $model);
        $rm = new FinishReservationResponseModel();
        if (!empty($response)) {
            $json = json_decode($response, true);
            $rm->fromJson($json);
        }
        return $rm;
    }
    
    /**
     *
     * Capture the previously authorized money in a Delayed Capture payment
     *
     * @param CaptureRequestModel $model The request model for the capture process
     * @return CaptureResponseModel Returns the response from the Barion API
     */
    public function Capture(CaptureRequestModel $model)
    {
        $model->POSKey = $this->POSKey;
        $url = $this->BARION_API_URL . "/v" . $this->APIVersion . API_ENDPOINT_CAPTURE;
        $response = $this->PostToBarion($url, $model);
        $captureResponse = new CaptureResponseModel();
        if (!empty($response)) {
            $json = json_decode($response, true);
            $captureResponse->fromJson($json);
        }
        return $captureResponse;
    }

    /**
     *
     * Cancel a pending authorization on a Delayed Capture payment
     *
     * @param CancelAuthorizationRequestModel $model The request model for cancelling the authorization
     * @return CancelAuthorizationResponseModel Returns the response from the Barion API
     */
    public function CancelAuthorization(CancelAuthorizationRequestModel $model)
    {
        $model->POSKey = $this->POSKey;
        $url = $this->BARION_API_URL . "/v" . $this->APIVersion . API_ENDPOINT_CANCELAUTHORIZATION;
        $response = $this->PostToBarion($url, $model);
        $cancelAuthResponse = new CancelAuthorizationResponseModel();
        if (!empty($response)) {
            $json = json_decode($response, true);
            $cancelAuthResponse->fromJson($json);
        }
        return $cancelAuthResponse;
    }


    /**
     * Refund a payment partially or totally
     *
     * @param RefundRequestModel $model The request model for the refund process
     * @return RefundResponseModel Returns the response from the Barion API
     */
    public function RefundPayment(RefundRequestModel $model)
    {
        $model->POSKey = $this->POSKey;
        $url = $this->BARION_API_URL . "/v" . $this->APIVersion . API_ENDPOINT_REFUND;
        $response = $this->PostToBarion($url, $model);
        $rm = new RefundResponseModel();
        if (!empty($response)) {
            $json = json_decode($response, true);
            $rm->fromJson($json);
        }
        return $rm;
    }


    /**
     * Get detailed information about a given payment
     *
     * @param string $paymentId The Id of the payment
     * @return PaymentStateResponseModel Returns the response from the Barion API
     */
    public function GetPaymentState($paymentId)
    {
        $model = new PaymentStateRequestModel($paymentId);
        $model->POSKey = $this->POSKey;
        $url = $this->BARION_API_URL . "/v" . $this->APIVersion . API_ENDPOINT_PAYMENTSTATE;
        $response = $this->GetFromBarion($url, $model);
        $ps = new PaymentStateResponseModel();
        if (!empty($response)) {
            $json = json_decode($response, true);
            $ps->fromJson($json);
        }
        return $ps;
    }

    /**
     * Get the QR code image for a given payment
     *
     * NOTE: This call is deprecated and is only working with username & password authentication.
     * If no username and/or password was set, this method returns NULL.
     *
     * @deprecated
     * @param string $username The username of the shop's owner
     * @param string $password The password of the shop's owner
     * @param string $paymentId The Id of the payment
     * @param string $qrCodeSize The desired size of the QR image
     * @return mixed|string Returns the response of the QR request
     */
    public function GetPaymentQRImage($username, $password, $paymentId, $qrCodeSize = QRCodeSize::Large)
    {
        $model = new PaymentQRRequestModel($paymentId);
        $model->POSKey = $this->POSKey;
        $model->UserName = $username;
        $model->Password = $password;
        $model->Size = $qrCodeSize;
        $url = $this->BARION_API_URL . API_ENDPOINT_QRCODE;
        $response = $this->GetFromBarion($url, $model);
        return $response;
    }

    /* -------- CURL HTTP REQUEST IMPLEMENTATIONS -------- */

    /*
    *
    */
    /**
     * Managing HTTP POST requests
     *
     * @param string $url The URL of the API endpoint
     * @param object $data The data object to be sent to the endpoint
     * @return mixed|string Returns the response of the API
     */
    private function PostToBarion($url, $data)
    {
        $ch = curl_init();
        
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        if ($userAgent == "") {
            $cver = curl_version();
            $userAgent = "curl/" . $cver["version"] . " " .$cver["ssl_version"];
        }

        $postData = json_encode($data);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "User-Agent: $userAgent"));
        
        if(substr(phpversion(), 0, 3) < 5.6) {
            curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        }

        if ($this->UseBundledRootCertificates) {
            curl_setopt($ch, CURLOPT_CAINFO, join(DIRECTORY_SEPARATOR, array(dirname(__FILE__), 'ssl', 'cacert.pem')));

            if ($this->Environment == BarionEnvironment::Test) {
                curl_setopt($ch, CURLOPT_CAPATH, join(DIRECTORY_SEPARATOR, array(dirname(__FILE__), 'ssl', 'gd_bundle-g2.crt')));
            }
        }

        $output = curl_exec($ch);
        if ($err_nr = curl_errno($ch)) {
            $error = new ApiErrorModel();
            $error->ErrorCode = "CURL_ERROR";
            $error->Title = "CURL Error #" . $err_nr;
            $error->Description = curl_error($ch);

            $response = new BaseResponseModel();
            $response->Errors = array($error);
            $output = json_encode($response);
        }
        curl_close($ch);

        return $output;
    }


    /**
     * Managing HTTP GET requests
     *
     * @param string $url The URL of the API endpoint
     * @param object $data The data object to be sent to the endpoint
     * @return mixed|string Returns the response of the API
     */
    private function GetFromBarion($url, $data)
    {
        $ch = curl_init();

        $getData = http_build_query($data);
        $fullUrl = $url . '?' . $getData;
        
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        if ($userAgent == "") {
            $cver = curl_version();
            $userAgent = "curl/" . $cver["version"] . " " .$cver["ssl_version"];
        }

        curl_setopt($ch, CURLOPT_URL, $fullUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("User-Agent: $userAgent"));
        
        if(substr(phpversion(), 0, 3) < 5.6) {
            curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        }

        if ($this->UseBundledRootCertificates) {
            curl_setopt($ch, CURLOPT_CAINFO, join(DIRECTORY_SEPARATOR, array(dirname(__FILE__), 'ssl', 'cacert.pem')));

            if ($this->Environment == BarionEnvironment::Test) {
                curl_setopt($ch, CURLOPT_CAPATH, join(DIRECTORY_SEPARATOR, array(dirname(__FILE__), 'ssl', 'gd_bundle-g2.crt')));
            }
        }

        $output = curl_exec($ch);
        if ($err_nr = curl_errno($ch)) {
            $error = new ApiErrorModel();
            $error->ErrorCode = "CURL_ERROR";
            $error->Title = "CURL Error #" . $err_nr;
            $error->Description = curl_error($ch);

            $response = new BaseResponseModel();
            $response->Errors = array($error);
            $output = json_encode($response);
        }
        curl_close($ch);

        return $output;
    }
}