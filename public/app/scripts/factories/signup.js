'use strict';

/**
 * @ngdoc service
 * @name publicApp.catlistFactory
 * @description
 * # catlistFactory
 * Service in the publicApp.
 */
angular.module('publicApp')
  .factory('SignupFactory', function($resource) {
    return $resource(
    	'/api/signup',
    	null,
    	{'query': { method: 'POST' }} );    
  });
