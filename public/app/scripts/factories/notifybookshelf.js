'use strict';

/**
 * @ngdoc service
 * @name publicApp.catlistFactory
 * @description
 * # catlistFactory
 * Service in the publicApp.
 */
angular.module('publicApp')
  .factory('NotifyBookshelfFactory', function($resource) {
    return $resource(
    	'api/notify-on-book',
    	null,
    	{'query': { method: 'POST' }} );    
  });
