'use strict';

describe('Controller: CheckoutordersummaryCtrl', function () {

  // load the controller's module
  beforeEach(module('publicApp'));

  var CheckoutordersummaryCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    CheckoutordersummaryCtrl = $controller('CheckoutordersummaryCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(CheckoutordersummaryCtrl.awesomeThings.length).toBe(3);
  });
});
