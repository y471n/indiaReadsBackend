'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ListCtrl
 * @description
 * # ListCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('ParentCategoryCtrl', function ($scope, $stateParams, CatListService, Loading, $rootScope) {

    $scope.catListService = CatListService;
    $scope.parentid = $stateParams.parentid;
    $scope.superid = $stateParams.superid;
    $scope.supername = $stateParams.supername;
    $scope.parentname = $stateParams.parentname;
    $scope.categoryid = $stateParams.parentid;
    $scope.in_loading_side= true;
    $scope.in_loading_books= true;
    $scope.out_of_stock = false;
    $scope.books = [];
    $scope.loading_books = "parent";

    $scope.showSubCats = function(sub) {
        console.log(sub);
        if(sub.length > 0) {
          return true;
        }
        return false;
    };

    $scope.excludeOut = function() {
    	console.log($scope.out_of_stock);
        if($scope.out_of_stock) {
		var j=0;
		$scope.books = [];
		for(var i=0;i<$scope.catListService.books.length; i++) {
			if($scope.catListService.books[i].in == true) {
				$scope.books[j] = $scope.catListService.books[i];
                                j++;
			}
		}
        } else {
	   $scope.books = $scope.catListService.books;
        }
    };

    console.log($stateParams.supername);

    $scope.catListService.categories = [];
    $scope.catListService.books = [];

    Loading.setLoading(false);
    $rootScope.$broadcast("loading");

    $scope.in_loading = false;

    // Loading categories; test;
    $scope.catListService.loadCategories($scope.categoryid).then(function() {
      $scope.catListService.categories = [];
      $scope.in_loading_side=false;
    });

    $scope.unSluggifyTitle = function(name) {
      if(name) {
         return $scope.toTitleCase(name.replace('-', ' '));
       }
       return '';
    }

    $scope.select= function(item) {
        $scope.selected = item;
     };

     $scope.isActive = function(item) {
            return $scope.selected === item;
     };

    $scope.toTitleCase = function(str) {
      return str.replace(/\w\S*/g, function(txt) {
		    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
	    });
    }

    $scope.sluggifyTitle = function(name) {
       if(name) {
         return name.replace(/\s+/g, '-').replace(/\//g,'');
       }
       return '';
    }

    if($stateParams.parentid) {
		console.log('h');
  		$scope.catListService.loadParentBooks($stateParams.parentid).then(function() {
        	$scope.out_of_stock = false;
		console.log('here');
      		$scope.books = $scope.catListService.books;
                console.log('books'+$scope.books);
     		$scope.in_loading_books=false;
     });
      $scope.categoryName = $stateParams.parentname;
  	} else {
		console.log('here2');
  		// todo: change to load superParentBooks
      		$scope.categoryName = $stateParams.supername;
  		$scope.catListService.loadSuperBooks($scope.superid).then(function() {
      $scope.in_loading_books=false;
     });
  	}

    //category--subcategory
    if($stateParams.parentid) {
      $scope.catListService.loadCategories($scope.parentid).then(function() {
      $scope.in_loading_books=false;
     });
    }

    $scope.loadCat1Books = function(catId1) {
	$scope.catId1 = catId1;
        console.log(catId1);
        $scope.catListService.books = [];
	$scope.books = [];

        $scope.loading_books = "cat1";
        $scope.catListService.loadCat1Books(catId1).then(function() {
      		$scope.in_loading_books=false;

        	$scope.out_of_stock = false;
      		$scope.books = $scope.catListService.books;
     	});
    };

    $scope.loadCat2Books = function(catId2) {
        console.log(catId2);
	$scope.catId2 = catId2;
	$scope.books = [];

        $scope.loading_books = "cat2";
        $scope.catListService.books = [];
        $scope.catListService.loadCat2Books(catId2).then(function() {
        $scope.in_loading_books=false;

        $scope.books = $scope.catListService.books;
        $scope.out_of_stock = false;
     });
    };

    $scope.loadMore = function() {
    	console.log('load more');
    	if($scope.catListService.hasMore) {
	    if($scope.loading_books == "cat1") {
            	$scope.catListService.loadCat1Books($scope.catId1);
            } else if($scope.loading_books == "cat2") {
            	$scope.catListService.loadCat2Books($scope.catId2);
	    } else {
            	$scope.catListService.loadParentBooks($scope.parentid);
	    }
        }
    };

    $scope.break2 = [
        {
          breakpoint: 1400,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 4,
            infinite: true,
          }
        },
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: true,
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
          }
        }
    ];

  });
