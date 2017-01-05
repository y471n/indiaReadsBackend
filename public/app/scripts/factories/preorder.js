'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('PreOrderFactory', function($resource) {
    return $resource(
    	'api/pre-order',
    	null,
    	{'query': { method: 'POST' }} );
  });