'use strict';

/**
 * @ngdoc service
 * @name publicApp.blogsFactory
 * @description
 * # blogsFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('PopularBooks', function($resource) {
    return $resource(
    	'api/all-popular-books',
    	null,
    	{'query': { method: 'GET' }} );
  });
