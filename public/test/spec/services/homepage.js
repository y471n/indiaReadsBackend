'use strict';

describe('Service: homepage', function () {

  // load the service's module
  beforeEach(module('publicApp'));

  // instantiate service
  var homepage;
  beforeEach(inject(function (_homepage_) {
    homepage = _homepage_;
  }));

  it('should do something', function () {
    expect(!!homepage).toBe(true);
  });

});
