app.controller('MainController', function($scope) {

})
.controller('DownloadsCtlr', function($scope, $http) {
  $scope.downloadables = [];
  $scope.dates = {};
  $scope.activeYear = 0;
  $scope.monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

  function calcDates() {
    $scope.dates.years = [];
    $scope.dates.months = [[]];

    var yearsArray = $scope.dates.years;
    var monthsArray = $scope.dates.months;

    var yearExists;
    var yearIndex;
    var monthExists;
    var aYear;
    var aMonth;

    for (var d = 0; d < $scope.downloadables.length; d++) {

      console.log($scope.downloadables[d]);

      //Make the date string a date object
      $scope.downloadables[d].datePublished = new Date($scope.downloadables[d].datePublished);

      //Get the downloadable's year
      //Get it's month too
      aYear = $scope.downloadables[d].datePublished.getFullYear();
      aMonth = $scope.downloadables[d].datePublished.getMonth();

      //Passing through years array
      for (var y = 0; y < yearsArray.length; y++) {

        //$scope.downloadables[d].datePublished = new Date($scope.downloadables[d].datePublished);

        //Check if the downloadable's year is already in years array.
        //Save the year index for later.
        if(yearsArray[y] == aYear) {
          yearIndex = y;
          yearExists = true;
        }
      }

      //If not, add it.
      //Don't forget to save the index!
      //And we create a new index in the months array
      if(!yearExists) {
        yearsArray.push(aYear);
        yearIndex = yearsArray.length - 1;
        monthsArray.push([]);
      }

      //Pass through the months array corresponding to the year.
      //Remember: The years and months arrays are always the same size!
      for (var m = 0; m < monthsArray[yearIndex].length; m++) {

        //Check if month is already in months array.
        if(monthsArray[yearIndex][i] == aMonth) {
          monthExists = true;
        }
      }

      //If not add it.
      if(!monthExists) {
        monthsArray[yearIndex].push(aMonth);
      }
    }
  }

  $http.get('Papers/ajaxGetPapers').then(function(response) {
    $scope.downloadables = response.data;
    calcDates();
  }, function(error) {
    console.log(error);
  });
});
