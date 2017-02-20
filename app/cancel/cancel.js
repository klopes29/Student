'use strict';

angular.module('webApp.cancel', ['ngRoute', 'firebase', 'chieffancypants.loadingBar'])

.config(['$routeProvider', function($routeProvider){
	$routeProvider.when('/cancel', {
		templateUrl: 'cancel/cancel.html',
		controller: 'CancelCtrl'
	});
}])

.config(function(cfpLoadingBarProvider) {
		cfpLoadingBarProvider.includeSpinner = true;
})

.controller('CancelCtrl',['$scope', 'CommonProp', '$firebaseArray', '$firebaseObject', '$location', '$filter', 'cfpLoadingBar', '$q', function($scope, CommonProp, $firebaseArray, $firebaseObject, $location, $filter, cfpLoadingBar, $q) {
	console.log('aaaaa');
	cfpLoadingBar.start();
	$scope.username = CommonProp.getUser();

	if(!$scope.username) {
		$location.path('/home');
	}


	var transaction = firebase.database().ref("Transactions");
	var transaction_object = $firebaseObject(transaction);

	// console.log("Transactions/"+firebase.auth().currentUser.uid);
	// return false;
	// console.log(ref_transaction_object);
	var time_map = [];
	time_map['1'] = '10:00 am';
	time_map['2'] = '11:00 am';
	time_map['3'] = '12:00 pm';
	time_map['4'] = '01:00 am';
	time_map['5'] = '02:00 pm';
	time_map['6'] = '03:00 pm';
	time_map['7'] = '04:00 pm';
	time_map['8'] = '05:00 pm';
	time_map['9'] = '06:00 pm';

	

	transaction_object.$loaded().then(function() {
		var ref_transaction = firebase.database().ref("Transactions/"+firebase.auth().currentUser.uid);
		var ref_transaction_object = $firebaseObject(ref_transaction);
		ref_transaction_object.$loaded().then(function() {
			$scope.previousorders = [];
			angular.forEach(ref_transaction_object, function(value,key){
				var week_format = 'EEE';
				var week_name = $filter('date')(value.date_full_string, week_format);
				var date_format = 'MMM MM';
				var date_string = $filter('date')(value.date_full_string, date_format);
				var time_format = time_map[value.time];

				if(value.show_movetypes == '1'){
					var clean_name = value.types + ' (' + value.movetypes + ')';
				} else {
					var clean_name = value.types;
				}
				$scope.previousorders.push({ week_name: value.tran_id,  week_name: week_name, date_string: date_string, time_format: time_format, clean_name: clean_name});
				//console.log($scope.previousorders);
				//return false;
				cfpLoadingBar.complete();
			})
			cfpLoadingBar.complete();
		});
	});

	$scope.cancel = function(e) {
		console.log('in cancel');
		return false;

		var format = 'dd-MM-yyyy';
		var date_tran = $filter('date')($scope.h_dot, format);
		
		var format = 'yyyyMMddHHmmss';
		var current_date = new Date();
		var tran_id = $filter('date')(current_date, format);
		if($scope.hasOwnProperty('h_movetypes')){
			var movetypes = $scope.h_movetypes;
		} else {
			var movetypes = $scope.h_movetypes1;
		}
		
		var hours_array = [];
		for (var i = $scope.h_time; i <= $scope.h_hour_value; i++) {
		  hours_array.push(i);
		}
		
		var ref_allocted = firebase.database().ref('Employee Allocation/Unallocated/'+date_tran+'/').limitToFirst($scope.h_hour_value);
		var ref_allocted_1 = firebase.database().ref('Employee Allocation/Unallocated/'+date_tran);
		var allocated_obj = $firebaseArray(ref_allocted);
		allocated_obj.$loaded().then(function() {
			var emp_array = [];
			angular.forEach(allocated_obj, function(value,key, _ary){
				if(value.length != undefined){
					emp_array[key] = value;	
				} else {
					emp_array[key] = [];
					var temp_var = Object.values(value);
					emp_array[key][temp_var[1]] = temp_var[0];
				}
			});
			var result = emp_array.shift().filter(function(v) {
			  return emp_array.every(function(a) {
			    return a.indexOf(v) !== -1;
			  });
			});
			
			if(result[0] != undefined){
				var emp_name = result[0];
				var emp_data = firebase.database().ref('Employees/').orderByChild('name').equalTo(emp_name);
				var emp_obj = $firebaseArray(emp_data);
				emp_obj.$loaded().then(function() {
					var emp_id = emp_obj[0]['$id'];
					var allocated_transaction = firebase.database().ref("Employee Allocation/");
					for (var keys in hours_array) {
						allocated_transaction.child('Allocated').child(date_tran).child(hours_array[keys]).child(emp_id).set({
							name : emp_name,
							tran_id : tran_id,
						});
						ref_allocted_1.child(hours_array[keys]).child(emp_id).set(null);
					}
					//allocated_transaction.child('Unallocated').child(date_tran).child($scope.h_time).child(emp_id).$remove();		
					ref_transaction.child(firebase.auth().currentUser.uid).child(tran_id).set({
						name : firebase.auth().currentUser.displayName,
						email : firebase.auth().currentUser.email,
						uid : firebase.auth().currentUser.uid,
						services: $scope.h_services,
						types:  $scope.h_types,
						movetypes:  movetypes,
						rate_value:  $scope.h_rate_value,
						dot:  date_tran,
						tran_id:  tran_id,
						emp_id:  emp_id,
						emp_name:  emp_name,
						time:  $scope.h_time,
						user_address:  $scope.h_user_address,
					});
					$location.path('/menu');
				});
			} 
		});
		console.log('out');
		return false;
		

		// var employee_found = false;
		// var check_for = 1;
		// while(employee_found == false){
		// 	console.log('in while');
		// 	var emp_dat = getemployee_data(hours_array, check_for, date_tran, $firebaseArray);
		// 	console.log('emp_dat');
		// 	console.log(emp_dat);
		// 	return false;
		// 	// if(emp_dat !== false){
		// 	// 	break;
		// 	// }
		// 	check_for ++;
		// }
		
	};

	$('.datepicker').pickadate({
			formatsubmit: 'dd-mm-yyyy',
			format: 'dd-mm-yyyy',
			onSet: function(context) {
				$scope.h_dot = new Date(context['select']);
			}
	});

	$scope.back = function(e) {
		$location.path('/menu');
	}
}])
