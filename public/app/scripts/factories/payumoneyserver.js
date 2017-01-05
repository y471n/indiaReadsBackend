'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the publicApp.
 */
angular.module('publicApp')
  .factory('PayuMoneyServerFactory', function($resource) {
    return $resource(
    	'https://test.payu.in/_payment',
    	null,
    	{'query': { method: 'POST' }} );
  });