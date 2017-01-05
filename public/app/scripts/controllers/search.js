'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:SearchCtrl
 * @description
 * # SearchCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('SearchCtrl', function ($scope, Loading, $rootScope, $stateParams, SearchService, ProductService) {
    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
    $scope.in_loading=true;
    $scope.numberofbooks = 0;

    console.log($stateParams);
    console.log($stateParams.query);
    $scope.searchService = SearchService;
    $scope.searchService.books = [];
    $scope.productService = ProductService;
    
    $scope.sluggifyTitle = function(name) { 
       if(name) {
         return name.replace(/\s+/g, '-').replace(/\//g,'');
       }
       return '';
    }

    $scope.search_query = $stateParams.query;
    $scope.searchService.searchBooks($scope.search_query).then(function() {
      console.log($scope.searchService.books);
	for(var i=0; i<$scope.searchService.books.length; i++) {

    $scope.numberofbooks += 1;
    // console.log(" dbjsddjf" +numberofbooks);
		$scope.searchService.books[i].details = {};
		$scope.searchService.books[i].details.rent = {};
    		$scope.productService.getBook($scope.searchService.books[i].ISBN13).then(function(data){
			console.log('a'+data.isbn13);
			for(var j=0; j<$scope.searchService.books.length; j++) {
				if(data.isbn13 == $scope.searchService.books[j].ISBN13) {
					
					$scope.searchService.books[j].details.textLanguage = data.textLanguage;
					$scope.searchService.books[j].details.productForm = data.productForm;
					$scope.searchService.books[j].details.publisherName = data.publisherName;

					if($scope.searchService.books[j].details.rent) {
						$scope.searchService.books[j].details.rent.mrp = data.rent.mrp;
						$scope.searchService.books[j].details.rent.starts = data.rent.rent[0];
						$scope.searchService.books[j].details.textLanguage = data.textLanguage;
						console.log($scope.searchService.books[j].details);
					}
				}
			}
		});

	}
      $scope.in_loading=false;
    });

  });
