'use strict';

describe('Service: payumoney', function () {

  // load the service's module
  beforeEach(module('publicApp'));

  // instantiate service
  var payumoney;
  beforeEach(inject(function (_payumoney_) {
    payumoney = _payumoney_;
  }));

  it('should do something', function () {
    expect(!!payumoney).toBe(true);
  });

});
