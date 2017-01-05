'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ProductCtrl
 * @description
 * # ProductCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('ProductCtrl', function ($scope, ProductService, $stateParams, Cart, $state, Loading, $rootScope, AddToBookshelfService, $auth, NotifyBookshelfService) {
    
    $scope.rent = 0;
    $scope.mrp = 0;
    $scope.saving = 0;
    $scope.mrp_is_not_null = true;
    $scope.refund = 0;
    $scope.before = "";
    $scope.selectedindex = 0;
    $scope.initial_payable = 0;
    $scope.showBook = false;
    $scope.addToBookshelfService = AddToBookshelfService;
    $scope.showAddToWishlist = false;
    $scope.addedToWishlist = false;
    $scope.notifyBookshelfService = NotifyBookshelfService;
    $scope.notify_email = "";
    $scope.addedToNotification = false;
    $scope.showNotifyMe = false;
    $scope.in_loading=true;


    $scope.addToWishlist = function() {
        // var book_details = [];
        // book_details.push(
        var book_details = 
            {
                "isbn13": $scope.book.isbn13, 
                "title": $scope.book.title,
                "author" : $scope.book.author1,
                "availability_status": 0,
                "init_pay": $scope.initial_payable 
            };
        // );

        var book_details = {"book_details": book_details};
        $scope.addToBookshelfService.addtobookshelf(book_details).then(function(data) {
            console.log('data'+data);
            if(data.id) {
                // Show added to wishlist
                $scope.showAddToWishlist = false;
                $scope.addedToWishlist = true;
            }
        });
    };

    
    $scope.isAuthenticated = function() {
        return $auth.isAuthenticated();
    };

    $scope.notifyBookshelf = function() {
        
        console.log($scope.notify_email);
        var book_details = 
            {
                "isbn13": $scope.book.isbn13, 
                "title": $scope.book.title,
                "author" : $scope.book.author1,
                "availability_status": 0,
                "init_pay": $scope.initial_payable 
            };
        
        var book_detail = book_details;
        var book_details = JSON.stringify({"book_details": book_detail});
        var params = {
            books: book_details,
            email: $scope.notify_email
        }
        
        NotifyBookshelfService.notify(book_details, $scope.notify_email).then(function(data) {
            if(data.id) {
                // Notify success
                $scope.showNotifyMe = false;
                $scope.addedToNotification = true;

            } else {
                // Show some error
            }
        });

    };


    $scope.unSluggifyTitle = function(name) {
      if(name) {
         return $scope.toTitleCase(name.replace('-', ' '));
       }
       return '';
    }

    $scope.toTitleCase = function(str) {
      return str.replace(/\w\S*/g, function(txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        });
    }

    $scope.containsWords = function(text) {
        if(text && text.trim().length>0) {
            return true;
        }
        return false;
    };

    $scope.category = $stateParams.category;
    $scope.productService = ProductService;
    $scope.productService.getBook($stateParams.isbn).then(function(data){

        $scope.in_loading=false;
        Loading.setLoading(false);
        $rootScope.$broadcast("loading");
        $scope.showBook = true;

        $scope.book = $scope.productService.book;
        console.log($scope.book);

        if($scope.book.rent.mrp == "null") {
            $scope.mrp_is_not_null = false;
            if($scope.isAuthenticated()) {
                   $scope.showAddToWishlist = true;
            } else {
                $scope.showNotifyMe = true;
            }
            return;
        }
    	
    	console.log($scope.book);
        $scope.rent = $scope.book.rent.rent[0];
        $scope.mrp = $scope.book.rent.mrp;
        $scope.initial_payable = $scope.book.rent.initialPayable;
        $scope.saving = parseInt($scope.mrp) - $scope.rent;
        $scope.refund = parseInt($scope.initial_payable) - $scope.rent;

        $scope.before = moment().add(30, 'days').format("MMMM Do, YYYY");


    }, function(){
    	console.log('error');
    });

    $scope.disableRent = function() {

        if($scope.book && Cart.productExists($scope.book.rent.bookID)) {
            console.log('r');
            return true;
        }
        console.log('s');
        return false;
    };


    $scope.tabActive = function(index) {
        if(index == $scope.selectedindex) {
            return 'active';
        }
        return '';
    };

    $scope.rentBook = function() {

        Cart.addProduct($scope.book.rent.bookID, $scope.book.title,
            $scope.book.isbn13, $scope.initial_payable, $scope.book.rent.mrp, $scope.book.author1,
            $scope.rent_duration, $scope.book.rent.bookLibrary, $scope.book.rent.merchantLibrary);
        
        $rootScope.$broadcast("change_cart_size");

        $state.go('rentalcart');
    };

    $scope.returnRent = function(index) {
        if($scope.book) {
            var rent = $scope.book.rent.rent[index];
            return rent;    
        }
    };

    $scope.deliveryTime = function() {
        if($scope.book) {
           var d = $scope.book.rent.procurementTime;
            return moment().add(d+3, 'days').format("MMMM Do, YYYY");
        }
    };

    $scope.deliveredWithin = function() {
      if($scope.book) {
           var d = $scope.book.rent.procurementTime;
           return d+3;
        }  
    };

    $scope.returnTime = function(index) {
        switch(index) {
            case 0:
                return moment().add(30, 'days').format("MMMM Do, YYYY");
                break;
            case 1:
                return moment().add(90, 'days').format("MMMM Do, YYYY");
                break;
            case 2:
                return moment().add(180, 'days').format("MMMM Do, YYYY");
                break;
            case 3:
                return moment().add(360, 'days').format("MMMM Do, YYYY");
                break;
            }
    }

    $scope.returnRentDuration = function(index) {
        switch(index) {
            case 0:
                return 30;
                break;
            case 1:
                return 90;
                break;
            case 2:
                return 180;
                break;
            case 3:
                return 360;
                break;
        }
    };

    $scope.calculateRent = function(index) {
        $scope.rent = $scope.returnRent(index);
        $scope.rent_duration = $scope.returnRentDuration(index);
        $scope.selectedindex = index;
        $scope.saving = parseInt($scope.mrp) - $scope.rent;
        $scope.refund = parseInt($scope.initial_payable) - $scope.rent;
        $scope.before = $scope.returnTime(index);
    };

    


  });
