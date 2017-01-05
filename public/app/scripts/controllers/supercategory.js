'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ListCtrl
 * @description
 * # ListCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('SuperCategoryCtrl', function ($scope, $stateParams, CatListService, Loading, $rootScope) {

   //  $scope.catListService = CatListService;
   //  $scope.parentid = $stateParams.parentid;
  	// $scope.superid = $stateParams.superid;
   //  $scope.supername = $stateParams.supername;

   //  $scope.catListService.categories = [];
   //  $scope.catListService.books = [];

   //  Loading.setLoading(false);
   //  $rootScope.$broadcast("loading");

   //  // Loading categories; test;
   //  $scope.catListService.loadCategories();

   //  $scope.unSluggifyTitle = function(name) {
   //    if(name) {
   //       return $scope.toTitleCase(name.replace('-', ' '));
   //     }
   //     return '';
   //  }

   //  $scope.toTitleCase = function(str) {
   //    return str.replace(/\w\S*/g, function(txt) {
		 //    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
	  //   });
   //  }

   //  $scope.sluggifyTitle = function(name) { 
   //     if(name) {
   //       return name.replace(/\s+/g, '-').replace(/\//g,'');
   //     }
   //     return '';
   //  }


   //  if($stateParams.superid) {
   //    $scope.categoryName = $stateParams.supername;
  	// 	$scope.catListService.loadSuperBooks($scope.superid);
  	// } 
    
   //  //category--subcategory
   //  if($stateParams.superid) {
   //    $scope.catListService.loadCategories($scope.superid);
   //  } 


   //  $scope.loadMore = function() {
   //  	console.log('load more');
   //  	if($scope.catListService.hasMore) {
   //          $scope.catListService.loadSuperBooks($scope.superid);
   //      }
   //  };
   //  $scope.break2 = [
   //      {
   //        breakpoint: 1400,
   //        settings: {
   //          slidesToShow: 4,
   //          slidesToScroll: 4,
   //          infinite: true,
   //        }
   //      },
   //      {
   //        breakpoint: 1024,
   //        settings: {
   //          slidesToShow: 4,
   //          slidesToScroll: 1,
   //          infinite: true,
   //        }
   //      },
   //      {
   //        breakpoint: 992,
   //        settings: {
   //          slidesToShow: 3,
   //          slidesToScroll: 3,
   //          infinite: true,
   //        }
   //      },
   //      {
   //        breakpoint: 768,
   //        settings: {
   //          slidesToShow: 2,
   //          slidesToScroll: 2,
   //          infinite: true,
   //        }
   //      },
   //      {
   //        breakpoint: 480,
   //        settings: {
   //          slidesToShow: 2,
   //          slidesToScroll: 2,
   //          infinite: true,
   //        }
   //      }
   //  ];

  });
