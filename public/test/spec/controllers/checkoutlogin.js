'use strict';

describe('Controller: CheckoutloginCtrl', function () {

  // load the controller's module
  beforeEach(module('publicApp'));

  var CheckoutloginCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    CheckoutloginCtrl = $controller('CheckoutloginCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(CheckoutloginCtrl.awesomeThings.length).toBe(3);
  });
});
