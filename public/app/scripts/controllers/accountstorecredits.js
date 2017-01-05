'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:AccountStoreCreditsCtrl
 * @description
 * # AccountStoreCreditsCtrl
 * Controller of the publicApp
 */
angular.module('publicApp').controller('AccountStoreCreditsCtrl', 
    function ($scope,$auth, $state, StoreCreditsService, StoreCreditDetailsService, Loading, $rootScope) {
        $scope.storeCreditsService = StoreCreditsService;
        $scope.storeCreditDetailsService = StoreCreditDetailsService;
      	Loading.setLoading(false);
        $rootScope.$broadcast("loading");
        $scope.storeCreditDetailsService.loadCredits().then(function() {
          $scope.in_loading=false;
        });
        $scope.storeCreditsService.getCredits().then(function(data) {
          $scope.in_loading=false;
          $scope.store_credit=data["data"][0]["store_credit"];
    });
});