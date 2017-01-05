'use strict';

describe('Controller: CheckoutdeliveryaddressCtrl', function () {

  // load the controller's module
  beforeEach(module('publicApp'));

  var CheckoutdeliveryaddressCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    CheckoutdeliveryaddressCtrl = $controller('CheckoutdeliveryaddressCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(CheckoutdeliveryaddressCtrl.awesomeThings.length).toBe(3);
  });
});
