'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the .
 */
angular.module('publicApp')
  .factory('Order', function($resource) {
    return $resource(
    	'api/my-order',
    	null,
    	{'query': { method: 'POST' }} );
  });