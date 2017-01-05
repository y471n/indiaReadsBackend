'use strict';

/**
 * @ngdoc service
 * @name publicApp.blogsFactory
 * @description
 * # blogsFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('RecommendedBooks', function($resource) {
    return $resource(
    	'api/all-np-recommended',
    	null,
    	{'query': { method: 'GET' }} );
  });
