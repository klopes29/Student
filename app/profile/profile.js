'use strict';
var app = angular.module('webApp.profile', ['ngRoute', 'firebase', 'chieffancypants.loadingBar'])

.config(['$routeProvider', function($routeProvider){
	$routeProvider.when('/profile', {
		templateUrl: 'profile/profile.html',
		controller: 'ProfileCtrl'
	});
}])

.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
})

.controller('ProfileCtrl',['$scope', 'CommonProp', '$firebaseArray', '$firebaseObject', '$location', '$filter', 'cfpLoadingBar', function($scope, CommonProp, $firebaseArray, $firebaseObject, $location, $filter, cfpLoadingBar) {
	$scope.username = CommonProp.getUser();
	$scope.commonvar = [];

	cfpLoadingBar.start();
	// var message = "Loading list...";
 //   	LoaderService.showLoader(message);

	var success = getParameterByName('success');
	$scope.commonvar.success_flag = 0;
	if(success == 1){
		$scope.commonvar.success_flag = 1;
	}

	if(!$scope.username) {
		$location.path('/home');
	}
	$scope.commonvar.flag = 0;
	var ref = firebase.database().ref("Service");
	var services_fb = $firebaseObject(ref);

	services_fb.$loaded().then(function() {
		var user_ref = firebase.database().ref("Users/"+firebase.auth().currentUser.uid);
		var users_fb = $firebaseObject(user_ref);
		
		var user_ref_1 = firebase.database().ref("Users");
		$scope.Users = $firebaseArray(user_ref_1);
		
		$scope.commonvar.show_active = 1;
		users_fb.$loaded().then(function() {
			$scope.addreses = [];
			angular.forEach(users_fb, function(values,keys){
				if(keys == 'Addresses'){
					angular.forEach(values, function(value,key){
						$scope.addreses.push({ id: key, data: value})	
						//$scope.value = value; 
					});
				} else {
					$scope.h_name = values;
				}
			})
			$scope.id = firebase.auth().currentUser.uid;
			$scope.commonvar.flag = 1;
			$scope.commonvar.show_active = 1;
		});
		cfpLoadingBar.complete();
		//LoaderService.hideLoader();
	});

	$scope.addreses=[];
	$scope.addMore=function(){
		var len_cnt = $scope.addreses.length;
		var len_cnt = len_cnt + 1;
		$scope.addreses.push({id:len_cnt});
	};

	$scope.remove=function(id){
		var lightBoxEl = document.getElementById('textarea_'+id);
		var lightBoxEl1 = document.getElementById('label_'+id);
		var lightBoxEl2 = document.getElementById('button_'+id);
		//console.log(id);
		//return false;
		lightBoxEl.remove();
		lightBoxEl1.remove();
		lightBoxEl2.remove();
	};


	$scope.saveprofile = function(e) {
		var id = $scope.id;
        var record = $scope.Users.$getRecord(id);
       	//console.log($scope);
        //console.log(record);

        $scope.address_arr = [];
        angular.forEach($scope.addreses, function(value,key){
        	$scope.address_arr[value['id']] = value['data'];	
		});
        //console.log($scope.address_arr);
        //return false;

       	record.Name = $scope.h_name;
       	record.Addresses = $scope.address_arr;

       	$scope.Users.$save(record).then(function(ref){
       		console.log(ref.key);
       		$location.path('/profile').search({success: '1'});;
       	});
		
	};

	$scope.back = function(e) {
		$location.path('/menu');
	};

	function getParameterByName(name, url) {
	    if (!url) {
	      url = window.location.href;
	    }
	    name = name.replace(/[\[\]]/g, "\\$&");
	    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
	        results = regex.exec(url);
	    if (!results) return null;
	    if (!results[2]) return '';
	    return decodeURIComponent(results[2].replace(/\+/g, " "));
	}
}])