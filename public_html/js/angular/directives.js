app.directive('hgVeticalCalendar', function {
  return {
    restrict: 'E',
    template-url: 'angular-templates/hg-vetical-calendar.html',
    scope: {
      ngModel: '=model',
      hgTrigger: '=trigger',
      hgFilter: 'filter'
    },
    controller: function($scope) {

      $scope.activeYear = 0;
      $scope.monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

      var selectedDate = {year: -1, month: -1};

      $scope.dateSelected = function(year, month) {
        selectedDate.year = year;
        selectedDate.month = month;

        trigger(year, month);
      }

      $scope.filter = function(value, index, array) {
        if(selectedDate.year === -1) {
          return true;
        }

        return value.date.getFullYear() === selectedDate.year && value.date.getMonth() === selectedDate.month;
      }

      function calcDates() {
        $scope.years = [];
        $scope.months = [];

        var yearIndex;
        var monthIndex;

        for (var d = 0; d < $scope.model.length; d++) {

          //Save the year index for later.
          yearIndex = $scope.years.indexOf($scope.model[d].getFullYear());

          //Check if the next year is already in years array.
          //If not, add it.
          //Don't forget to save the index!
          //And we create a new index in the months array
          if(yearIndex == -1) {
            $scope.years.push($scope.model[d].getFullYear());
            yearIndex = $scope.years.length - 1;
            $scope.months.push([]);
          }

          //Save the month index for later
          monthIndex = $scope.months[yearIndex].indexOf($scope.model[d].getMonth());

          //Check if the next month is already in the months array corresponding to the year
          //If not, add it!
          if(monthIndex == -1) {
            $scope.months[yearIndex].push($scope.model[d].getMonth());
          }
        }
      }

      $scope.$watch('model', clacDates);
    }
  }
});
