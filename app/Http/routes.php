<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['domain' => '{company}.ireads.com'], function() {
	Route::get('/', function() {
		return 'corporate';
	});
});

Route::get('/', function() {
	return View::make('index');
})->name('home');

Route::get('/about-us/{state}', function() {
	return View::make('index');
});

Route::get('/return-cart', function() {
	return View::make('index');
});

Route::get('/pickup', function() {
	return View::make('index');
});

Route::get('/faq', function() {
	return View::make('index');
});

Route::get('/new', function() {
	return View::make('index');
});

Route::get('/recommended', function() {
	return View::make('index');
});

Route::get('/popular', function() {
	return View::make('index');
});

// Route::get('/category', function() {
// 	return View::make('index');
// });

Route::get('/account/{state}', function() {
	return View::make('index');
});

Route::get('/account/bookshelf/{state}', function() {
	return View::make('index');
});

Route::get('/login', function() {
	return View::make('index');
});

Route::get('/category/{supername}/{superid}/{parentname}/{parentid}', function() {
	return View::make('index');
});

// Route::get('category/{supername}/{superid}', function() {
// 	return View::make('index');
// });

Route::get('/search', function() {
	return View::make('index');
});

Route::get('/search/{query}', function() {
	return View::make('index');
});


Route::get('/return-summary', function() {
	return View::make('index');
});

Route::get('/set-password', function() {
	return View::make('index');
});

Route::get('/thank-you', function() {
	return View::make('index');
});

Route::get('/book/{isbn}//{category}', function() {
	return View::make('index');
});

Route::get('/book/{isbn}//', function() {
	return View::make('index');
});

Route::get('/book/{isbn}/{name}/{category}', function() {
	return View::make('index');
});

Route::get('/forgot-password', function() {
	return View::make('index');
});

Route::get('/how-it-works', function() {
	return View::make('index');
});

Route::get('/contact-us', function() {
	return View::make('index');
});

Route::get('/rental-cart', function() {
	return View::make('index');
});

Route::get('/checkout/{state}', function() {
	return View::make('index');
});



Route::post('/auth/google', 'UserController@googleLogin');
Route::post('/auth/facebook', 'UserController@facebookLogin');


Route::post('/api/user-details', 'UserController@getUserDetails');

/**
 * Bookshelf Page Routes
 */

// get available shelf books
Route::post('api/bookshelf/available', 'BookshelfController@getAvailableBookshelfList');
// get current reading shelf books
Route::post('api/bookshelf/current', 'BookshelfController@getCurrentlyReading');
// get wishlist shelf books
Route::post('api/bookshelf/wishlist', 'BookshelfController@getWishlistBookshelfList');
// get reading history shelf books
Route::post('api/bookshelf/history', 'BookshelfController@getReadingHistoryBookshelfList');
// add book to bookshelf
Route::post('api/add-to-bookshelf', 'BookshelfController@addToBookshelf');
// update bookshelf
Route::post('api/update-bookshelf', 'BookshelfController@updateBookShelf');
// Notify when book available
Route::post('api/notify-on-book', 'BookshelfController@notifyWhenAvailable');

/**
 * User Profile Related Routes
 */
// get user address
Route::post('api/user-address', 'ProfileController@getUserAddress');

// add new address
Route::post('api/add-address', 'ProfileController@addUserAddress');

// update address
Route::post('api/edit-address', 'ProfileController@editUserAddress');

// get store credits
Route::post('api/get-store-credits', 'ProfileController@getStoreCredits');

// get user store credit details
Route::post('api/store-credit-details', 'ProfileController@getStoreCreditDetails');

// get user profile details
Route::post('api/profile-details', 'ProfileController@getUserProfile');

// add user profile details
Route::post('api/add-profile-details', 'ProfileController@addUserProfile');

// edit user-profile
Route::post('api/edit-profile-details', 'ProfileController@editUserProfile');

// get all orders
Route::post('api/get-orders', 'ProfileController@getAllOrders');

/**
 * Home Page Routes
 */
// get new books
Route::get('api/new-books', 'HomeController@getNewBooks');

// get all new books
Route::get('api/all-new-books', 'HomeController@getHeaderNewBooks');

// get trending books
Route::get('api/trending-books', 'HomeController@getTrendingBooks');

// get non personal recommended books
Route::get('api/np-recommended', 'HomeController@getNonPersonalRecommendedBooks');

// get all non personal recommended books
Route::get('api/all-np-recommended', 'HomeController@getAllNonPersonalRecommendedBooks');

// get popular books
Route::get('api/all-popular-books', 'HomeController@getHeaderPopularBooks');

// get news feed
Route::get('api/news-feed', 'HomeController@getNewsFeed');


// Route::post('/book/return', 'BookshelfController@returnBook');

Route::post('/api/login', 'UserController@postLogin');

Route::post('/api/signup', 'UserController@postSignup');

Route::post('/api/set-new-password', 'UserController@postNewPassword');

// Reset Password
Route::post('/api/reset-password', 'UserController@resetPassword');

/**
 * Product Page Routes
 */
// get book details
Route::get('api/book/{isbn13}', 'ProductController@getBookDetails');

// get bundle
Route::get('api/book/bundle/{isbn13}', 'ProductController@getBundleBooks');

// get similar books
Route::get('api/book/similar/{isbn13}', 'ProductController@getSimilarBooks');


/**
 * Categories Routes
 */

// super-cat books
Route::get('api/super-cat-books/{super_cat_id}', 'CategoriesController@getSuperCatBooks');

// parent categories
Route::get('api/parent-cats/{super_cat_id}', 'CategoriesController@getParentCats');

// parent-cat books
Route::get('api/parent-cat-books/{parent_id}', 'CategoriesController@getParentCatBooks');

// level 1 categories
Route::get('api/cats-level1/{parent_id}', 'CategoriesController@getLevel1Cats');

// level1-cat books
Route::get('api/cats-level1-books/{cat1_id}', 'CategoriesController@getLevel1CatBooks');

// level 2 categories
Route::get('api/cats-level2/{cat1_id}', 'CategoriesController@getLevel2Cats');

// level2-cat books
Route::get('api/cats-level2-books/{cat2_id}', 'CategoriesController@getCatlevel2Books');

// get all cats
Route::get('/api/all-cats/{parent_id}', 'CategoriesController@getAllCats');

/**
* PinCode Route
*/
Route::post('api/check-pin', 'PinController@checkPinCode');

/**
 *Payment Routes
 */
Route::post('api/order/payumoney', 'CheckoutController@postPayumoneyOrder');

/**
 * Rental Cart Route
 */

// pre order from rental cart
Route::post('api/pre-order', 'CheckoutController@postOrder');
// complete COD Order
Route::post('api/complete-order', 'CheckoutController@completeCODOrder');


Route::post('api/paytm', 'CheckoutController@postPaytmOrder');

Route::post('paytm/complete', 'CheckoutController@postPaymentPaytm');

/**
 * Search
 */
Route::post('api/search', 'SearchController@search');
