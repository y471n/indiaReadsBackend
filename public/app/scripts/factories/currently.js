'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the .
 */
angular.module('publicApp')
  .factory('Current', function($resource) {
    return $resource(
    	'api/bookshelf/current',
    	null,
    	{'query': { method: 'POST' }} );
  });