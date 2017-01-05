'use strict';

/**
 * @ngdoc service
 * @name publicApp.blogsFactory
 * @description
 * # blogsFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('TrendingBook', function($resource) {
    return $resource(
    	'api/trending-books',
    	null,
    	{'query': { method: 'GET' }} );
  });
