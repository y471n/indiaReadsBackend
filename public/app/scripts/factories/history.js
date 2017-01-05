'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the .
 */
angular.module('publicApp')
  .factory('HistoryFactory', function($resource) {
    return $resource(
    	'api/bookshelf/history',
    	null,
    	{'query': { method: 'POST' }} );
  });