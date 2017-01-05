'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the .
 */
angular.module('publicApp')
  .factory('ChangePassword', function($resource) {
    return $resource(
    	'api/change-password',
    	null,
    	{'query': { method: 'POST' }} );
  });