'use strict';

/**
 * @ngdoc service
 * @name publicApp.catlistFactory
 * @description
 * # catlistFactory
 * Service in the publicApp.
 */
angular.module('publicApp')
  .factory('ForgotPasswordFactory', function($resource) {
    return $resource(
    	'/api/reset-password',
    	null,
    	{'query': { method: 'POST' }} );    
  });
