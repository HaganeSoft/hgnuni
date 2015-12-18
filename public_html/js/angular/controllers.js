app.controller('MainController', function($scope) {

})
.controller('DownloadsCtlr', function($scope, $http) {
  $scope.downloadables = [];
  $scope.dateFilter;



  $http.get('Papers/ajaxGetPapers').then(function(response) {
    $scope.downloadables = response.data;
  }, function(error) {
    console.log(error);
  });

});
