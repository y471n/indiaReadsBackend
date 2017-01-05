'use strict';

/**
 * @ngdoc service
 * @name publicApp.homepage
 * @description
 * # homepage
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('EditMyProfileService', function (EditMyProfileFactory, $q) {
    // AngularJS will instantiate a singleton by calling "new" on this function
    var self = {
      'updateProfile': function(update_data) {
          var format_to = 'YYYY-MM-DD';
          var sending_date = moment(update_data.birthdate).format(format_to);
          console.log(moment(update_data.birthdate).format(format_to));
          var b=$q.defer();
          console.log(update_data.firstName);
          console.log(update_data.lastName);
          console.log(update_data.alternateEmail);
          console.log(sending_date);
          console.log(update_data.gender);
          console.log(update_data.landline);
          console.log(update_data.mobile);
    		  EditMyProfileFactory.query({
                        'first_name': update_data.firstName,
                        'last_name': update_data.lastName,
                        'alternate_email': update_data.alternateEmail,
                        'birthdate': sending_date,
                        'gender': update_data.gender,
                        'mobile': update_data.mobile,
                        'landline': update_data.landline
                    , auth_token: localStorage.getItem('auth_token')}, function(data) {
              console.log(data);              
              b.resolve(data);
            }, function(error) {
              console.log("error");
            });
          return b.promise;
    	}
    };
    
    // self.loadTrendingBooks();
   // self.loadRecommendedBooks();
    // self.loadNewBooks();
    return self;
  });
