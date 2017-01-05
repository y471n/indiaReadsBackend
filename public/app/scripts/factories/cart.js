'use strict';

/**
 * @ngdoc service
 * @name publicApp.cart
 * @description
 * # cart
 * Factory in the ireads.
 */
angular.module('publicApp')
  .factory('Cart', function() {
    	
    var cartData = [];

    return {
    	addProduct: function(id, name, isbn, initial_payable, mrp, author, rent_duration, book_library, merchant_library) {
            if(localStorage.getItem('cart')) {
                cartData = JSON.parse(localStorage.getItem('cart'));
            }
    		cartData.push({
    			book_id: id, book_name: name, 
    			isbn13: isbn, initial_payable: initial_payable, 
                mrp: mrp, author: author, rent_duration: rent_duration,
                book_library:book_library, merchant_library:merchant_library
    		});
            localStorage.setItem('cart', JSON.stringify(cartData));
    	},

    	removeProduct: function(id) {
            if(localStorage.getItem('cart')) {
                cartData = JSON.parse(localStorage.getItem('cart'));
            }
    		for (var i = 0; i < cartData.length; i++) {
    			if(cartData[i].book_id == id) {
    				cartData.splice(i, 1);
    				break;
    			}
    		};
            localStorage.setItem('cart', JSON.stringify(cartData));
    	},

        productExists: function(bookid) {
            console.log('bookid'+bookid);
            if(localStorage.getItem('cart')) {
                cartData = JSON.parse(localStorage.getItem('cart'));
            }
            for (var i = 0; i < cartData.length; i++) {
                if(cartData[i].book_id == bookid) {
                    console.log('exists');
                    return true;
                }
            }
            return false;
        },

        getSize: function() {
            if(localStorage.getItem('cart')) {
                cartData = JSON.parse(localStorage.getItem('cart'));
            }
            return cartData.length;
        },

    	getProducts: function() {
            if(localStorage.getItem('cart')) {
                cartData = JSON.parse(localStorage.getItem('cart'));
            }
    		return cartData;
    	},

        totalInitialPayable: function() {
            if(localStorage.getItem('cart')) {
                cartData = JSON.parse(localStorage.getItem('cart'));
            }
            var totalInitialPayable = 0;
            for (var i = 0; i < cartData.length; i++) {
                totalInitialPayable += cartData[i].initial_payable;
            }
            return totalInitialPayable;
        }
    }


  });
