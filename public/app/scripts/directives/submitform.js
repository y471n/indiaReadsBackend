'use strict';

angular.module('publicApp')

 // .directive('autoSubmitForm', function () {
 //    return {
 //        template: 'Name: {{customer.name}}<br /> Street: {{customer.street}}'
 //    };
// });

  .directive('autoSubmitForm', ['$timeout', function($timeout) {
    return {
        replace: true,
        scope: {},
        template: '<form action="{{formData.redirectUrl}}" method="{{formData.redirectMethod}}">'+
                      '<div ng-repeat="(key,val) in formData.redirectData">'+
                           '<input type="hidden" name="{{key}}" value="{{val}}" />'+
                      '</div>'+
                  '</form>',
        link: function($scope, element, $attrs) {
            $scope.$on($attrs['event'], function(event, data) {
                $scope.formData = data;
                console.log('redirecting now!');
                $timeout(function() {
                    element.submit();
                })
             })
        }
    }
}]);