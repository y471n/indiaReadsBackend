<?php

namespace App\Http\Controllers;

use App\IndiaReads\Repository\Eloquent\UserAddressBookRepository;
use App\IndiaReads\Repository\Eloquent\UserInfoRepository;
use App\IndiaReads\Repository\Transformers\AddressTransformer;
use App\IndiaReads\Repository\Transformers\CreditTransformer;
use App\IndiaReads\Repository\Eloquent\UserStoreCreditsRepository;
use App\IndiaReads\Repository\Eloquent\UserStoreCreditDetailsRepository;
use App\IndiaReads\Repository\Transformers\UserProfileTransformer;
use App\IndiaReads\Repository\Eloquent\BookshelfOrderDetailsRepository;
use App\IndiaReads\Repository\Eloquent\BookshelfOrderRepository;
use App\IndiaReads\Repository\Eloquent\BookshelfParentOrderRepository;
use App\IndiaReads\Repository\Eloquent\BookshelfOrderTrackingRepository;


use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;

class ProfileController extends ApiController
{

    /**
     * @var UserAddressBookRepository
     */
    protected $addressRepository;

    /**
     * @var AddressTransformer
     */
    protected $addressTransformer;

    /**
     * @var UserStoreCreditsRepository
     */
    protected $userStoreCreditsRepository;

    /**
     * @var UserStoreCreditDetailsRepository
     */
    protected $userStoreCreditsDetailsRepository;

    /**
     * @var UserInfoRepository
     */
    protected $userInfoRepository;

    /**
     * @var CreditTransformer
     */
    protected $creditTransformer;

    /**
     * @var UserProfileTransformer
     */
    protected $userProfileTransformer;

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
     * @var BookshelfParentOrderRepository
     */
    protected $bookshelfParentOrderRepository;

    function __construct(
        UserAddressBookRepository $addressRepository,
        AddressTransformer $addressTransformer,
        UserStoreCreditsRepository $userStoreCreditsRepository,
        UserStoreCreditDetailsRepository $userStoreCreditsDetailsRepository,
        CreditTransformer $creditTransformer,
        userInfoRepository $userInfoRepository,
        UserProfileTransformer $userProfileTransformer,
        BookshelfOrderRepository $bookshelfOrderRepository,
        BookshelfOrderDetailsRepository $bookshelfOrderDetailsRepository,
        BookshelfParentOrderRepository $bookshelfParentOrderRepository,
        BookshelfOrderTrackingRepository $bookshelfOrderTrackingRepository
    ) {
        $this->addressRepository = $addressRepository;
        $this->addressTransformer = $addressTransformer;
        $this->userStoreCreditsRepository = $userStoreCreditsRepository;
        $this->userStoreCreditsDetailsRepository = $userStoreCreditsDetailsRepository;
        $this->creditTransformer = $creditTransformer;
        $this->userInfoRepository = $userInfoRepository;
        $this->userProfileTransformer = $userProfileTransformer;
        $this->bookshelfOrderRepository = $bookshelfOrderRepository;
        $this->bookshelfOrderDetailsRepository = $bookshelfOrderDetailsRepository;
        $this->bookshelfParentOrderRepository = $bookshelfParentOrderRepository;
        $this->bookshelfOrderTrackingRepository = $bookshelfOrderTrackingRepository;
    }

    /**
     * Check For user authentication
     * @param $token
     * @return User authenticated or not
     */
    private function checkForUserAuthentication($token)
    {
        try {
            $payload = JWTAuth::getPayload($token);
        } catch (\Exception $e) {
            // May have expired
            return false;
        }

        // Check for expiry
        $now = Carbon::now();
        $now_seconds = $now->timestamp;
        if($payload['exp'] >= $now_seconds) {
            return $payload['sub'];
        }

        return false;
    }

    /**
     * v1-done
     * Get User Address
     * @param none
     * @return user addresses
     */
    public function getUserAddress() {
        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if ($user_id) {
            $data = $this->addressRepository->findWhere(array('user_id' => $user_id))->getData();
            if (count($data) > 0) {
                $user_addresses = $this->addressTransformer->transformCollection($data->toArray());
                return $this->respond(array('data' => $user_addresses));
            }
            return $this->respond(array('data' => []));
        }
        return $this->respondNotAuthorized();
    }

    /**
     * Add user address
     * @param list of all the fields
     * @return success message
     */
    public function addUserAddress()
    {
        $token = Input::get('auth_token');
        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if ($user_id) {
            $fullname = Input::get('fullname');
            $address_line1 = Input::get('address_line1');
            $address_line2 = Input::get('address_line2');
            $city = Input::get('city');
            $state = Input::get('state');
            $pincode = Input::get('pincode');
            $phone = Input::get('phone');

            if ($fullname != null && $address_line1 != null && $city != null && $state != null && $pincode != null && $phone != null) {
                $post = $this->addressRepository->create(
                            array(
                                    'user_id' => $user_id,
                                    'fullname' => $fullname,
                                    'address_line1' => $address_line1,
                                    'address_line2' => $address_line2,
                                    'city' => $city,
                                    'state' => $state,
                                    'pincode' => $pincode,
                                    'phone' => $phone
                            )
                        );
                if ($post['id'] > 0) {
                    return $this->respond(
                        array(
                            'response' => 'Successful',
                            'data' => $post['id']
                            )
                        );
                }
                else {
                    return $this->respond(
                        array(
                            'response' => 'Not Successful',
                            'data' => []
                            )
                        );
                }
            }
            return $this->respond(array('response' => 'Specify all the params!!!'));
        }
        return $this->respondNotAuthorized();
    }

    /**
     * Edit user address
     * @param all the address fields
     * @return response
     */
    public function editUserAddress() {
        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if ($user_id) {
            $address_book_id = Input::get('address_book_id');
            $fullname = Input::get('fullname');
            $address_line1 = Input::get('address_line1');
            $address_line2 = Input::get('address_line2');
            $city = Input::get('city');
            $state = Input::get('state');
            $pincode = Input::get('pincode');
            $phone = Input::get('phone');
            if ($address_book_id != null && $fullname != null && $address_line1 != null && $city != null && $state != null && $pincode != null && $phone != null) {
                $post = $this->addressRepository->update(
                                    array('address_book_id' => $address_book_id),
                                    array(
                                        'user_id' => $user_id,
                                        'fullname' => $fullname,
                                        'address_line1' => $address_line1,
                                        'address_line2' => $address_line2,
                                        'city' => $city,
                                        'state' => $state,
                                        'pincode' => $pincode,
                                        'phone' => $phone
                                    )
                                );
                if (count($post) > 0) {
                     return $this->respond(
                                array(
                                    'response' => 'success',
                                    'data' => $post
                                )
                            );
                }
                else {
                    return $this->respond(
                                array(
                                    'response' => 'Not Successful',
                                    'data' => []
                                )
                            );
                }
            }
            return $this->respond(array('data' => 'Specify all the params!!'));
        }
        return $this->respondNotAuthorized();
    }

    /**
     * Get User Profile Details
     * @param none
     * @return user profile
     */
    public function getUserProfile()
    {
        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        // $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if ($user_id) {
            $data = $this->userInfoRepository->findWhere(array('user_id' => $user_id))->getData();
            if (count($data) > 0) {
                $user_profile = $this->userProfileTransformer->transformCollection($data->toArray());
                return $this->respond(array('data' => $user_profile));
            }
            return $this->respond(array('data' => []));
        }
        return $this->respondNotAuthorized();
    }

    /**
     * Add user profile
     * @param profile details
     * @return response
     */
    public function addUserProfile() {
        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if ($user_id) {
            $first_name = Input::get('first_name');
            $last_name = Input::get('last_name');
            $alternate_email = Input::get('alternate_email');
            $birthdate = Input::get('birthdate');
            $gender = Input::get('gender');
            $mobile = Input::get('mobile');
            $landline = Input::get('landline');
            if ($first_name != null && $last_name != null && $alternate_email != null && $birthdate != null && $gender != null && $landline != null) {
                $post = $this->userInfoRepository->create(
                                                          array(
                                                                'user_id' => $user_id,
                                                                'first_name' => $first_name,
                                                                'last_name' => $last_name,
                                                                'alternate_email' => $alternate_email,
                                                                'birthdate' => $birthdate,
                                                                'gender' => $gender,
                                                                'mobile' => $mobile,
                                                                'landline' => $landline
                                                                )
                                                    );
                if ($post['id'] > 0) {
                    return $this->respond(array('response' => 'success'));
                }
                else {
                    return $this->respond(array('response' => 'Not Successful'));
                }
            }
            return $this->respond(array('data' => ['Specify all the params!!']));
        }
        return $this->respondNotAuthorized();
    }

    /**
     * Edit User Profile
     * @param profile details
     * @return response
     */
    public function editUserProfile() {
        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if ($user_id) {

            $first_name = Input::get('first_name');
            $last_name = Input::get('last_name');
            $alternate_email = Input::get('alternate_email');
            $birthdate = Input::get('birthdate');
            $gender = Input::get('gender');
            $mobile = Input::get('mobile');
            $landline = Input::get('landline');

            if (($first_name != null) && ($last_name != null) && ($alternate_email != null)
                && ($birthdate != null) && ($gender != null) && ($landline != null)) {
                $post = $this->userInfoRepository->update(
                                                array('user_id' => $user_id),
                                                array(
                                                      'user_id' => $user_id,
                                                      'first_name' => $first_name,
                                                      'last_name' => $last_name,
                                                      'alternate_email' => $alternate_email,
                                                      'birthdate' => $birthdate,
                                                      'gender' => $gender,
                                                      'mobile' => $mobile,
                                                      'landline' => $landline
                                                      )
                                                );
                if ($post != null) {
                     return $this->respond(array('response' => 'success'));
                }
                else {
                    return $this->respond(array('response' => 'Not Successful'));
                }
            }
            return $this->respond(array('data' => ['Specify all the params!!']));
        }
        return $this->respondNotAuthorized();
    }

    /**
     * Get all orders of a user
     * @param
     * @return
     */
    public function getAllOrders() {
        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if ($user_id) {

            $orders = array();
            $order = array();

            $this->bookshelfOrderDetailsRepository->resetModel();

            // get all parent orders of a user
            $parent_order_details = $this->bookshelfOrderDetailsRepository->limited(10)->
                                    findMultipleWhere(array('user_id' => $user_id))->getData(array('*'));
            // return $parent_order_details;
            foreach ($parent_order_details as $key => $value) {
                $this->bookshelfParentOrderRepository->resetModel();
                $bookshelf_orders = $this->bookshelfParentOrderRepository->
                        findMultipleWhere(array('p_order_id' => $value['p_order_id']))->
                        getData(array('bookshelf_order_id'));
                if (count($bookshelf_orders) > 0) {
                    $i = 0;
                    foreach ($bookshelf_orders as $border => $boid) {
                        $this->bookshelfOrderRepository->resetModel();
                        $bookshelf_order_details = $this->bookshelfOrderRepository->
                                findWhere(array('bookshelf_order_id' => $boid['bookshelf_order_id']))->getData(array('*'));
                        if (count($bookshelf_order_details) > 0) {
                            $order[$i] = $bookshelf_order_details;
                            $i++;
                        }
                        else {
                            $order[$i] = ["no details available"];
                            $i++;
                        }
                    }
                    $order['parent_order_details'] = $value;
                    array_push($orders, $order);
                }
                else {
                    $order['bookshelf_order_details'] = [];
                    array_push($orders, $order);
                }
            }
            return $this->respond(array('data' => $orders));
        }
    }

    /**
     * Get User Store Credits
     */
    public function getStoreCredits() {
        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if ($user_id) {
            $store_credits = $this->userStoreCreditsRepository->findMultipleWhere(array('user_id' => $user_id))->getData(array('*'));
            if (count($store_credits) > 0) {
                return $this->respond(array('data' => $store_credits));
            }
            return $this->respond(array('data' => []));
        }
        return $this->respondNotAuthorized();
    }

    /**
     * Get Store Credits
     */
    public function getStoreCreditDetails() {
        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if ($user_id) {
            $store_credit_details = $this->userStoreCreditsDetailsRepository->findMultipleWhere(array('user_id' => $user_id))->getData(array('*'));
            if (count($store_credit_details) > 0) {
                return $this->respond(array('data' => $store_credit_details));
            }
            return $this->respond(array('data' => []));
        }
        return $this->respondNotAuthorized();
    }
}
