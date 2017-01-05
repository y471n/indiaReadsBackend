'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the .
 */
angular.module('publicApp')
  .factory('StoreCreditDetailsFactory', function($resource) {
    return $resource(
    	'api/store-credit-details',
    	null,
    	{'query': { method: 'POST' }} );
  });