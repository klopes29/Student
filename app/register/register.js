'use restrict';

angular.module('webApp.register', ['ngRoute', 'firebase', 'chieffancypants.loadingBar'])

.config(['$routeProvider', function($routeProvider){
	$routeProvider.when('/register', {
		templateUrl: 'register/register.html',
		controller: 'RegisterCtrl'
	});
}])

.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
})

.controller('RegisterCtrl', ['$scope', 'CommonProp', '$firebaseAuth', '$location', '$firebaseArray', '$firebaseObject', 'cfpLoadingBar', function($scope, CommonProp, $firebaseAuth, $location, $firebaseArray, $firebaseObject, cfpLoadingBar) {

	$scope.username = CommonProp.getUser();
	if($scope.username) {
		$location.path('/menu');
	}
	
	$scope.signUp = function() {
		var username = $scope.user.email;
		var password = $scope.user.password;

		if(username && password) {
			var auth = $firebaseAuth();
			auth.$createUserWithEmailAndPassword(username, password).then(function() {
				$scope.errorMsg = false;
				$location.path('/menu');
				
			}).catch(function(error) {
				$scope.errorMsg = true;
				$scope.errorMessage = error.message;
			})
		}
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
			//$scope.errorMsg = false;
			//CommonProp.setUser(result.user.email);
			//$location.path('/menu');
		}).catch(function(error) {
			$scope.errorMsg = true;
			$scope.errorMessage = error;
		  	
		});
	}
}])