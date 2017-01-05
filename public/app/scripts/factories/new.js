'use strict';

/**
 * @ngdoc service
 * @name publicApp.blogsFactory
 * @description
 * # blogsFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('NewBooks', function($resource) {
    return $resource(
    	'api/all-new-books',
    	null,
    	{'query': { method: 'GET' }} );
  });
