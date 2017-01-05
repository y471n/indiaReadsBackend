'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # product
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('StoreCreditsService', function (StoreCreditsFactory, $q) {
    
    var self = {
      'details':[],
      'getCredits': function() {
            var d = $q.defer();
          StoreCreditsFactory.query({auth_token: localStorage.getItem('auth_token')}, 
            function(data) {
                console.log(data);
                console.log(data["data"][0]["store_credit"])
                // Password reset successful
                d.resolve(data);
              }, function(error) {
                  d.reject();
                  // console.log("error");
            });

        return d.promise;
      }
    };

    return self;

  });