'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the publicApp.
 */
angular.module('publicApp')
  .factory('AddToBookshelfFactory', function($resource) {
    return $resource(
    	'api/add-to-bookshelf',
    	null,
    	{'query': { method: 'POST' }} );
  });