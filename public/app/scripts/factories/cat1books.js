'use strict';

/**
 * @ngdoc service
 * @name publicApp.catlistFactory
 * @description
 * # catlistFactory
 * Service in the publicApp.
 */
angular.module('publicApp')
  .factory('Cat1Books', function($resource) {
    return $resource(
    	'api/cats-level1-books/:cat1id',
    	null,
    	{'query': { method: 'GET' }} );    
  });
