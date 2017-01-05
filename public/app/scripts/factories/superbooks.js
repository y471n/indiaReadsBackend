'use strict';

/**
 * @ngdoc service
 * @name publicApp.catlistFactory
 * @description
 * # catlistFactory
 * Service in the publicApp.
 */
angular.module('publicApp')
  .factory('SuperCatBooks', function($resource) {
    return $resource(
    	'api/super-cat-books/:superid',
    	null,
    	{'query': { method: 'GET' }} );    
  });
