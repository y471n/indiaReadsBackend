'use strict';

/**
 * @ngdoc service
 * @name publicApp.blogsFactory
 * @description
 * # blogsFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('DeliveryAddresses', function($resource) {
    return $resource(
    	'api/user-address',
    	null,
    	{'query': { method: 'POST' }} );
  });
