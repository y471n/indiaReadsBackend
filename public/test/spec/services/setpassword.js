'use strict';

describe('Service: setpassword', function () {

  // load the service's module
  beforeEach(module('publicApp'));

  // instantiate service
  var setpassword;
  beforeEach(inject(function (_setpassword_) {
    setpassword = _setpassword_;
  }));

  it('should do something', function () {
    expect(!!setpassword).toBe(true);
  });

});
