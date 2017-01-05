<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\IndiaReads\Repository\Eloquent\UserRepository;
use App\IndiaReads\Repository\Eloquent\UserInfoRepository;
use App\IndiaReads\Repository\Eloquent\BookRepository;
use App\IndiaReads\Repository\Eloquent\UserAddressBookRepository;
use App\IndiaReads\Repository\Eloquent\UserStoreCreditsRepository;
use App\IndiaReads\Repository\Eloquent\CirculationDiscountRepository;
use App\IndiaReads\Repository\Eloquent\InitialDiscountRepository;
use App\IndiaReads\Repository\Eloquent\BookshelfOrderDetailsRepository;
use App\IndiaReads\Repository\Eloquent\BookshelfOrderRepository;
use App\IndiaReads\Repository\Eloquent\BookLibraryRepository;
use App\IndiaReads\Repository\Eloquent\MerchantLibraryRepository;
use App\IndiaReads\Repository\Eloquent\MerchantDetailsRepository;
use App\IndiaReads\Repository\Eloquent\MerchantMappingRepository;
use App\IndiaReads\Repository\Eloquent\BookshelfParentOrderRepository;
use App\IndiaReads\Repository\Eloquent\BookshelfOrderTrackingRepository;
use App\IndiaReads\Repository\Eloquent\UserStoreCreditDetailsRepository;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class CheckoutController extends ApiController {

    // public MCRYPT_RIJNDAEL_128 = "secret";

    /**
     * @var paginatiion_limit
     */
    protected $pagination_limit = 5;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var UserInfoRepository
     */
    protected $userInfoRepository;

    /**
     * @var BookRepository
     */
    protected $bookRepository;

    /**
     * @var BookshelfParentOrderRepository
     */
    protected $bookshelfParentOrderRepository;

    /**
     * @var MerchantLibraryRepository
     */
    protected $merchantLibraryRepository;

    /**
     * @var MerchantDetailsRepository
     */
    protected $merchantDetailsRepository;

    /**
     * @var MerchantMappingRepository
     */
    protected $merchantMappingRepository;

    /**
     * @var UserAddressBookRepository
     */
    protected $userAddressBookRepository;

    /**
     * @var UserStoreCreditsRepository
     */
    protected $userStoreCreditsRepository;

    /**
     * @var userStoreCreditsDetailsRepository
     */
    protected $userStoreCreditsDetailsRepository;

    /**
     * @var CirculationDiscountRepository
     */
    protected $circulationDiscountRepository;

    /**
     * @var InitialDiscountRepository
     */
    protected $intialDiscountRepository;

    /**
     * @var BookshelfOrderDetailsRepository
     */
    protected $bookshelfOrderDetailsRepository;

    /**
     * @var BookshelfOrderRepository
     */
    protected $bookshelfOrderRepository;

    /**
     * @var BookshelfOrderTrackingRepository
     */
    protected $bookshelfOrderTrackingRepository;

    /**
     * @var BookLibraryRepository
     */
    protected $bookLibraryRepository;

    function __construct(
        BookRepository $bookRepository,
        CirculationDiscountRepository $circulationDiscountRepository,
        InitialDiscountRepository $intialDiscountRepository,
        BookshelfOrderDetailsRepository $bookshelfOrderDetailsRepository,
        BookshelfOrderRepository $bookshelfOrderRepository,
        BookLibraryRepository $bookLibraryRepository,
        MerchantLibraryRepository $merchantLibraryRepository,
        MerchantMappingRepository $merchantMappingRepository,
        MerchantDetailsRepository $merchantDetailsRepository,
        BookshelfParentOrderRepository $bookshelfParentOrderRepository,
        BookshelfOrderTrackingRepository $bookshelfOrderTrackingRepository,
        UserStoreCreditsRepository $userStoreCreditsRepository,
        UserStoreCreditDetailsRepository $userStoreCreditsDetailsRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->circulationDiscountRepository = $circulationDiscountRepository;
        $this->initialDiscountRepository = $intialDiscountRepository;
        $this->bookshelfOrderDetailsRepository = $bookshelfOrderDetailsRepository;
        $this->bookshelfOrderRepository = $bookshelfOrderRepository;
        $this->bookLibraryRepository = $bookLibraryRepository;
        $this->merchantLibraryRepository = $merchantLibraryRepository;
        $this->merchantDetailsRepository = $merchantDetailsRepository;
        $this->merchantMappingRepository = $merchantMappingRepository;
        $this->bookshelfParentOrderRepository = $bookshelfParentOrderRepository;
        $this->bookshelfOrderTrackingRepository = $bookshelfOrderTrackingRepository;
        $this->userStoreCreditsRepository = $userStoreCreditsRepository;
        $this->userStoreCreditsDetailsRepository = $userStoreCreditsDetailsRepository;
    }

    // ==============================================Helper Functions========================================


    /**
     * Place Order
     */
    public function placeBookshelfOrderDetails($uid, $address_id, $items_count, $price, $payment_status) {
        date_default_timezone_set('Asia/Calcutta');
        $t = time();
        $date = date("Y-m-d H:i:s", $t);

        $post = $this->bookshelfOrderDetailsRepository->create(
                        array(
                            'user_id' => $uid,
                            'items_count' => $items_count,
                            'order_date' => $date,
                            'order_address_id' => $address_id,
                            'price' => $price,
                        )
                    );
        return $post['id'];
    }

    /**
     * Place Bookshelf Order
     */
    public function placeBookshelfOrder($parent_order_id, $uid, $isbn13, $book_id, $order_status=0, $inv_id=101, $mrp, $initial_payable=null) {
        $post = $this->bookshelfOrderRepository->
                    create(
                        array
                        (
                            'user_id' => $uid,
                            'ISBN13' => $isbn13,
                            'unique_book_id' => $book_id,
                            'inventory_id' => $inv_id,
                            'mrp' => $mrp,
                            'init_pay' => $initial_payable,
                            'order_status' => $order_status
                        )
                    );
        return $post['id'];
    }

    /**
     * Map BookshelfOrderID and ParentOrderID
     */
    public function mapParentBookShelfID($parent_order_id, $bookshelf_order_id) {
        $post = $this->bookshelfParentOrderRepository->
                    create(
                        array
                        (
                            'p_order_id' => $parent_order_id,
                            'bookshelf_order_id' => $bookshelf_order_id
                        )
                    );
        return $post['p_order_id'];
    }

    /**
     * Place Bookshelf Order Tracking
     */
    public function bookshelfOrderTrackingCreate($bookshelf_order_id, $date) {
        $post = $this->bookshelfOrderTrackingRepository->
                    create(
                        array
                        (
                            'bookshelf_order_id' => $bookshelf_order_id,
                            'new_delivery' => $date
                        )
                    );
        return $post['bookshelf_order_id'];
    }

    /**
     * Inventory ID Selector
     * @param ISBN13
     * @return inventory_id
     */
    public function getInventoryIDFromBookLib($isbn13='null', $lib_id='null') {
        if ($isbn13 != 'null') {
            $inventory_id = $this->bookLibraryRepository->findWhere(array('ISBN13' => $isbn13, 'book_id' => $lib_id))->getData(array('inv_id'));
            if (count($inventory_id) > 0) {
                return $inventory_id[0]['inv_id'];
            }
            return 101;
        }
    }

    /**
     * Inventory ID Selector
     * @param ISBN13
     * @return inventory_id
     */
    public function getInventoryIDFromMerchantLib($isbn13='null') {
        if ($isbn13 != 'null') {
            $merchant_id = $this->merchantLibraryRepository->findWhere(array('ISBN13' => $isbn13))->limited(1)->getData(array('merchant_id'));
            $inventory_id = $this->merchantMappingRepository->findWhere(array('merchant_id' => $merchant_id[0]['merchant_id']))->getData(array('inv_id'));
            if (count($inventory_id) > 0) {
                return $inventory_id[0]['inv_id'];
            }
            return 101;
        }
    }

    /**
     * Update Bookshelf Order Details
     * @param
     * @return
     */
    public function updateBookshelfOrderDetails(array $order_details) {
        // update bookshelf order details

        // setting the current time
        date_default_timezone_set('Asia/Calcutta');
        $t = time();
        $date = date("Y-m-d H:i:s", $t);

        $post = $this->bookshelfOrderDetailsRepository->
                    update(
                        array('p_order_id' => $order_details['parent_order_id']),
                        array(
                            'order_address_id' => $order_details['address_id'],
                            'order_date' => $date,
                            'store_discount' => $order_details['store_credit'],
                            'shipping_charge' => $order_details['shipping_price'],
                            'cod_charge' => $order_details['cod_charge'],
                            'net_pay' => $order_details['total_price'],
                            'payment_option' => 0,
                            'payment_status' => 1
                        )
                    );
        return $post;
    }

    /**
     * Update Bookshelf Order
     * @param
     * @return
     */
    public function updateBookshelfOrder($bookshelf_order_id, $store_credit, $shipping_price, $cod_charge=0, $date) {
        // setting the current time
        date_default_timezone_set('Asia/Calcutta');
        $t = time();
        $date = date("Y-m-d H:i:s", $t);

        $post = $this->bookshelfOrderRepository->
                    update(
                        array('bookshelf_order_id' => $bookshelf_order_id),
                        array(
                            'store_pay' => $store_credit,
                            'issue_date' => $date
                            // 'shipping_charge' => $shipping_price,
                            // '$cod_charge' => $cod_charge
                            )
                    );
    }

    /**
     * Post Store Credit
     */
    public function postStoreCreditDetails($user_id, $when, $why_id, $why_name, $parent_order_id, $store_credit) {
        // setting the current time
        date_default_timezone_set('Asia/Calcutta');
        $t = time();
        $date = date("Y-m-d H:i:s", $t);

        $this->userStoreCreditsDetailsRepository->
            create(
                array
                (
                    'user_id' => $user_id,
                    'parent_order_id' => $parent_order_id,
                    'when' => $date,
                    'why_name' => $why_name,
                    'store_credit' => $store_credit
                )
            );
    }

    // ====================================================API==============================================================


    /**
     * Post Order
     */
    public function postOrder() {
        // setting the current time
        date_default_timezone_set('Asia/Calcutta');
        $t = time();
        $date = date("Y-m-d H:i:s", $t);

        $success = 0;

        /**
         * JSON Object for cart
         */
        // "rental_cart":{"uid":20851, "address_id":345,"cart":[{"book_id":"LIBU3IR141120005","book_name":"The Deliberate Sinner","isbn13":"9789382665205","initial_payable":70,"mrp":"120","author":"Bhaavna Arora","book_library":1, "merchant_library":0},{"book_id":"LIB01IR131127126","book_name":"Hello, Bastar: The Untold Story of India's Maoist Movement","isbn13":"9789380658346","initial_payable":145,"mrp":"250.00","author":"Rahul Pandita","book_library":0, "merchant_library":1}], "total_price":500}
        $rental_cart = Input::get('rental_cart');
        $rental_cart = json_decode($rental_cart, true);

        // place parent order
        $parent_order_id = $this->placeBookshelfOrderDetails($rental_cart['uid'], $rental_cart['address_id'], count($rental_cart['cart']), $rental_cart['total_price'], 0);

        foreach ($rental_cart['cart'] as $key => $value) {
            if ($parent_order_id > 0) {
                if ($value['book_library'] == 1) {
                    $inventory_id = $this->getInventoryIDFromBookLib($value['isbn13'], $value['book_id']);
                    // return $inventory_id;
                }
                elseif ($value['merchant_library'] == 1) {
                    $merchant_inventory_id = $this->getInventoryIDFromMerchantLib($value['isbn13']);
                    // return $merchant_inventory_id;
                }
                if ($inventory_id > 0) {
                    $bookshelf_order_id = $this->placeBookshelfOrder($parent_order_id, $rental_cart['uid'], $value['isbn13'], $value['book_id'], $order_status=0, $inventory_id, $value['mrp'], $value['initial_payable']);
                }
                elseif ($merchant_inventory_id > 0) {
                    $bookshelf_order_id = $this->placeBookshelfOrder($parent_order_id, $rental_cart['uid'], $value['isbn13'], $value['book_id'], $order_status=11, $merchant_inventory_id, $value['mrp'], $value['initial_payable']);
                }
                // place an incomplete bookshelf order
                if ($bookshelf_order_id > 0) {
                    $parent_order_mapping = $this->mapParentBookShelfID($parent_order_id, $bookshelf_order_id);
                    // $tracking_details_mapping = $this->bookshelfOrderTrackingCreate($bookshelf_order_id, $date);
                    $success = 1;
                }
            }
        }
        if ($success == 1) {
            return $this->respond(
                            array(
                                'response' => 'Pre Order Successful',
                                'parent_order_id' => $parent_order_id
                                )
                            );
        }
        return $this->respondWithError(array('response' => 'Pre Order not placed'));
    }

    /**
     * Complete COD Order
     * @param cod order details
     * @return response
     */
    public function completeCODOrder() {
        // setting the current time
        date_default_timezone_set('Asia/Calcutta');
        $t = time();
        $date = date("Y-m-d H:i:s", $t);

        $success = 0;
        /**
         * JSON Object for completing order
         */
        // "order_details":{"uid":20851, "address_id":345,"parent_order_id":3,"cart":[{"book_id":"LIBU3IR141120005","book_name":"The Deliberate Sinner","isbn13":"9789382665205","initial_payable":70,"mrp":"120","author":"Bhaavna Arora","book_library":1, "merchant_library":0},{"book_id":"LIB01IR131127126","book_name":"Hello, Bastar: The Untold Story of India's Maoist Movement","isbn13":"9789380658346","initial_payable":145,"mrp":"250.00","author":"Rahul Pandita","book_library":0, "merchant_library":1}], "shipping_price":50,"cod_charge":10,"store_credit":40,"total_price":300}
        $order_details = Input::get('order_details');
        $order_details = json_decode($order_details, true);
        // return $order_details;

        $post_bookshelf_order_details = $this->updateBookshelfOrderDetails($order_details);
        // return $post_bookshelf_order_details;

        foreach ($order_details['cart'] as $key => $value) {
            if ($value['book_library'] == 1) {
                $book_lib_status = $this->bookLibraryRepository->
                        update(array('book_id' => $value['book_id']), array('status' => 2, 'last_circulated_on' => $date));
                // update Bookshelf Order
                $shipping_price = round(($value['initial_payable']/$order_details['total_price']) * $order_details['shipping_price']);
                $store_credit = round(($value['initial_payable']/$order_details['total_price'] * $order_details['store_credit']));
                $cod_charge = round($value['initial_payable']/$order_details['total_price'] * $order_details['cod_charge']);
            }
            $bookshelf_order_id = $this->bookshelfParentOrderRepository->findMultipleWhere(array('p_order_id' => $order_details['parent_order_id']))->getData(array('bookshelf_order_id'));
            foreach ($bookshelf_order_id as $key => $value) {
                $post_bookshelf_order = $this->updateBookshelfOrder($value['bookshelf_order_id'], $store_credit, $shipping_price, $cod_charge, $date);
                // $tracking_details_mapping = $this->bookshelfOrderTrackingCreate($bookshelf_order_id, $date);
                $success = 1;
            }
        }
        // post store credit details
        // $this->postStoreCreditDetails($user_id, $when, $why_id, $why_name, $parent_order_id, $store_credit);
        if ($success == 1) {
            return $this->respond(
                            array(
                                'response' => 'Order Fully Placed',
                                'parent_order_id' => $order_details['parent_order_id']
                                )
                            );
        }
        return $this->respondWithError(array('response' => 'Order Not Fully Placed'));
    }


    public function postPayumoneyOrder()
    {
        $key = 'gtKFFx';
        // $key = 'JBZaLc';
        $txnid = 'abc';
        $amount = 100;
        $salt = 'eCwWELxi';
        // $salt = 'GQs7yium';

        $product1 = [];
        $product1['name'] = 'abc';
        $product1['description'] = 'abcd';
        $product1['value'] = '100';
        $product1['isRequired'] = 'true';
        $product1['settlementEvent'] = 'EmailConfirmation';
        $product1_json =  json_encode($product1);

        $products = [];
        array_push($products, json_decode($product1_json));

        $products_info_array["paymentParts"] = $products;

        $products_info_json = json_encode($products_info_array);
        // return $products_info_json;
        $firstName = 'Amitabh Bachhan';
        $email = 'iamyatin@gmail.com';
        $phone = '9911199016';
        $surl = 'localhost:8000/payumoney/payment-success';
        $furl = 'localhost:8000/payumoney/payment-failure';

        $sha_string = $key . '|' . $txnid . '|' . $amount . '|' . $products_info_json . '|' . $firstName . '|'
                        . $email . '|||||' . '||||||' . $salt;

        $checksum = hash("sha512", $sha_string);
        $post_data = [];
        $post_data['key'] = $key;
        $post_data['txnid'] = $txnid;
        $post_data['amount'] = $amount;
        $post_data['productinfo'] = json_decode($products_info_json);
        $post_data['firstname'] = $firstName;
        $post_data['email'] = $email;
        $post_data['phone'] = $phone;
        $post_data['surl'] = $surl;
        $post_data['furl'] = $furl;
        $post_data['hash'] = $checksum;
        $post_data['service_provider'] = 'payu_paisa';
        // return json_encode($post_data);

        return $this->respond(array('data' => json_encode($post_data)));
    }

    public function postPaytmOrder() {

        // Import Cart
        /**
         * JSON Object for completing order
         */
        // "order_details":{"uid":20851, "address_id":345,"parent_order_id":3,"cart":[{"book_id":"LIBU3IR141120005","book_name":"The Deliberate Sinner","isbn13":"9789382665205","initial_payable":70,"mrp":"120","author":"Bhaavna Arora","book_library":1, "merchant_library":0},{"book_id":"LIB01IR131127126","book_name":"Hello, Bastar: The Untold Story of India's Maoist Movement","isbn13":"9789380658346","initial_payable":145,"mrp":"250.00","author":"Rahul Pandita","book_library":0, "merchant_library":1}], "shipping_price":50,"cod_charge":10,"store_credit":40,"total_price":300}

        $order_details = Input::get('order_details');
        $order_details = json_decode($order_details, true);
        // Post

        $paramList = array();
        $merchantKey = 'Si@7NDtSS6TcGj89'; //Key provided by Paytm
        $paramList["MID"] = "Indiar19809561994998"; // Merchant ID (MID) provided by Paytm
        $paramList["ORDER_ID"] = $order_details['parent_order_id']; // Merchant’s order id
        $paramList["CUST_ID"] = $order_detailsp['uid']; // Customer ID registered with merchant
        $paramList["TXN_AMOUNT"] = $order_details['total_price'];
        $paramList["CHANNEL_ID"] = "WEB";
        $paramList["INDUSTRY_TYPE_ID"] =  "Retail"; //Provided by Paytm
        $paramList["WEBSITE"] = "indiareads"; //Provided by Paytm

        $checksum = $this->getChecksumFromArrayForPaytm($paramList, $merchantKey);


        $paramList["CHECKSUMHASH"] = $checksum;

        return $this->respond(array('data' => $paramList));
    }

    public function postPaymentPaytm()
    {
        // Verify checksum
        $merchantKey = 'Si@7NDtSS6TcGj89';
        $paytmChecksum = Input::get("CHECKSUMHASH") ? Input::get("CHECKSUMHASH") : ""; //Sent by Paytm pg
        $isValidChecksum = $this->verifychecksum_e(Input::all(), $merchantKey, $paytmChecksum); //will return TRUE or FALSE string.
        if(Input::get("STATUS") == "TXN_SUCCESS") {
            // Success
            return 'success';
        }
        return 'fail';
    }


    public function getChecksumFromArrayForPaytm($arrayList, $key, $sort=1) {
        if ($sort != 0) {
            ksort($arrayList);
        }
        $str = $this->getArray2Str($arrayList);
        $salt = $this->generateSalt_e(4);
        $finalString = $str . "|" . $salt;
        $hash = hash("sha256", $finalString);
        $hashString = $hash . $salt;
        $checksum = $this->encrypt_e($hashString, $key);
        return $checksum;
    }

    private function getArray2Str($arrayList) {
        $paramStr = "";
        $flag = 1;
        foreach ($arrayList as $key => $value) {
            if ($flag) {
                $paramStr .= $this->checkString_e($value);
                $flag = 0;
            } else {
                $paramStr .= "|" . $this->checkString_e($value);
            }
        }
        return $paramStr;
    }

    public function checkString_e($value) {
        $myvalue = ltrim($value);
        $myvalue = rtrim($myvalue);
        if ($myvalue == 'null')
            $myvalue = '';
        return $myvalue;
    }

    public function generateSalt_e($length) {
        $random = "";
        srand((double) microtime() * 1000000);

        $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
        $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
        $data .= "0FGH45OP89";

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;
    }



    public function encrypt_e($input, $ky) {
        $key = $ky;
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
        $input = $this->pkcs5_pad_e($input, $size);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
        $iv = "@@@@&&&&####$$$$";
        mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = base64_encode($data);
        return $data;
    }

    public function decrypt_e($crypt, $ky) {

        $crypt = base64_decode($crypt);
        $key = $ky;
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
        $iv = "@@@@&&&&####$$$$";
        mcrypt_generic_init($td, $key, $iv);
        $decrypted_data = mdecrypt_generic($td, $crypt);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $decrypted_data = $this->pkcs5_unpad_e($decrypted_data);
        $decrypted_data = rtrim($decrypted_data);
        return $decrypted_data;
    }

    public function pkcs5_pad_e($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    public function pkcs5_unpad_e($text) {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text))
            return false;
        return substr($text, 0, -1 * $pad);
    }

    public function getChecksumFromArray($arrayList, $key, $sort=1) {
        if ($sort != 0) {
            ksort($arrayList);
        }
        $str = getArray2Str($arrayList);
        $salt = generateSalt_e(4);
        $finalString = $str . "|" . $salt;
        $hash = hash("sha256", $finalString);
        $hashString = $hash . $salt;
        $checksum = encrypt_e($hashString, $key);
        return $checksum;
    }

    public function verifychecksum_e($arrayList, $key, $checksumvalue) {
        $arrayList = $this->removeCheckSumParam($arrayList);
        ksort($arrayList);
        $str = $this->getArray2Str($arrayList);
        $paytm_hash = $this->decrypt_e($checksumvalue, $key);
        $salt = substr($paytm_hash, -4);

        $finalString = $str . "|" . $salt;

        $website_hash = hash("sha256", $finalString);
        $website_hash .= $salt;

        $validFlag = "FALSE";
        if ($website_hash == $paytm_hash) {
            return TRUE;
        } else {
            return FALSE;
        }

    }


    public function redirect2PG($paramList, $key) {
        $hashString = getchecksumFromArray($paramList);
        $checksum = encrypt_e($hashString, $key);
    }

    public function removeCheckSumParam($arrayList) {
        if (isset($arrayList["CHECKSUMHASH"])) {
            unset($arrayList["CHECKSUMHASH"]);
        }
        return $arrayList;
    }

    public function getTxnStatus($requestParamList) {
        return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
    }

    public function initiateTxnRefund($requestParamList) {
        $CHECKSUM = getChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY,0);
        $requestParamList["CHECKSUM"] = $CHECKSUM;
        return callAPI(PAYTM_REFUND_URL, $requestParamList);
    }

    public function callAPI($apiURL, $requestParamList) {
        $jsonResponse = "";
        $responseParamList = array();
        $JsonData =json_encode($requestParamList);
        $postData = 'JsonData='.urlencode($JsonData);
        $ch = curl_init($apiURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($postData))
        );
        $jsonResponse = curl_exec($ch);
        $responseParamList = json_decode($jsonResponse,true);
        return $responseParamList;
    }






// {"uid": 20851, "address_id": 567, "book_details": [{"isbn13": 9789382665205, "rent_duration": 30}]}
}
