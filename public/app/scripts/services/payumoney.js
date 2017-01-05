'use strict';

/**
 * @ngdoc service
 * @name publicApp.payumoney
 * @description
 * # payumoney
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('PayuMoneyService', function (PayuMoneyFactory, PayuMoneyServerFactory, $q, $rootScope, $sce) {

    var self = {
   
      'loadPayment': function() {
          var d = $q.defer();

        	self.loading = true;
    		  PayuMoneyFactory.query({}, function(serverdata) {
              var serverParsedData = JSON.parse(serverdata["data"]);
              console.log(serverParsedData);
                
              // d.resolve(data);

              var data = {
                  redirectUrl: 'https://test.payu.in/_payment',
                  redirectMethod: 'POST',
                  redirectData: {
                      'key': serverParsedData["key"],
                      'txnid': serverParsedData["txnid"],
                      'amount': serverParsedData["amount"],
                      'productinfo': serverParsedData['productinfo'],
                      'firstname': serverParsedData["firstname"],
                      'email': serverParsedData["email"],
                      'phone': serverParsedData["phone"],
                      'surl': serverParsedData["surl"],
                      'furl': serverParsedData["furl"],
                      'hash': serverParsedData["hash"],
                      'service_provider': serverdata["data"]["service_provider"]
                  }
              };
              data.redirectUrl = $sce.trustAsResourceUrl(data.redirectUrl)
              $rootScope.$broadcast('gateway.redirect', data);


              // PayuMoneyServerFactory.query({key: key, amount: amount, email: email,
              //         firstname: firstname, furl: furl, hash: hash, phone: phone, 
              //         productinfo: productinfo, service_provider: service_provider,
              //         surl: surl, txnid: txnid}, function(data) {

              //       console.log(data);

              // });

            }, function(error) {
	              console.log("error");
            });

          return d.promise;
    	}

    };
    
    return self;

  });
