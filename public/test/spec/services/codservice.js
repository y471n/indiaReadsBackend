'use strict';

describe('Service: codservice', function () {

  // load the service's module
  beforeEach(module('publicApp'));

  // instantiate service
  var codservice;
  beforeEach(inject(function (_codservice_) {
    codservice = _codservice_;
  }));

  it('should do something', function () {
    expect(!!codservice).toBe(true);
  });

});
