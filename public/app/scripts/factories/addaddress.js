'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the publicApp.
 */
angular.module('publicApp')
  .factory('AddAddressFactory', function($resource) {
    return $resource(
    	'api/add-address',
    	null,
    	{'query': { method: 'POST' }} );
  });