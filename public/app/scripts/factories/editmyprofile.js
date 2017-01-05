'use strict';

/**
 * @ngdoc service
 * @name publicApp.blogsFactory
 * @description
 * # blogsFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('EditMyProfileFactory', function($resource) {
    return $resource(
    	'api/edit-profile-details',
    	null,
    	{'query': { method: 'POST' }} );
  });
