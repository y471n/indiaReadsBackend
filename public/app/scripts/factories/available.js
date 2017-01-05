'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the .
 */
angular.module('publicApp')
  .factory('Available', function($resource) {
    return $resource(
    	'api/bookshelf/available',
    	null,
    	{'query': { method: 'POST' }} );
  });