'use strict';

describe('Service: bookshelf', function () {

  // load the service's module
  beforeEach(module('publicApp'));

  // instantiate service
  var bookshelf;
  beforeEach(inject(function (_bookshelf_) {
    bookshelf = _bookshelf_;
  }));

  it('should do something', function () {
    expect(!!bookshelf).toBe(true);
  });

});
