'use strict';

/**
 * @ngdoc service
 * @name publicApp.blogsFactory
 * @description
 * # blogsFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('NewBook', function($resource) {
    return $resource(
    	'api/new-books',
    	null,
    	{'query': { method: 'GET' }} );
  });
