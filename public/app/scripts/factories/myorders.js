'use strict';

/**
 * @ngdoc service
 * @name publicApp.blogsFactory
 * @description
 * # blogsFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('MyOrdersFactory', function($resource) {
    return $resource(
    	'api/get-orders',
    	null,
    	{'query': { method: 'POST' }} );
  });
