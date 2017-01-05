'use strict';

describe('Service: deliveryaddress', function () {

  // load the service's module
  beforeEach(module('publicApp'));

  // instantiate service
  var deliveryaddress;
  beforeEach(inject(function (_deliveryaddress_) {
    deliveryaddress = _deliveryaddress_;
  }));

  it('should do something', function () {
    expect(!!deliveryaddress).toBe(true);
  });

});
