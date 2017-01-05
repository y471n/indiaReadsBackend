'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the .
 */
angular.module('publicApp')
  .factory('StoreCreditsFactory', function($resource) {
    return $resource(
    	'api/get-store-credits',
    	null,
    	{'query': { method: 'POST' }} );
  });