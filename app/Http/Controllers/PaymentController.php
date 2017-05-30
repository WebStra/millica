<?php
namespace App\Http\Controllers;

use App\Libraries\Payment\Request\Mobilpay_Payment_Request_Abstract;
use App\Libraries\Payment\Request\Mobilpay_Payment_Request_Card;
use App\Libraries\Payment\Request\Mobilpay_Payment_Request_Notify;
use App\Libraries\Payment\Mobilpay_Payment_Invoice;
use App\Libraries\Payment\Mobilpay_Payment_Address;
use App\Repositories\ComandRepository;
use App\Repositories\ProductComandRepository;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

/*require_once 'Mobilpay/Payment/Request/Abstract.php';
require_once 'Mobilpay/Payment/Request/Card.php';
require_once 'Mobilpay/Payment/Invoice.php';
require_once 'Mobilpay/Payment/Address.php';*/

class PaymentController extends Controller
{
    protected $signature;
    protected $confirmUrl;
    protected $returnUrl;
    protected $x509FilePath;
    protected $paymentUrl;
    protected $privateKeyFilePath;
    protected $comand;
    protected $comandproduct;

    public function __construct(ComandRepository $comandRepository,
                                ProductComandRepository $productComandRepository
    )
    {
        #sandbox server http://sandboxsecure.mobilpay.ro
        $this->paymentUrl = 'https://secure.mobilpay.ro';
        $this->comand = $comandRepository;
        $this->comandproduct = $productComandRepository;
        $this->x509FilePath = app_path() . '/Libraries/Payment/live.ARQP-Y4E9-SLWR-8CT4-N16H.public.cer';
        $this->privateKeyFilePath = app_path() . '/Libraries/Payment/live.ARQP-Y4E9-SLWR-8CT4-N16Hprivate.key';
        $this->signature = 'ARQP-Y4E9-SLWR-8CT4-N16H';
        $this->confirmUrl = 'http://millica.ro/paymentConfirm';
        $this->returnUrl = 'http://millica.ro/paymentReturn';
    }

    public function index()
    {
        return view('payment.paymentForm');
    }

    public function paymentRedirect(Request $request)
    {
        $billingInfo = new Mobilpay_Payment_Address();
        $billingInfo->type = 'person';//$_POST['billing_type']; //should be "person"
        $billingInfo->firstName = $_POST['billing_first_name'];
        $billingInfo->lastName = $_POST['billing_last_name'];
        $billingInfo->address = $_POST['billing_address'];
        $billingInfo->email = $_POST['billing_email'];
        $billingInfo->mobilePhone = $_POST['billing_mobile_phone'];

        $shippingInfo = new Mobilpay_Payment_Address();
        $shippingInfo->type = 'person';
        $shippingInfo->firstName = $_POST['shipping_first_name'];
        $shippingInfo->lastName = $_POST['shipping_last_name'];
        $shippingInfo->address = $_POST['shipping_address'];
        $shippingInfo->email = $_POST['shipping_email'];
        $shippingInfo->mobilePhone = $_POST['shipping_mobile_phone'];

        $code = $request->product_code;

        $productInfo = array(
            'currency' => 'RON',
            'amount' => $request->price,
            'description' => 'Product Description'
        );

        $objPmReqCard = $this->_paymentSet($billingInfo, $shippingInfo, $productInfo, $code);

        return view('payment.paymentRedirect', array('paymentUrl' => $this->paymentUrl, 'objPmReqCard' => $objPmReqCard));
    }

    public function _paymentSet($billingInfo, $shippingInfo, $productInfo, $code)
    {
        try {
            srand((double)microtime() * 1000000);
            $objPmReqCard = new Mobilpay_Payment_Request_Card();
            $objPmReqCard->signature = $this->signature;
            $objPmReqCard->orderId = $code;
            $objPmReqCard->confirmUrl = $this->confirmUrl;
            $objPmReqCard->returnUrl = $this->returnUrl;

            #detalii cu privire la plata: moneda, suma, descrierea
            #payment details: currency, amount, description
            $objPmReqCard->invoice = new Mobilpay_Payment_Invoice();
            $objPmReqCard->invoice->currency = $productInfo['currency'];
            $objPmReqCard->invoice->amount = $productInfo['amount'];
            $objPmReqCard->invoice->description = $productInfo['description'];


            #available installments number; if this parameter is present, only its value(s) will be available
            //$objPmReqCard->invoice->installments= '2,3';
            #selected installments number; its value should be within the available installments defined above
            //$objPmReqCard->invoice->selectedInstallments= '3';
            //platile ulterioare vor contine in request si informatiile despre token. Prima plata nu va contine linia de mai jos.
            $objPmReqCard->invoice->tokenId = 'token_id';
            $objPmReqCard->invoice->details = 'Plata cu card-ul prin mobilPay';

            #detalii cu privire la adresa posesorului cardului
            #details on the cardholder address (optional)
            $objPmReqCard->invoice->setBillingAddress($billingInfo);

            #detalii cu privire la adresa de livrare
            #details on the shipping address
            $objPmReqCard->invoice->setShippingAddress($shippingInfo);

            #uncomment the line below in order to see the content of the request
            //echo "<pre>";print_r($objPmReqCard);echo "</pre>";


            $objPmReqCard->encrypt($this->x509FilePath);

            return $objPmReqCard;

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function paymentConfirm()
    {
        $errorCode = 0;
        $errorType = Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_NONE;
        $errorMessage = '';

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') == 0) {
            if (isset($_POST['env_key']) && isset($_POST['data'])) {
                #calea catre cheia privata
                #cheia privata este generata de mobilpay, accesibil in Admin -> Conturi de comerciant -> Detalii -> Setari securitate
                $privateKeyFilePath = $this->privateKeyFilePath;

                try {
                    $objPmReq = Mobilpay_Payment_Request_Abstract::factoryFromEncrypted($_POST['env_key'], $_POST['data'], $privateKeyFilePath);
                    #uncomment the line below in order to see the content of the request
//                    \Storage::put('/errorPayment.txt', $objPmReq->objPmNotify->errorMessage);
                    //print_r($objPmReq);
                    $rrn = $objPmReq->objPmNotify->rrn;
                    // action = status only if the associated error code is zero
                    if ($objPmReq->objPmNotify->errorCode == 0) {
                        switch ($objPmReq->objPmNotify->action) {
                            #orice action este insotit de un cod de eroare si de un mesaj de eroare. Acestea pot fi citite folosind $cod_eroare = $objPmReq->objPmNotify->errorCode; respectiv $mesaj_eroare = $objPmReq->objPmNotify->errorMessage;
                            #pentru a identifica ID-ul comenzii pentru care primim rezultatul platii folosim $id_comanda = $objPmReq->orderId;
                            case 'confirmed':

                                #cand action este confirmed avem certitudinea ca banii au plecat din contul posesorului de card si facem update al starii comenzii si livrarea produsului
                                //*** UPDATE DB, SET status = "confirmed/captured"

                                $this->comand->setStatus($objPmReq->orderId, 'paid', 'confirmed');

                                $errorMessage = $objPmReq->objPmNotify->errorMessage;
                                break;
                            case 'confirmed_pending':
                                #cand action este confirmed_pending inseamna ca tranzactia este in curs de verificare antifrauda. Nu facem livrare/expediere. In urma trecerii de aceasta verificare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
                                //*** UPDATE DB, SET status = "pending"

                                $this->comand->setStatus($objPmReq->orderId, 'pending', 'confirmed_pending');
                                $errorMessage = $objPmReq->objPmNotify->errorMessage;
                                break;
                            case 'paid_pending':
                                #cand action este paid_pending inseamna ca tranzactia este in curs de verificare. Nu facem livrare/expediere. In urma trecerii de aceasta verificare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
                                //*** UPDATE DB, SET status = "pending"

                                $this->comand->setStatus($objPmReq->orderId, 'pending', 'paid_pending');
                                $errorMessage = $objPmReq->objPmNotify->errorMessage;
                                break;
                            case 'paid':
                                #cand action este paid inseamna ca tranzactia este in curs de procesare. Nu facem livrare/expediere. In urma trecerii de aceasta procesare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
                                //*** UPDATE DB, SET status = "open/preauthorized"

                                $this->comand->setStatus($objPmReq->orderId, 'pending', 'paid');
                                $errorMessage = $objPmReq->objPmNotify->errorMessage;
                                break;
                            case 'canceled':
                                #cand action este canceled inseamna ca tranzactia este anulata. Nu facem livrare/expediere.

                                $this->comand->setStatus($objPmReq->orderId, 'canceled', 'canceled');
                                //*** UPDATE DB, SET status = "canceled"
                                $errorMessage = $objPmReq->objPmNotify->errorMessage;
                                break;

                            case 'credit':
                                #cand action este credit inseamna ca banii sunt returnati posesorului de card. Daca s-a facut deja livrare, aceasta trebuie oprita sau facut un reverse.
                                $this->comand->setStatus($objPmReq->orderId, 'pending', 'credit');
                                //*** UPDATE DB, SET status = "refunded"
                                $errorMessage = $objPmReq->objPmNotify->errorMessage;
                                break;
                            default:
                                $errorType = Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_PERMANENT;
                                $errorCode = Mobilpay_Payment_Request_Abstract::ERROR_CONFIRM_INVALID_ACTION;
                                $errorMessage = 'mobilpay_refference_action paramaters is invalid';
                                break;
                        }
                    } else {
                        //*** UPDATE DB, SET status = "rejected"
                        $errorMessage = $objPmReq->objPmNotify->errorMessage;
                    }
                } catch (Exception $e) {
                    $errorType = Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_TEMPORARY;
                    $errorCode = $e->getCode();
                    $errorMessage = $e->getMessage();
                }
            } else {
                $errorType = Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_PERMANENT;
                $errorCode = Mobilpay_Payment_Request_Abstract::ERROR_CONFIRM_INVALID_POST_PARAMETERS;
                $errorMessage = 'mobilpay.ro posted invalid parameters';
            }
        } else {
            $errorType = Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_PERMANENT;
            $errorCode = Mobilpay_Payment_Request_Abstract::ERROR_CONFIRM_INVALID_POST_METHOD;
            $errorMessage = 'invalid request metod for payment confirmation';
        }


        // Show Response
        header('Content-type: application/xml');
        echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        if ($errorCode == 0) {
            echo "<crc>{$errorMessage}</crc>";
        } else {
            echo "<crc error_type=\"{$errorType}\" error_code=\"{$errorCode}\">{$errorMessage}</crc>";
        }
    }

    public function paymentReturn()
    {
        $id = $_GET['orderId'];

        $command = $this->comand->getByConfirmCodeAdmin($id);

        $basketProducts = $this->comandproduct->getByComandId($command->id);

        ($this->comandproduct->sumProductPrice($command->id)) ? $sumPriceProducts = $this->comandproduct->sumProductPrice($command->id) : $sumPriceProducts = '0';

        if ($sumPriceProducts > 200) {
            $price = $sumPriceProducts;
        } else {
            $price = $sumPriceProducts + 15;
        }

        return view('auth.settings.partials.single-command', ['comand' => $command, 'basketProducts' => $basketProducts, 'sumPriceProducts' => $sumPriceProducts]);

    }


}