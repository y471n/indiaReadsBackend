'use strict';

describe('Service: catlist', function () {

  // load the service's module
  beforeEach(module('publicApp'));

  // instantiate service
  var catlist;
  beforeEach(inject(function (_catlist_) {
    catlist = _catlist_;
  }));

  it('should do something', function () {
    expect(!!catlist).toBe(true);
  });

});
