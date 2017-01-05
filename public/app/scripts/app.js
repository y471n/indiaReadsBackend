'use strict';

/**
 * @ngdoc overview
 * @name publicApp
 * @description
 * # publicApp
 *
 * Main module of the application.
 */
angular
.module('publicApp',[
    'ngAnimate',
    'ngCookies',
    'ngMessages',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch',
    'door3.css',
    'ui.router',
    'satellizer',
    'dcbImgFallback',
    'infinite-scroll',
    'angularMoment',
    'jcs-autoValidate',
    'slick',
    'angularSpinner',
    'toaster',
    'ngAnimate'
  ])
  .config(function ($routeProvider, $locationProvider, $stateProvider, $urlRouterProvider, $authProvider, $httpProvider, $cssProvider) {

    $httpProvider.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

    // $authProvider.tokenPrefix = 'test';

    $authProvider.loginUrl = '/api/login';
    $authProvider.google.url = '/login';
    $authProvider.google({
      clientId: '633824688387-3fkt2h8l2i350v7ev5gvjc0d5qluoanj.apps.googleusercontent.com'
    });

    $authProvider.facebook({
      clientId: '1620908248161467',
      redirectUri: 'http://localhost:8000'
    });

    $stateProvider
      .state('homepage', {
        url: "/",
        templateUrl: 'app/views/homepage.html',
        controller: 'MainCtrl',
        // resolve: {
        //   newBookLoaded: function(HomepageService) {
        //     if(HomepageService.newbooks.length == 0) {
        //       HomepageService.loadNewBooks();
        //     }
        //     return true;
        //   },
        //   trendingLoaded: function(HomepageService) {
        //     if(HomepageService.trendingbooks.length == 0) {
        //       HomepageService.loadTrendingBooks();
        //     }
        //     return true;
        //   },
        //   recommendedLoaded: function(HomepageService) {
        //     if(HomepageService.recommendedbooks.length == 0) {
        //       HomepageService.loadRecommendedBooks();
        //     }
        //     return true;
        //   }
        // },
        onEnter: function(Loading){
          Loading.setLoading(true);
        },
        onExit: function(){
        }
      });

      $stateProvider
      .state('howitworks', {
        url: "/how-it-works",
        templateUrl: 'app/views/how-it-works.html',
        controller: 'HowitworksCtrl',
        onEnter: function(Loading){
          Loading.setLoading(true);
        }
      });

      $stateProvider
      .state('new', {
        url: "/new",
        templateUrl: 'app/views/new.html',
        controller: 'NewCtrl',
        onEnter: function(Loading){
          Loading.setLoading(true);
        }
      });

      $stateProvider
      .state('recommended', {
        url: "/recommended",
        templateUrl: 'app/views/recommended.html',
        controller: 'RecommendedCtrl',
        onEnter: function(Loading){
          Loading.setLoading(true);
        }
      });

      $stateProvider
      .state('popular', {
        url: "/popular",
        templateUrl: 'app/views/popular.html',
        controller: 'PopularCtrl',
        onEnter: function(Loading){
          Loading.setLoading(true);
        }
      });

      $stateProvider
      .state('contactus', {
        url: "/contact-us",
        templateUrl: 'app/views/contact-us.html',
        controller: 'ContactusCtrl',
      });

      $stateProvider
      .state('aboutus', {
        url: "",
        templateUrl: 'app/views/about-us.html',
      });

      $stateProvider
      .state('returncart', {
        url: "/return-cart",
        templateUrl: 'app/views/return-cart.html',
        controller: 'ReturnCartCtrl',
        onEnter: function(Loading){
          Loading.setLoading(true);
        }
      });

      $stateProvider
      .state('pickup', {
        url: "/pickup",
        templateUrl: 'app/views/pickup.html',
        controller: 'PickUpCtrl',
        onEnter: function(Loading){
          Loading.setLoading(true);
        }
      });

      $stateProvider
      .state('aboutus.about', {
        url: "/about-us/about",
        templateUrl: 'app/views/about-about.html',
        controller: 'AboutCtrl',
      });

      $stateProvider
      .state('aboutus.policy', {
        url: "/about-us/policy",
        templateUrl: 'app/views/about-policy.html',
        controller: 'PolicyCtrl',
      });

      $stateProvider
      .state('aboutus.tos', {
        url: "/about-us/tos",
        templateUrl: 'app/views/about-tos.html',
        controller: 'TosCtrl',
      });

      $stateProvider
      .state('faq', {
        url: "/faq",
        templateUrl: 'app/views/faq.html',
        controller: 'FAQCtrl',
      });

      $stateProvider
        .state('category', {
          url: "",
          templateUrl: 'app/views/category_skeleton.html',
      });

      // $stateProvider
      //   .state('category.super', {
      //     url: "/category/:supername/:superid",
      //     templateUrl: 'app/views/category_super.html',
      //     controller: 'SuperCategoryCtrl',
      // });

      $stateProvider
      .state('category.parent', {
        url: "/category/:supername/:superid/:parentname/:parentid",
        templateUrl: 'app/views/category_parent.html',
        controller: 'ParentCategoryCtrl',
      });

      // $stateProvider
      // .state('category.cats1', {
      //   url: "/category/:supername/:superid/:parentname/:parentid/:cats1name/:cats1id",
      //   templateUrl: 'app/views/category_cats1.html',
      //   controller: 'Cats1CategoryCtrl',
      // });

      // $stateProvider
      // .state('category.cats2', {
      //   url: "/category/:supername/:superid/:parentname/:parentid/:cats1name/:cats1id/:cats2name/:cats2id",
      //   templateUrl: 'app/views/category_cats2.html',
      //   controller: 'Cats2CategoryCtrl',
      // });

      $stateProvider
      .state('account', {
        url: "",
        templateUrl: 'app/views/myaccount.html',
        onEnter: function(Loading){
          Loading.setLoading(true);
        }
        // controller: 'AccountCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('account.bookshelf', {
        url: "/account/bookshelf",
        templateUrl: 'app/views/account_bookshelf.html',
        controller: 'AccountBookshelfCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('account.bookshelf.available', {
        url: "/available-books",
        templateUrl: 'app/views/bookshelf_available.html',
        controller: 'BookshelfAvailableCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('account.bookshelf.currentlyreading', {
        url: "/currentlyreading",
        templateUrl: 'app/views/bookshelf_currently.html',
        controller: 'BookshelfCurrentlyCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('account.bookshelf.readinghistory', {
        url: "/history",
        templateUrl: 'app/views/bookshelf_history.html',
        controller: 'BookshelfHistoryCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('account.bookshelf.wishlist', {
        url: "/wishlist",
        templateUrl: 'app/views/bookshelf_wishlist.html',
        controller: 'BookshelfWishlistCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('account.myorders', {
        url: "/account/myorders",
        templateUrl: 'app/views/account_myorders.html',
        controller: 'AccountMyOrdersCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('account.storecredits', {
        url: "/account/storecredits",
        templateUrl: 'app/views/account_storecredits.html',
        controller: 'AccountStoreCreditsCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('account.myprofile', {
        url: "/account/myprofile",
        templateUrl: 'app/views/account_myprofile.html',
        controller: 'AccountMyprofileCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('account.addressbook', {
        url: "/account/addressbook",
        templateUrl: 'app/views/account_addressbook.html',
        controller: 'AccountAddressbookCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('account.changepassword', {
        url: "/account/changepassword",
        templateUrl: 'app/views/account_changepassword.html',
        controller: 'SetpasswordCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('account.logout', {
        url: "/account/logout",
        templateUrl: 'app/views/account_logout.html',
        controller: 'AccountLogoutCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('search', {
        url: "/search/:query",
        templateUrl: 'app/views/search.html',
        controller: 'SearchCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('login', {
        url: "/login",
        templateUrl: 'app/views/login.html',
        controller: 'LoginCtrl',
        onExit: function() {
            // $authProvider.tokenPrefix = 'test';
        }
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('return', {
        url: "/return-summary",
        templateUrl: 'app/views/returnsummary.html',
        controller: 'ReturnCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('thankyou', {
        url: "/thank-you",
        templateUrl: 'app/views/thankyou.html',
        controller: 'ThankCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('forgot', {
        url: "/forgot-password",
        templateUrl: 'app/views/forgotpassword.html',
        controller: 'ForgotCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('product', {
        url: "/book/:isbn/:name/:category",
        templateUrl: 'app/views/product.html',
        controller: 'ProductCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('setpassword', {
        url: "/set-password?email&h",
        templateUrl: 'app/views/resetpassword.html',
        controller: 'SetpasswordCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('rentalcart', {
        url: "/rental-cart",
        templateUrl: 'app/views/rental-cart.html',
        controller: 'RentalCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

       $stateProvider
      .state('checkout', {
        url: "",
        templateUrl: 'app/views/checkout.html',
        // controller: 'CheckoutCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('checkout.login', {
        url: "/checkout/login",
        templateUrl: 'app/views/checkout_login.html',
        controller: 'CheckoutloginCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('checkout.delivery', {
        url: "/checkout/delivery-address",
        templateUrl: 'app/views/checkout_delivery_address.html',
        controller: 'CheckoutdeliveryaddressCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('checkout.payment', {
        url: "/checkout/payment",
        templateUrl: 'app/views/checkout_payment.html',
        controller: 'CheckoutpaymentCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });

      $stateProvider
      .state('checkout.summary', {
        url: "/checkout/order-summary",
        templateUrl: 'app/views/checkout_order_summary.html',
        controller: 'CheckoutordersummaryCtrl',
        // css: ['app/styles/uistyles/irstyle.css',
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css']
      });


      $urlRouterProvider.otherwise('/');

      $locationProvider.html5Mode(true);
  }).
run(function($rootScope){
  $rootScope.loading = true;
});
