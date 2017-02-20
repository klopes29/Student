'use strict';

angular.module('webApp.home', ['ngRoute', 'firebase', 'chieffancypants.loadingBar'])

.config(['$routeProvider', function($routeProvider){
	$routeProvider.when('/home', {
		templateUrl: 'home/home.html',
		controller: 'HomeCtrl'
	});
}])

.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
})

.controller('HomeCtrl',['$scope', '$firebaseAuth', '$location', 'CommonProp', '$firebaseArray', '$firebaseObject', 'cfpLoadingBar', function($scope, $firebaseAuth, $location, CommonProp, $firebaseArray, $firebaseObject, cfpLoadingBar) {

	$scope.username = CommonProp.getUser();

	if($scope.username) {
		$location.path('/menu');
	}
	$scope.signIn = function() {
		var username = $scope.user.email;
		var password = $scope.user.password;
		var auth = $firebaseAuth();

		auth.$signInWithEmailAndPassword(username, password).then(function() {
			$scope.errorMsg = false;
			CommonProp.setUser($scope.user.email);
			$location.path('/menu');
		}).catch(function(error){
			$scope.errorMsg = true;
			$scope.errorMessage = error.message;
		})
	}

	$scope.login = function() {

		var auth = $firebaseAuth();
		auth.$signInWithPopup("google").then(function(result) {
			cfpLoadingBar.start();
		  	$scope.errorMsg = false;
		  	//var user_ref = firebase.database().ref("Users");
		  	var user_ref = firebase.database().ref("Users/"+result.user.uid);
			var users_fb = $firebaseObject(user_ref);
			var is_exist = 0;
			users_fb.$loaded().then(function() {
				var is_exist = 0;
				//console.log(users_fb);
				angular.forEach(users_fb, function(value,key, _ary){
					//console.log(value);
					is_exist = 1;
				})
				//console.log(is_exist);
				if(is_exist == 0){
					var user_ref_1 = firebase.database().ref("Users");
					user_ref_1.child(result.user.uid).set({
				    	Name : result.user.displayName,
				    	Email: result.user.email,
				    });
				}
				CommonProp.setUser(result.user.email);
				cfpLoadingBar.complete();
				$location.path('/menu');
			});
		}).catch(function(error) {
			$scope.errorMsg = true;
			$scope.errorMessage = error;
		  	
		});
	}
}])

.service('CommonProp', ['$location', '$firebaseAuth', function($location, $firebaseAuth){
	var user = "";
	var auth = $firebaseAuth();

	return {
		getUser : function() {
			if(user == "") {
				user = localStorage.getItem("userEmail");
			}
			return user;
		},
		setUser : function(value) {
			localStorage.setItem("userEmail", value);
			user = value;
		},
		logoutUser : function() {
			auth.$signOut();
			console.log("Logged Out Successfully");
			user = "";
			localStorage.removeItem("userEmail");
			$location.path('/home');
		}
	};
}])