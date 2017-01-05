'use strict';

/**
 * @ngdoc service
 * @name publicApp.catlist
 * @description
 * # catlist
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('CatListService', function (ParentCatBooks, SuperCatBooks, Category, Cat1Books, Cat2Books, $q) {
    // AngularJS will instantiate a singleton by calling "new" on this function

    var self = {
      'books': [],
      'page': 1,
      'hasMore': true,
      'isLoading': false,
      'categories': [],

      'loadCategories' : function(categoryid) {

        self.categories = [];
        
        var b=$q.defer();
        var params = {parent_id: categoryid};
        Category.query(params, function(data) {
            console.log(data);
            angular.forEach(data["data"], function(category) {
              self.categories.push(new Category(category));
            });
	    b.resolve();
        });
          return b.promise;
      },

      'loadParentBooks': function(parentId) {
        console.log('calling books');
        var b=$q.defer();
        if(self.hasMore && !self.isLoading) {
             self.isLoading = true;
      		  ParentCatBooks.query({parentid: parentId, page: self.page}, function(data) {
      	          console.log(data);

                  if(data["next_page_url"] != null) {
                      self.hasMore = true;
                      self.page += 1;
                  } else {
                      self.hasMore = false;
                  }
      	          angular.forEach(data["data"]["in_stock"], function(book) {
		    book.in = true;
      	            self.books.push(new ParentCatBooks(book));
      	          });
		  angular.forEach(data["data"]["out_of_stock"], function(book) {
                    book.in = false;
      	            self.books.push(new ParentCatBooks(book));
		    console.log(book);
      	          });
		  b.resolve();
                  self.isLoading = false;
                  }, function(error) {
                    console.log("error");
                });
        }
          return b.promise;
      },

      'loadCat1Books': function(cat1Id) {
        console.log('calling books');

        var b=$q.defer();
        if(self.hasMore && !self.isLoading) {
             self.isLoading = true;
              Cat1Books.query({cat1id: cat1Id, page: self.page}, function(data) {
                  console.log(data);

                  if(data["next_page_url"] != null) {
                      self.hasMore = true;
                      self.page += 1;
                  } else {
                      self.hasMore = false;
                  }

		  angular.forEach(data["data"]["in_stock"], function(book) {
      	            self.books.push(new Cat1Books(book));
      	          });

		  angular.forEach(data["data"]["out_of_stock"], function(book) {
      	            self.books.push(new Cat1Books(book));
		    console.log(book);
      	          });

                  self.isLoading = false;
		  b.resolve();
                  }, function(error) {
                    console.log("error");
                });
        }
	return b.promise;

      },

      'loadCat2Books': function(cat2Id) {
        // console.log('calling books'+cat2id);

        var b=$q.defer();
        if(self.hasMore && !self.isLoading) {
             self.isLoading = true;
              Cat2Books.query({cat2id: cat2Id, page: self.page}, function(data) {
                  console.log(data);

                  if(data["next_page_url"] != null) {
                      self.hasMore = true;
                      self.page += 1;
                  } else {
                      self.hasMore = false;
                  }

                  angular.forEach(data["data"]["in_stock"], function(book) {
      	            self.books.push(new Cat2Books(book));
      	          });

		  angular.forEach(data["data"]["out_of_stock"], function(book) {
      	            self.books.push(new Cat2Books(book));
		    console.log(book);
      	          });
		  b.resolve();
                  self.isLoading = false;
                  }, function(error) {
                    console.log("error");
                });
        }
	return b.promise;
      },


      'loadSuperBooks': function(superId) {

        if(self.hasMore && !self.isLoading) {
             self.isLoading = true;
              SuperCatBooks.query({superid: superId, page: self.page}, function(data) {
                  console.log(data);

                  if(data["next_page_url"] != null) {
                      self.hasMore = true;
                      self.page += 1;
                  } else {
                      self.hasMore = false;
                  }
                  angular.forEach(data["data"], function(book) {
                    self.books.push(new SuperCatBooks(book));
                  });
                  self.isLoading = false;
                  }, function(error) {
                    console.log("error");
                });
        }

      }
    };
    return self;
  });
