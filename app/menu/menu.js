'use strict';

angular.module('webApp.menu', ['ngRoute', 'firebase'])

.config(['$routeProvider', function($routeProvider){
	$routeProvider.when('/menu', {
		templateUrl: 'menu/menu.html',
		controller: 'MenuCtrl'
	});
}])

.controller('MenuCtrl',['$scope', 'CommonProp', '$firebaseArray', '$firebaseObject', '$location', function($scope, CommonProp, $firebaseArray, $firebaseObject, $location) {
	$scope.username = CommonProp.getUser();

	if(!$scope.username) {
		$location.path('/home');
	}

	$scope.logout = function() {
		CommonProp.logoutUser();
	}

}])