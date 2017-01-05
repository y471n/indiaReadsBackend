'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the publicApp.
 */
angular.module('publicApp')
  .factory('PayuMoneyFactory', function($resource) {
    return $resource(
    	'api/order/payumoney',
    	null,
    	{'query': { method: 'POST' }} );
  });