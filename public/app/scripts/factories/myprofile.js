'use strict';

/**
 * @ngdoc service
 * @name publicApp.blogsFactory
 * @description
 * # blogsFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('MyProfileFactory', function($resource) {
    return $resource(
    	'api/profile-details',
    	null,
    	{'query': { method: 'POST' }} );
  });
