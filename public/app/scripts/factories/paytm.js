'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('PaytmFactory', function($resource) {
    return $resource(
    	'api/paytm',
    	null,
    	{'query': { method: 'POST' }} );
  });