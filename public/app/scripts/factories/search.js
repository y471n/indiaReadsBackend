
'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the .
 */
angular.module('publicApp')
  .factory('SearchFactory', function($resource) {
    return $resource(
    	'/api/search',
    	null,
    	{'query': { method: 'POST' }} );
  });
