'use strict';

/**
 * @ngdoc service
 * @name publicApp.catlistFactory
 * @description
 * # catlistFactory
 * Service in the publicApp.
 */
angular.module('publicApp')
  .factory('SetNewPasswordFactory', function($resource) {
    return $resource(
    	'api/set-new-password',
    	null,
    	{'query': { method: 'POST' }} );
  });
