'use strict';

describe('Controller: SetpasswordCtrl', function () {

  // load the controller's module
  beforeEach(module('publicApp'));

  var SetpasswordCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    SetpasswordCtrl = $controller('SetpasswordCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(SetpasswordCtrl.awesomeThings.length).toBe(3);
  });
});
