'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # productFactory
 * Service in the camApp.
 */
angular.module('publicApp')
  .factory('Loading', function($resource) {
  	var loading_value = false;
  	return {
  		loading: function() {
  			return loading_value;	
  		},
  		setLoading: function(new_value) {
  			loading_value = new_value;
  		}
    }
    
  });