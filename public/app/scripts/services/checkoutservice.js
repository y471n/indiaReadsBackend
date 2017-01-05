'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # product
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('CheckoutService', function (CodFactory, PaytmFactory,$q, $sce, $rootScope, PreOrderFactory) {

  var self = {

    'preOrder': function(post_data) {
        var d = $q.defer();

        PreOrderFactory.query({rental_cart: post_data, auth_token: localStorage.getItem('auth_token')},
          function(data) {
              console.log('pre'+data);

              d.resolve(data);
            }, function(error) {
                d.reject();

          });
      return d.promise;
    },

    'postCod': function(uid, aid, poid, cart, sp, cod_charge, store_credit, total_price) {
      	  var d = $q.defer();
          console.log('er');
  		  CodFactory.query({"order_details": JSON.stringify({uid: uid, address_id: aid, parent_order_id: poid, cart: cart,
                      shipping_price: sp, cod_charge: cod_charge, store_credit: store_credit,
                      total_price: total_price})},
  		  	function(data) {
  	          console.log(data);

  	          d.resolve();
            }, function(error) {
              console.log(error);
            	  d.reject();

          });
  		return d.promise;
    },

    'postPaytm': function(post_data) {
          var d = $q.defer();

        PaytmFactory.query({cart: post_data},
          function(serverdata) {
              console.log(serverdata);
              var serverParsedData = serverdata["data"];

              var data = {
                  // redirectUrl: 'https://secure.paytm.in/oltp-web/processTransaction?orderid='+serverParsedData["ORDER_ID"],
                  redirectUrl: 'https://pguat.paytm.com/oltp-web/processTransaction?orderid='+serverParsedData["ORDER_ID"],
                  redirectMethod: 'POST',
                  redirectData: {
                      'CHANNEL_ID': serverParsedData["CHANNEL_ID"],
                      'CHECKSUMHASH': serverParsedData["CHECKSUMHASH"],
                      'CUST_ID': serverParsedData["CUST_ID"],
                      'INDUSTRY_TYPE_ID': serverParsedData['INDUSTRY_TYPE_ID'],
                      'MID': serverParsedData["MID"],
                      'ORDER_ID': serverParsedData["ORDER_ID"],
                      'TXN_AMOUNT': serverParsedData["TXN_AMOUNT"],
                      'WEBSITE': serverParsedData["WEBSITE"]
                  }
              };
              data.redirectUrl = $sce.trustAsResourceUrl(data.redirectUrl)
              $rootScope.$broadcast('gateway.redirect', data);

              // d.resolve();
            }, function(error) {
                // d.reject();

          });
      // return d.promise;
    }
  };
  return self;
});
