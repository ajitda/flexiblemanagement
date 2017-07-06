
    var purchaseApp = angular.module('purchaseApp', [ ]);

    purchaseApp.controller('purchaseController', ['$scope', '$http', function ($scope, $http) {

        $scope.qty = 0;
        $scope.unit_price = 0;
        $scope.costing = 0;
        $scope.weight = 0;
        $scope.tweight = 0;
        $scope.price_per_kg = 0;
        $scope.death_qty = 0;
        $scope.transport = 0;
        $scope.daily_stuff_salary = 0;
        $scope.others = 0;
        $scope.payment = 0;
        $scope.less = 0;
        $scope.exqty = 0;
        $scope.unitExpense = 0;

        $scope.costings = function(){
            return  $scope.qty * $scope.unit_price + +$scope.costing;
        };
        $scope.cost=  function(){
            return +$scope.transport + +$scope.daily_stuff_salary + +$scope.others;
        };

    }]);
