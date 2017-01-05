<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\IndiaReads\Repository\Eloquent\BookshelfOrderRepository;
use App\IndiaReads\Repository\Eloquent\BookshelfRepository;
use App\IndiaReads\Repository\Transformers\BookshelfTransformer;
use App\IndiaReads\Repository\Eloquent\UserRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Mail;


class BookshelfController extends ApiController
{

    /**
     * @var BookshelfRepository
     */
    protected $bookshelfRepository;

    /**
     * @var BookshelfOrderRepository
     */
    protected $bookshelfOrderRepository;

    /**
     * @var BookshelfTransformer
     */
    protected $bookshelfTransformer;

    protected $userRepository;

    /**
     * @param BookshelfOrderRepository $bookshelfOrderRepository
     */
    function __construct(BookshelfOrderRepository $bookshelfOrderRepository,
        BookshelfRepository $bookshelfRepository, BookshelfTransformer $bookshelfTransformer,
        UserRepository $userRepository) {
        $this->bookshelfOrderRepository = $bookshelfOrderRepository;
        $this->bookshelfRepository = $bookshelfRepository;
        $this->bookshelfTransformer = $bookshelfTransformer;
        $this->userRepository = $userRepository;
    }

    //  ===========================Helper Functions=================================

    /**
     *  Check for user authentication
    * @param token
    * @return user related fields, if authenticated; else false
    */
    private function checkForUserAuthentication($token) {
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
     * Add to Available Shelf
     */
    public function addToAvailable($user_id, array $book) {
        if ($book) {
            $post = $this->bookshelfRepository->create(
                        array(
                                'user_id' => $user_id,
                                'ISBN13' => $book['isbn13'],
                                'shelf_type' => 1,
                                'init_pay' => $book['init_pay'],
                                'title' => $book['title'],
                                'contributor_name1' => $book['author']
                        )
                    );
            return $post;
        }
    }


    /**
     * Add to Available Shelf
     */
    public function addToWishlist($user_id, array $book) {
        if ($book) {
            $post = $this->bookshelfRepository->create(
                        array(
                              'user_id' => $user_id,
                              'ISBN13' => $book['isbn13'],
                              'shelf_type' => 2,
                              'init_pay' => $book['init_pay']
                        )
                    );
            return $post;
        }
    }

    /**
     * Add to Current Reading Shelf
     */
    public function updateToCurrentReading($user_id, array $book) {
        $post = $this->bookshelfRepository->update(array('user_id' => $user_id, 'ISBN13' => $book['isbn13']), array('shelf_type' => 3));
        return $post;
    }

    /**
     * Add to Reading History Shelf
     */
    public function updateToReadingHistory($user_id, array $book) {
        $post = $this->bookshelfRepository->update(array('user_id' => $user_id, 'ISBN13' => $book['isbn13']), array('shelf_type' => 4));
        return $post;
    }

    // =================================APIs=====================================

    /**
     * v1-done
     * get available books
     * @param none
     * @return available books
     */
    public function getAvailableBookshelfList() {
        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if($user_id) {
            $data = $this->bookshelfRepository->findMultipleWhere(array('user_id' => $user_id,
                'shelf_type' => 1))->getData(array('*'));
        // return $data;
            if (count($data) > 0) {
                $available_books = $this->bookshelfTransformer->transformCollection($data->toArray());
                // return $available_books;
                return $this->respond(array('data' => $available_books));
            }
            return $this->respond(array('data' => []));
        }
        return $this->respondNotAuthorized();
    }

    /**
     * v1-done
     * get currently reading books
     * @param none
     * @return currently reading books
     */
    public function getCurrentlyReading() {
        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if($user_id) {
            $data = $this->bookshelfRepository->findMultipleWhere(array('user_id' => $user_id,
                'shelf_type' => 3))->getData(array('*'));
            if (count($data) > 0) {
                $currently_reading = $this->bookshelfTransformer->transformCollection($data->toArray());
                return $this->respond(array('data' => $currently_reading));
            }
            return $this->respond(array('data' => []));
        }
        return $this->respondNotAuthorized();
    }

    /**
     * v1-done
     * get reading history
     * @param none
     * @return reading history
     */
    public function getReadingHistoryBookshelfList() {
        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if($user_id) {
            $data = $this->bookshelfRepository->findMultipleWhere(array('user_id' => $user_id,
                'shelf_type' => 4))->getData(array('*'));
            if (count($data) > 0) {
                $reading_history = $this->bookshelfTransformer->transformCollection($data->toArray());
                return $this->respond(array('data' => $reading_history));
            }
            return $this->respond(array('data' => []));
        }
        return $this->respondNotAuthorized();
    }

    /**
     * v1-done
     * get wishlist books
     * @param none
     * @return wishlist books
     */
    public function getWishlistBookshelfList() {
        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if($user_id) {
            $data = $this->bookshelfRepository->findMultipleWhere(array('user_id' => $user_id,
                'shelf_type' => 2))->getData(array('*'));
            if (count($data) > 0) {
                $wishlist = $this->bookshelfTransformer->transformCollection($data->toArray());
                return $this->respond(array('data' => $wishlist));
            }
            return $this->respond(array('data' => []));
        }
        return $this->respondNotAuthorized();
    }

    /**
     * v1-done
     * Add to Bookshelf
     * @param {isbn13, title, author, availability_status}
     * @return id
     */
    public function addToBookshelf() {
        // "books":{"book_details":{"isbn13":9788129135728, "title":"Half Girlfriend", "author":"Chetan Bhagat", "availability_status":1,"init_pay":50}}


        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if ($user_id) {
            $data = Input::get('books');
            $status = $this->addBookshelfForUser($user_id, $data);
            if ($status) {
                return $this->respond(array('data' => 'Added Succesfully'));
            }
            return $this->respondWithError(array('data' => "Not Added!!!"));
        }
        return $this->respondNotAuthorized();
    }

    protected function addBookshelfForUser($user_id, $data) {
        $result = array();
        if ($user_id) {
            $data = json_decode($data, true);
            foreach ($data as $key => $value) {
                if ($value['availability_status'] == 1) {
                    // add to available
                    $post = $this->addToAvailable($user_id, $value);
                    array_push($result, $post['id']);
                    return $this->respond(array('id' => $result));
                }
                elseif ($value['availability_status'] == 0) {
                    // add to wishlist
                    $post = $this->addToWishlist($user_id, $value);
                    array_push($result, $post['id']);
                    return $this->respond(array('id' => $result));
                }
                // Do Not add the book due to lack of information
                return 'Availabilty status not found!!!';
            }
        }
    }

    public function notifyWhenAvailable() {
        $email = Input::get('email');
        $data = Input::get('books');
        // return '$data';
        $user_data = $this->userRepository->findWhere(array('user_email' => $email))->getData();
        if(count($user_data) > 0) {
            // User already exists; Add to Bookshelf and return
            return $this->addBookshelfForUser($user_data[0]['user_id'], $data);
        }
        // Create user; Add to Bookshelf
        $this->userRepository->resetModel();
        $new_user_id = $this->createNewUser($email);
        return $this->addBookshelfForUser($new_user_id, $data);
    }

    public function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
        return $user_row[0]["user_id"];
    }


    /**
     * v1-done
     * Update Bookshelf
     * @param [{isbn13, shelf_type}]
     * @return id
     */
    public function updateBookShelf() {
         // "books":{"isbns":[{"isbn13":9788129135728,"shelf_type":1}, {"isbn13":9788129135728,"shelf_type":3}]}
        $result = array();

        $token = Input::get('auth_token');
        $user_id = $this->checkForUserAuthentication($token);
        if ($user_id) {
            $data = Input::get('books');
            $data = json_decode($data, true);
            foreach ($data['isbns'] as $key => $value) {
                if ($value['shelf_type'] == 1) {
                    // move to current reading
                    $post = $this->updateToCurrentReading($user_id, $value);
                    array_push($result, $post);
                }
                elseif ($value['shelf_type'] == 3) {
                    // move to reading history
                    $post = $this->updateToReadingHistory($user_id, $value);
                    array_push($result, $post);
                }
                else
                    return 'Shelf Type Not Found!!!';
            }
            return $this->respond(array('data' => $result));
        }
        return $this->respondNotAuthorized();
    }

    /*
     * Fetch rent based on order status
     * @param array(isbns), user_id
     * @return array(rent)
     */
    // public function getPayableRent(Request $request) {
    //     $user_id = $request->input('user_id');
    //     $isbns = $request->input('isbns');

    //     $bookshelf_order_entries = getBookshelfOrderEntries();

    //     if(verifyAllBooksForReturn($bookshelf_order_entries)) {
    //         $dispatched_dates = [];
    //         foreach ($bookshelf_order_entries as $key => $value) {
    //             array_push($dispatched_dates, $this->bookshelfOrderTrackingRepository->findWhere(array('bookshelf_order_id' => $value), array('dispatched')));
    //         }
    //         $rentArray = getRents($dispatched_dates);
    //         return $rentArray;
    //     }

    //     return $this->respondInvalidInputData();
    // }

    // protected function getBookshelfOrderEntries($user_id, $isbns) {
    //     $bookshelf_order_entries = [];
    //     $bookshelf_order_ids = [];
    //     foreach ($isbns as $key => $value) {
    //         $bookshelf_order_entry = $this->bookshelfOrderRepository->findWhere(array('ISBN13'=>(int)$value, 'user_id' => $user_id));
    //         array_push($bookshelf_order_entries, $bookshelf_order_entry);
    //     }
    //     return $bookshelf_order_entries;
    // }

    // protected function verifyAllBooksForReturn($bookshelf_order_entries) {
    //     // TODO: keep in all entries
    //     return true;
    // }

    // protected function getRents($dispatched_dates) {
    //     $rentArray = [];
    //     foreach ($dispatched_dates as $key => $dispatched_date) {
    //         $dispatch = new Carbon($dispatched_date);
    //         $now = Carbon::now();
    //         $diff = $dispatch->diff($now)->days;
    //         // switch (true) {
    //         //     case: in_array($diff, range(0,30):
    //         //         array_push($rentArray, 100);
    //         //         break;
    //         //     case: in_array($diff, range(0,60):
    //         //         array_push($rentArray, 100);
    //         //         break;
    //         //     case: in_array($diff, range(0,90):
    //         //         array_push($rentArray, 100);
    //         //         break;
    //         //     case: in_array($diff, range(0,180):
    //         //         array_push($rentArray, 100);
    //         //         break;
    //         //     default:
    //         //         array_push($rentArray, -1);
    //         //         break;
    //         // }
    //     }
    //     return $rentArray;
    // }

    // /**
    //  * Return books
    //  */
    // public function returnBook(Request $request) {

    //     $user_id = $request->input('user_id');
    //     $isbns = $request->input('isbns');

    //     $bookshelf_order_entries = getBookshelfOrderEntries();

    //     if(verifyAllBooksForReturn($bookshelf_order_entries)) {

    //         // get payable Rent
    //         $dispatched_dates = [];
    //         foreach ($bookshelf_order_entries as $key => $value) {
    //             array_push($dispatched_dates, $this->bookshelfOrderTrackingRepository->findWhere(array('bookshelf_order_id' => $value), array('dispatched')));
    //         }
    //         $rentArray = getRents($dispatched_dates);

    //         // change status in bookshelf-order-tracking and bookshelf; return with rent-array
    //         foreach ($bookshelf_order_entries as $key => $value) {
    //             $this->bookshelfOrderTrackingRepository->update(
    //                 array('bookshelf_order_id' => $value['bookshelf_order_id']),
    //                 array('new_pickup' => Carbon::now())
    //             );
    //         }

    //         foreach ($bookshelf_order_entries as $key => $value) {
    //             $this->bookshelfRepository->update(
    //                 array('bookshelf_order_id' => $value['bookshelf_order_id']),
    //                 array('new_pickup' => Carbon::now())
    //             );
    //         }

    //         return $rentArray;

    //     }

    //     return $this->respondInvalidInputData();

    // }
}
