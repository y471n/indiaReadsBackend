<?php

namespace App\Http\Controllers;
use DB;
use App\IndiaReads\Repository\Eloquent\UserRepository;
use App\IndiaReads\Repository\Eloquent\CorporateUserMappingRepository;
use App\IndiaReads\Repository\Eloquent\CompanyDetailsRepository;
use App\Http\Requests;
use App\IndiaReads\Repository\Transformers\UserTransformer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use Carbon\Carbon;
use Mail;
use GuzzleHttp;
use Laracurl;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends ApiController
{


    /**
     * @var UserRepository
     */
    protected $userRepository;
    protected $userTransformer;
    protected $jwtAuth;
    protected $corporateUserMappingRepository;
    protected $companyDetailRepository;

    /**
     * @param UserRepository $userRepository
     */
    function __construct(UserRepository $userRepository, UserTransformer $userTransformer,
        CorporateUserMappingRepository $corporateUserMappingRepository, CompanyDetailsRepository $companyDetailRepository)
    {
        $this->userRepository = $userRepository;
        $this->userTransformer = $userTransformer;
        $this->corporateUserMappingRepository = $corporateUserMappingRepository;
        $this->companyDetailRepository = $companyDetailRepository;
    }

    /**
     * Check wether User is Logged In or not
     * @param Session::get('uid')
     */
    public function checkUserLoggedIn() {
        $user_id = session('uid');
        if ($user_id != null)
            return true;
        return false;
    }

    public function getUserDetails()
    {
        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if ($user_id) {
            return $user_id;
        }
        return $this->respondNotAuthorized();
    }

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

    private function generateTestPayload($payload)
    {
        $test_payload = JWTFactory::sub($payload['sub'])
                            ->aud('sub')->sub($payload['sub'])
                            ->aud('type')->type($payload['type'])
                            ->iss->iss($payload['iss'])
                            ->aud('iat')->iat($payload['iat'])
                            ->aud('exp')->exp($payload['exp'])
                            ->aud('nbf')->nbf($payload['nfb'])
                            ->aud('jti')->sub($payload['jti'])
                            ->make();
        return $test_payload;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postCreate()
    {
        $validator = Validator::make(Input::all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return $this->respondWithError("validation_failed");
        }

        if($this->userRepository->create(
                array('user_email' => Input::get('email'),
                'new_password' => bcrypt(Input::get('password'))
                ))
        ) {
            return$this->respond(array('message' => 'success'));
        }
        return $this->respondInternalError();
    }

    /**
     * Login and return message;
     */
    public function postLogin()
    {

        $email = Input::get('email');
        $user_data = $this->userRepository->findWhere(array('user_email' => $email))->getData();
        if(count($user_data)>0) {
            // return $user_data[0];
            // Found user;
            if($this->checkForPassword($user_data[0], Input::get('password'))) {
                // Check for user active
                if($user_data[0]['user_status'] != 1) {
                    // User inactive
                    return $this->responseForInactiveUser($user_data[0]);
                }
                // Check for user role: for corporate admin
                // Check for user type: retail or corporate
                return $this->responseAccordingToUserRole($user_data[0]);
            }
            return $this->respondWithError('invalid_credentials');
        }
        return $this->respondWithError('invalid_credentials');
    }

     /**
     * Reset Password
     * @param email
     * @return email response
     */
    public function resetPassword() {
        $email = Input::get('email');
        if ($email != null) {
            $user_data = $this->userRepository->findWhere(array('user_email' => $email))->getData();
            if (count($user_data) > 0) {
                $this->resetMail($email);
                return $this->respond(array('response' => 'success'));
            }
            else {
                return $this->respond(array('response' => 'no_user'));
            }
        }
        return $this->respond(array('response' => 'Provide the email first!'));
    }

    private function responseAccordingToUserRole($user)
    {
        $user_d = ['id' => $user['user_id']];

        // Retail user
        $user_d['type'] = 'r';

        $corporate_user = $this->corporateUserMappingRepository->findWhere(array('user_id' => $user['user_id']))->getData();
        $user_d['company_name'] = '';
        if(count($corporate_user)>0) {
            // It is a corporate user
            $user_d['type'] = 'c';
            $user_d['company_name'] = $this->getCompanyUrlForUser($corporate_user[0]);
        }

        $payload = JWTFactory::sub($user['user_id'])->aud('type')->type($user_d['type'])
                    ->aud('company_name')->company_name($user_d['company_name'])->make();
        // $payload = JWTFactory::make($user_d);
        $token = JWTAuth::encode($payload);
        // $token
        return $this->respond(array('token'=>strval($token), 'email' => $user['user_email'],
            'user_id' => $user['user_id'], 'company_name' => $user_d['company_name']) );
    }

    private function getCompanyUrlForUser($corporate_user)
    {
        $company_detail = $this->companyDetailRepository->findWhere(array('company_id' => $corporate_user['company_id']))->getData();
        return $company_detail[0]['company_name'];
    }

    private function responseForInactiveUser($user)
    {
        switch ($user['user_status']) {
            case 0:
                return $this->respondWithError('deleted_user');
                break;
            case 2:
                return $this->respondWithError('inactive_user');
                break;
            default:
                return $this->respondWithError('unknown_error');
                break;
        }
    }

    /**
     * @param $model
     * @param $input_password
     * @return bool
     */
    protected function checkForPassword($model, $input_password)
    {
        if($model['new_password'] != null) {
            if($this->checkForNewPassword($model['new_password'], $input_password)) {
                return true;
            }
        } else {
            if($this->checkForOldPassword($model['user_password'], $input_password)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $database_password
     * @param $input_password
     * @return bool
     */
    protected function checkForNewPassword($database_password, $input_password) {
        if(Hash::check($input_password, $database_password)) {
            return true;
        }
        return false;
    }


    public function postNewPassword()
    {
        $email = Input::get('email');
        $hash = Input::get('h');
        $new_password = Input::get('new_pass');
        $new_pass_hash = Hash::make($new_password);

        // $this->userRepository->resetModel();
        $user_data  = $this->userRepository->findWhere(array('user_email' => $email,
                'new_password'=> $hash))->getData();

        if(count($user_data) > 0) {

            // $this->userRepository->update(array('user_email' => $email),
            //     array('new_password' => $new_pass_hash), array('user_status' => 1));
            // return $this->respond(array('message' => 'success'));

            $data =array(
                        'user_password'=>$new_pass_hash,
                        'new_password'=>'',
                        'user_status'=>1
                    );
                    if(DB::table('user_login')->where('user_email',$email)->update($data)){
                       return $this->respond(array('message' => 'success'));
                    }
        }

        return $this->respondNotAuthorized();
    }

    /*
        Accepts an email address
    */
    public function postSignup()
    {
        $email = Input::get('email');

        $user_data = $this->userRepository->findWhere(array('user_email' => $email))->getData();
        if(count($user_data) > 0) {
            // User already exists
            return $this->respondWithError('user_exists_already');
        }

        $this->userRepository->resetModel();

        // Create new user
        return $this->createNewUser($email);
        // return $this->respond(array('message' => 'success'));
    }

    protected function createNewUser($email)
    {
        $random_password = Hash::make($this->generateRandomString());
        $this->userRepository->create(array('user_email' => $email,
                'new_password' => $random_password));


        $content['email'] = $email;
        $content['link'] = 'http://localhost:8000/set-password?email='.$email.'&h='.$random_password;
        // Send confirmation mail for password change
        Mail::send('emails.postsignup',
            ['content' => $content],
            function ($m) use ($content) {
                $m->to($content['email'], 'User Hello')->subject('Yo! Thank you for signing up');
            }
        );
        $this->userRepository->resetModel();
        $user_row = $this->userRepository->findWhere(array('user_email' => $email))->getData();
        return $this->responseAccordingToUserRole($user_row[0]);

    }

    /**
     * Send Mail
     */
    public function resetMail($email) {
        $random_password = Hash::make($this->generateRandomString());
        $content['email'] = $email;
        $content['link'] = 'http://localhost:8000/set-password?email='.$email.'&h='.$random_password;
        $data =array(
            'new_password'=>$random_password
        );
        DB::table('user_login')->where('user_email',$email)->update($data);
        // Send confirmation mail for password change
        Mail::send('emails.postsignup',
            ['content' => $content],
            function ($m) use ($content) {
                $m->to($content['email'], 'User Hello')->subject('Yo! Password reset krle be!!!');
            }
        );
    }

    private function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param $database_password
     * @param $input_password
     * @param $salt
     * @return bool
     */
    protected function checkForOldPassword($database_password, $input_password) {
        // if(hash("sha256", $input_password.$salt) == $database_password) {
        //     return true;
        // }
        if(Hash::check($input_password, $database_password)) {
            return true;
        }
        return false;
    }

    public function facebookLogin()
    {
        $facebook_code = Input::get('code');

        try {
        // Get Access token
        $url = 'https://graph.facebook.com/v2.3/oauth/access_token';
        $fb_token_url = Laracurl::buildUrl('https://graph.facebook.com/v2.3/oauth/access_token',
                    ['code' => $facebook_code, 'client_id' => '1620908248161467',
                    'redirect_uri' => 'http://localhost:8000/', 'client_secret' => '1be4494074f5cbc3519b7165c0891a45']);
        $fb_token_data = Laracurl::get($fb_token_url);
        $fb_access_token = json_decode($fb_token_data, true)['access_token'];


        $info_url = Laracurl::buildUrl('https://graph.facebook.com/me',
                    ['access_token' => $fb_access_token, 'fields' => 'id,name,email' ]);

        $info_data = Laracurl::get($info_url);
        $info_data_email = json_decode($info_data->body, true)['email'];

        } catch (RequestException $e) {

            // Catch all 4XX errors

            // To catch exactly error 400 use
            if ($e->getResponse()->getStatusCode() == '400') {
                    echo "Got response 400";
                    return $this->respond(array('data' => '400'));
            }

            // You can check for whatever error status code you need

        } catch (\Exception $e) {
            return $this->respondWithError(array('datas' => $e));
            // There was another exception.

        }


        // Check if User exists already in db;
        $user_row = $this->userRepository->findWhere(array('user_email' => $info_data_email))->getData();
        if(count($user_row) > 0) {
            // Login and send token if exists;
            return $this->responseAccordingToUserRole($user_row[0]);
        } else {
            // else signup; send email; send token
            $this->userRepository->resetModel();
            return $this->createNewUser($info_data_email);
            // return $this->respond(array('data' => 's'));
        }

    }

    public function googleLogin()
    {
        $google_code = Input::get('code');
        $client = new GuzzleHttp\Client();

        try {
        // Get Access token
        $url = 'https://www.googleapis.com/oauth2/v3/token';
        $response = Laracurl::post($url, [
                'code' => $google_code,
                'client_id' => '633824688387-3fkt2h8l2i350v7ev5gvjc0d5qluoanj.apps.googleusercontent.com',
                'client_secret' => 'tHv0yZIBL52gG6vC0ga9v4cn',
                'redirect_uri' => 'http://localhost:8000',
                'grant_type' => 'authorization_code'
                ]);

        $access_token = json_decode($response->body, true)['access_token'];

        $info_url = Laracurl::buildUrl('https://www.googleapis.com/userinfo/v2/me',
                    ['access_token' => $access_token]);

        $info_data = Laracurl::get($info_url);
        $info_data_email = json_decode($info_data->body, true)['email'];

        $info_data = Laracurl::get($info_url);
        $info_data_email = json_decode($info_data->body, true)['email'];


        } catch (RequestException $e) {

            // Catch all 4XX errors

            // To catch exactly error 400 use
            if ($e->getResponse()->getStatusCode() == '400') {
                    echo "Got response 400";
                    return $this->respond(array('data' => '400'));
            }

            // You can check for whatever error status code you need

        } catch (\Exception $e) {
            return $this->respondWithError(array('datas' => $e));
            // There was another exception.

        }

        // Check if User exists already in db;
        $user_row = $this->userRepository->findWhere(array('user_email' => $info_data_email))->getData();
        if(count($user_row) > 0) {
            // Login and send token if exists;
            return $this->responseAccordingToUserRole($user_row[0]);
        } else {
            // else signup; send email; send token
            $this->userRepository->resetModel();
            return $this->createNewUser($info_data_email);
            // return $this->respond(array('data' => 's'));
        }
        // return $this->respond(array('data' => $res->getBody()));
    }

}
