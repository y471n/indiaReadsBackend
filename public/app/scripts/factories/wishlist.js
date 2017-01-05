'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the .
 */
angular.module('publicApp')
  .factory('Wishlist', function($resource) {
    return $resource(
    	'api/bookshelf/wishlist',
    	null,
    	{'query': { method: 'POST' }} );
  });