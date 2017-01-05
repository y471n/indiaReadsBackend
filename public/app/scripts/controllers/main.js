'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')

  .controller('MainCtrl', function ($scope, $stateParams, HomepageService, ProductService, $location, $rootScope, Loading) {

    $scope.loadedTrending = false;
    $scope.loadedRecommended = false;
    $scope.loadedNew = false;
    $scope.in_loading_trending = true;
    $scope.in_loading_new = true;
    $scope.in_loading_recommended = true;
    $scope.productService = ProductService
    $scope.homepageService = HomepageService;
    $scope.rent = 0;

    // $rootScope.loading = false;
    Loading.setLoading(false);
    $rootScope.$broadcast("loading");

    $scope.homepageService.loadNewBooks().then(function() {
       $scope.loadedNew = true;
       $scope.in_loading_new = false;
      //  for (var i = 0; i<$scope.homepageService.newbooks.length; i++) {
      //     // console.log("hello");
      //     var isbn = $scope.homepageService.newbooks[i].isbn13;
      //     // console.log(isbn);
      //     $scope.productService.getBook(isbn).then(function(data){
       //
      //           for (var j = 0; j <$scope.homepageService.newbooks.length; j++) {
      //               // console.log("h"+data.isbn13);
      //               // console.log("u"+$scope.homepageService.newbooks[j].isbn13);
      //               if($scope.homepageService.newbooks[j].isbn13 == data.isbn13) {
      //                 // console.log(data.rent);
      //                 $scope.homepageService.newbooks[j].rent = data.rent.rent[0];
      //                 console.log(data.rent.rent[0]);
      //               }
      //           }
      //     });
       //
      //   }
    });

    $scope.homepageService.loadTrendingBooks().then(function() {
        $scope.loadedTrending = true;
        $scope.in_loading_trending = false;
        // for (var i = 0; i<$scope.homepageService.trendingbooks.length; i++) {
        //   // console.log("hello");
        //   var isbn = $scope.homepageService.trendingbooks[i].isbn13;
        //   // console.log(isbn);
        //   $scope.productService.getBook(isbn).then(function(data){
        //
        //         for (var j = 0; j <$scope.homepageService.trendingbooks.length; j++) {
        //             // console.log("h"+data.isbn13);
        //             // console.log("u"+$scope.homepageService.trendingbooks[j].isbn13);
        //             if($scope.homepageService.trendingbooks[j].isbn13 == data.isbn13) {
        //               // console.log(data.rent);
        //               $scope.homepageService.trendingbooks[j].rent = data.rent.rent[0];
        //               console.log(data.rent.rent[0]);
        //             }
        //         }
        //   });
        //
        // };
    });

    $scope.getRent = function(isbn, type) {
        if(type == 'trending') {
            for (var j = 0; j <$scope.homepageService.trendingbooks.length; j++) {
                // console.log("h"+data.isbn13);
                // console.log("u"+$scope.homepageService.recomemdedbooks[j].isbn13);
                if($scope.homepageService.trendingbooks[j].isbn13 == isbn) {
                  // console.log(data.rent);
                  if($scope.homepageService.trendingbooks[j].rent) {
                    return;
                  }
                }
            }
        }
        if(type == 'recommended') {
            for (var j = 0; j <$scope.homepageService.recommendedbooks.length; j++) {
                // console.log("h"+data.isbn13);
                // console.log("u"+$scope.homepageService.recomemdedbooks[j].isbn13);
                if($scope.homepageService.recommendedbooks[j].isbn13 == isbn) {
                  // console.log(data.rent);
                  if($scope.homepageService.recommendedbooks[j].rent) {
                    return;
                  }
                }
            }
        }
        if(type == 'new') {
            for (var j = 0; j <$scope.homepageService.newbooks.length; j++) {
                // console.log("h"+data.isbn13);
                // console.log("u"+$scope.homepageService.recomemdedbooks[j].isbn13);
                if($scope.homepageService.newbooks[j].isbn13 == isbn) {
                  // console.log(data.rent);
                  if($scope.homepageService.newbooks[j].rent) {
                    return;
                  }
                }
            }
        }

        $scope.productService.getBook(isbn).then(function(data){
              if(type == 'trending') {
                  for (var j = 0; j <$scope.homepageService.trendingbooks.length; j++) {
                      // console.log("h"+data.isbn13);
                      // console.log("u"+$scope.homepageService.recomemdedbooks[j].isbn13);
                      if($scope.homepageService.trendingbooks[j].isbn13 == data.isbn13) {
                        // console.log(data.rent);
                        $scope.homepageService.trendingbooks[j].rent = data.rent.rent[0];
                        console.log(data.rent.rent[0]);
                      }
                  }
              }
              if(type == 'recommended') {
                  for (var j = 0; j <$scope.homepageService.recommendedbooks.length; j++) {
                      // console.log("h"+data.isbn13);
                      // console.log("u"+$scope.homepageService.recomemdedbooks[j].isbn13);
                      if($scope.homepageService.recommendedbooks[j].isbn13 == data.isbn13) {
                        // console.log(data.rent);
                        $scope.homepageService.recommendedbooks[j].rent = data.rent.rent[0];
                        console.log(data.rent.rent[0]);
                      }
                  }
              }
              if(type == 'new') {
                  console.log("in here");
                  for (var j = 0; j <$scope.homepageService.newbooks.length; j++) {
                      // console.log("h"+data.isbn13);
                      // console.log("u"+$scope.homepageService.recomemdedbooks[j].isbn13);
                      if($scope.homepageService.newbooks[j].isbn13 == data.isbn13) {
                        // console.log(data.rent);
                        $scope.homepageService.newbooks[j].rent = data.rent.rent[0];
                        console.log(data.rent.rent[0]);
                      }
                  }
              }

        });
    };

    $scope.homepageService.loadRecommendedBooks().then(function() {
        $scope.loadedRecommended = true;
        $scope.in_loading_recommended = false;
        // for (var i = 0; i<$scope.homepageService.recommendedbooks.length; i++) {
        //   // console.log("hello");
        //   var isbn = $scope.homepageService.recommendedbooks[i].isbn13;
        //   // console.log(isbn);
        //   $scope.productService.getBook(isbn).then(function(data){
        //
        //         for (var j = 0; j <$scope.homepageService.recommendedbooks.length; j++) {
        //             // console.log("h"+data.isbn13);
        //             // console.log("u"+$scope.homepageService.recomemdedbooks[j].isbn13);
        //             if($scope.homepageService.recommendedbooks[j].isbn13 == data.isbn13) {
        //               // console.log(data.rent);
        //               $scope.homepageService.recommendedbooks[j].rent = data.rent.rent[0];
        //               console.log(data.rent.rent[0]);
        //             }
        //         }
        //   });
        //
        // }
    });


    $scope.breakpoints = [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 1440,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 720,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 1
          }
        }
    ];
    $scope.break1 = [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            dots:true,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            dots:true
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots:true
          }
        }
    ];

  });
