'use strict';

/**
 * @ngdoc service
 * @name publicApp.catlistFactory
 * @description
 * # catlistFactory
 * Service in the publicApp.
 */
angular.module('publicApp')
  .factory('ParentCatBooks', function($resource) {
    return $resource(
    	'api/parent-cat-books/:parentid',
    	null,
    	{'query': { method: 'GET' }} );    
  });
