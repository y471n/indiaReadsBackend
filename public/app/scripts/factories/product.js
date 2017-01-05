'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('ProductFactory', function($resource) {
    return $resource(
    	'api/book/:isbn',
    	null,
    	{'query': { method: 'GET' }} );
  });