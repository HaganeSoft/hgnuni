app.controller('MainController', function($scope) {

})
.controller('DownloadsCtlr', function($scope, $http) {
  $scope.downloadables = [];
  $scope.dates = [];

  for (var i = 0; i < $scope.downloadables.length; i++) {
    //Make the date string a date object
    $scope.downloadables[i].datePublished = new Date($scope.downloadables[i].datePublished);

    //Add it to the dates array
    $scope.dates.push($scope.downloadables[i].datePublished);
  }

  $http.get('Papers/ajaxGetPapers').then(function(response) {
    $scope.downloadables = response.data;
  }, function(error) {
    console.log(error);
  });

});
