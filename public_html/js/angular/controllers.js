app.controller('MainController', function($scope) {

})
.controller('DownloadsCtlr', function($scope, $http) {
  $scope.downloadables = [];
  $scope.dates = [];

  var selectedMonth, selectedYear = -1;

  $scope.dateSelected = function(year, month) {
    selectedMonth = month;
    selectedYear = year;
  }

  $scope.dateFilter = function(value, index, array) {
    if(selectedYear === -1) {
      return true;
    } else if(selectedMonth === -1) {
      return value.date_published.getFullYear() == selectedYear;
    } else {
      return value.date_published.getFullYear() == selectedYear && value.date_published.getMonth() == selectedMonth;
    }
  }

  $http.get('Papers/ajaxGetPapers').then(function(response) {
    $scope.downloadables = response.data;

    for (var i = 0; i < $scope.downloadables.length; i++) {
      //Make the date string a date object
      $scope.downloadables[i].date_published = new Date($scope.downloadables[i].date_published);

      //Add it to the dates array
      $scope.dates.push($scope.downloadables[i].date_published);
    }
  }, function(error) {
    console.log(error);
  });
});
