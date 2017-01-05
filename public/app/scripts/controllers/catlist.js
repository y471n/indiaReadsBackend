'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ListCtrl
 * @description
 * # ListCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('ListCtrl', function ($scope, $stateParams, CatListService, Loading, $rootScope) {

    $scope.catListService = CatListService;
    $scope.parentid = $stateParams.parentid;
  	$scope.superid = $stateParams.superid;
    $scope.supername = $stateParams.supername;
    $scope.parentname = $stateParams.parentname;
    $scope.categoryid = $stateParams.categoryid;

    $scope.catListService.categories = [];
    $scope.catListService.books = [];

    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
    $scope.in_loading = true;
    $scope.in_loading_side = true;

    // Loading categories; test;
    $scope.catListService.loadCategories($scope.parentid).then(function() {
      $scope.in_loading_side = false;
    });

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

    $scope.sluggifyTitle = function(name) { 
       if(name) {
         return name.replace(/\s+/g, '-').replace(/\//g,'');
       }
       return '';
    }

     $scope.select= function(item) {
        $scope.selected = item; 
     };

     $scope.isActive = function(item) {
            return $scope.selected === item;
     };


    if($stateParams.parentid) {
  		$scope.catListService.loadParentBooks($stateParams.parentid);
      $scope.categoryName = $stateParams.parentname;
      $scope.in_loading = false;
  	} else {
  		// todo: change to load superParentBooks
      $scope.categoryName = $stateParams.supername;
  		$scope.catListService.loadSuperBooks($scope.superid);
      $scope.in_loading = false;
  	} 
    
    //category--subcategory
    if($stateParams.parentid) {
      $scope.catListService.loadCategories($scope.parentid);
      $scope.in_loading_side = false;

    } 


    $scope.loadMore = function() {
    	console.log('load more');
    	if($scope.catListService.hasMore) {
            $scope.catListService.loadParentBooks($scope.parentid);
        }
    };
    $scope.break2 = [
        {
          breakpoint: 1400,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 4
          }
        },
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
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
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
    ];

  });
