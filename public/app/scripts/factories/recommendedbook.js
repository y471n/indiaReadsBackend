'use strict';

/**
 * @ngdoc service
 * @name publicApp.blogsFactory
 * @description
 * # blogsFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('RecommendedBook', function($resource) {
    return $resource(
    	'api/np-recommended',
    	null,
    	{'query': { method: 'GET' }} );
  });