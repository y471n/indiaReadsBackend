'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('CodFactory', function($resource) {
    return $resource(
    	'api/complete-order',
    	null,
    	{'query': { method: 'POST' }} );
  });
