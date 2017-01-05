'use strict';

/**
 * @ngdoc service
 * @name publicApp.blogsFactory
 * @description
 * # blogsFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('Category', function($resource) {
    return $resource(
    	'api/all-cats/:parent_id',
    	null,
    	{'query': { method: 'GET' }} );
  });
