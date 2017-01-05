'use strict';

/**
 * @ngdoc service
 * @name publicApp.catlistFactory
 * @description
 * # catlistFactory
 * Service in the publicApp.
 */
angular.module('publicApp')
  .factory('Cat2Books', function($resource) {
    return $resource(
    	'api/cats-level2-books/:cat2id',
    	null,
    	{'query': { method: 'GET' }} );    
  });
