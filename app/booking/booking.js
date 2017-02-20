'use strict';

angular.module('webApp.booking', ['ngRoute', 'firebase', 'chieffancypants.loadingBar'])

.config(['$routeProvider', function($routeProvider){
	$routeProvider.when('/booking', {
		templateUrl: 'booking/booking.html',
		controller: 'BookingCtrl'
	});
}])

.config(function(cfpLoadingBarProvider) {
		cfpLoadingBarProvider.includeSpinner = true;
})

.controller('BookingCtrl',['$scope', 'CommonProp', '$firebaseArray', '$firebaseObject', '$location', '$filter', 'cfpLoadingBar', '$q', function($scope, CommonProp, $firebaseArray, $firebaseObject, $location, $filter, cfpLoadingBar, $q) {
	cfpLoadingBar.start();
	$scope.username = CommonProp.getUser();

	if(!$scope.username) {
		$location.path('/home');
	}
	
	var ref = firebase.database().ref("Service");
	var services_fb = $firebaseObject(ref);

	var ref_transaction = firebase.database().ref("Transactions");

	services_fb.$loaded().then(function() {
		$scope.services = [];
		angular.forEach(services_fb, function(value,key){
			$scope.services.push({ id: key, data: value})
		})

		var user_ref = firebase.database().ref("Users/"+firebase.auth().currentUser.uid);
		var users_fb = $firebaseObject(user_ref);

		users_fb.$loaded().then(function() {
			$scope.user_address = [];
			angular.forEach(users_fb, function(values,keys){
				if(keys == 'Addresses'){
					angular.forEach(values, function(value,key){
						$scope.user_address.push({ id: value, data: value})	
					});
				}
			})
			cfpLoadingBar.complete();
		});
	});



	$scope.commonvar = [];
	$scope.commonvar.flag = 0;
	$scope.commonvar.show_active = 0;
	
	$scope.changeType = function() {
		var newstring = $scope.h_services;
		var ref = firebase.database().ref("Service/"+newstring);
		var types_fb = $firebaseObject(ref);

		types_fb.$loaded().then(function() {
			 $scope.types = [];
			 angular.forEach(types_fb, function(value,key){
					$scope.types.push({ id: key, data: key})
			 })
			 //console.log($scope.types);
		});
	};

	$scope.changesize = function() {
		var newstring = $scope.h_services;
		var newstring_1 = $scope.h_types;
		var ref = firebase.database().ref("Service/"+newstring+'/'+newstring_1);
		var movetypes_fb = $firebaseObject(ref);
		var movetypes_array = $firebaseArray(ref);
		
		movetypes_fb.$loaded().then(function() {
			$scope.movetypes = [];
			$scope.commonvar = [];
			angular.forEach(movetypes_fb, function(values,keys){
				$scope.movetypes.push({ hours: values.Hours, rate: values.Rate, id: keys})
			})
			$scope.commonvar.flag = 0;
			$scope.commonvar.show_active = 1;
			if(movetypes_array.length == '1'){
				$scope.commonvar.flag = 1;
				$scope.h_movetypes1 = $scope.movetypes[0]['id'];

				$scope.h_rate_value = $scope.movetypes[0]['rate'];
				$scope.h_hour_value = $scope.movetypes[0]['hours'];
			} else {
				$scope.commonvar.show_active = 0;
				$scope.h_movetypes1 = '';
				$scope.h_rate_value = '';
				$scope.h_hour_value = '';
				if($scope.h_movetypes != ''){
					$scope.commonvar.show_active = 1;
					angular.forEach(movetypes_fb, function(value,key){
						if($scope.h_movetypes == key){
							$scope.h_rate_value = value.Rate;
							$scope.h_hour_value = value.Hours;
						}
					})
				}
			}
		});
	};

	$scope.chnagemovetype = function() {
		var newstring = $scope.h_services;
		var newstring_1 = $scope.h_types;
		var newstring_2 = $scope.h_movetypes;
		var ref = firebase.database().ref("Service/"+newstring+'/'+newstring_1);
		var movetypes_fb = $firebaseObject(ref);
		movetypes_fb.$loaded().then(function() {
			$scope.commonvar = [];
			angular.forEach(movetypes_fb, function(value,key){
				if(key == newstring_2){
					$scope.h_rate_value = value.Rate;		
					$scope.h_hour_value = value.Hours;		
				}
			})
			$scope.commonvar.flag = 0;
			$scope.commonvar.show_active = 1;
		});
	};

	$scope.book = function(e) {
		var format = 'dd-MM-yyyy';
		var date_tran = $filter('date')($scope.h_dot, format);

		var format1 = 'yyyy-MM-dd';
		var full_date_string = $filter('date')($scope.h_dot, format1);
		// var format1 = 'EEE';
		// var week_name = $filter('date')($scope.h_dot, format1);

		// var format1 = 'MMM MM';
		// var week_name = $filter('date')($scope.h_dot, format1);
		
		// console.log(full_date_string);
		// return false;
		
		var format = 'yyyyMMddHHmmss';
		var current_date = new Date();
		var tran_id = $filter('date')(current_date, format);
		if($scope.hasOwnProperty('h_movetypes')){
			var movetypes = $scope.h_movetypes;
			var show_movetypes = 1;
		} else {
			var show_movetypes = 0;
			var movetypes = $scope.h_movetypes1;
		}

		// var test, parts, hours, minutes, date,
		// 	d = (new Date($scope.h_dot)).getTime(),
		// 	//tests = ['01.25 PM', '11.35 PM', '12.45 PM', '01.25 AM', '11.35 AM', '12.45 AM'],
		// 	timeReg = /(\d+)\.(\d+) (\w+)/;
		// var h_time = $scope.h_time;
		// var h_times_split = h_time.split(' ');
		// var h_time_hour = h_times_split[0]+'.00';
		// var h_time = h_time_hour+' '+h_times_split[1].toUpperCase();
		// var test = h_time;
		// parts = test.match(timeReg);
		// hours = /am/i.test(parts[3]) ?
		// 	function(am) {return am < 12 ? am : 0}(parseInt(parts[1], 10)) :
		// 	function(pm) {return pm < 12 ? pm + 12 : 12}(parseInt(parts[1], 10));
		// minutes = parseInt(parts[2], 10);
		// date = new Date(d);
		// date.setHours(hours);
		// date.setMinutes(minutes);
		// var hour_to_add = $scope.h_hour_value - 1;
		// date.setHours(date.getHours()+hour_to_add);
		// var end_time = date;
		// var start_hour = $scope.h_time;
		// var hours = date.getHours();
		// var minutes = date.getMinutes();
		// var ampm = hours >= 12 ? 'pm' : 'am';
		// hours = hours % 12;
		// hours = hours ? hours : 12; // the hour '0' should be '12'
		// minutes = minutes < 10 ? '0'+minutes : minutes;
		// var end_hour = hours + ' ' + ampm;
		
		// var test, parts1, hours1, minutes1, date1,
		// 	d1 = (new Date($scope.h_dot)).getTime(),
		// 	//tests = ['01.25 PM', '11.35 PM', '12.45 PM', '01.25 AM', '11.35 AM', '12.45 AM'],
		// 	timeReg1 = /(\d+)\.(\d+) (\w+)/;
		// var h_time1 = $scope.h_time;
		// var h_times_split1 = h_time1.split(' ');
		// var h_time_hour1 = h_times_split1[0]+'.00';
		// var h_time1 = h_time_hour1+' '+h_times_split1[1].toUpperCase();
		// var test = h_time1;
		// parts1 = test.match(timeReg1);
		// hours1 = /am/i.test(parts1[3]) ?
		// 	function(am) {return am < 12 ? am : 0}(parseInt(parts1[1], 10)) :
		// 	function(pm) {return pm < 12 ? pm + 12 : 12}(parseInt(parts1[1], 10));
		// minutes1 = parseInt(parts1[2], 10);
		// date1 = new Date(d1);
		// date1.setHours(hours1);
		// date1.setMinutes(minutes1);
		// var start_time = date1;
		// var diff =(start_time.getTime() - end_time.getTime()) / 1000;
		// diff /= (60 * 60);
		// var hours_diff =  Math.abs(Math.round(diff));
		
		// var start_time_object = start_time;
		// var end_time_object = end_time;
		// var cnt = 1;
		// var hours_array = [];
		// while(start_time_object.getTime() < end_time_object.getTime()){
		// 	if(cnt == 1){
		// 		var hours = start_time_object.getHours();
		// 		var minutes = start_time_object.getMinutes();
		// 		var ampm = hours >= 12 ? 'pm' : 'am';
		// 		hours = hours % 12;
		// 		hours = hours ? hours : 12; // the hour '0' should be '12'
		// 		minutes = minutes < 10 ? '0'+minutes : minutes;
		// 		var hour_var = hours + ' ' + ampm;
		// 		hours_array.push({ hours: hour_var});
		// 	}
			
		// 	var new_start_time_object = start_time_object.setHours(start_time_object.getHours() + 1);
		// 	start_time_object = new Date(new_start_time_object);
		// 	var hours = start_time_object.getHours();
		// 	var minutes = start_time_object.getMinutes();
		// 	var ampm = hours >= 12 ? 'pm' : 'am';
		// 	hours = hours % 12;
		// 	hours = hours ? hours : 12; // the hour '0' should be '12'
		// 	minutes = minutes < 10 ? '0'+minutes : minutes;
		// 	var hour_var = hours + ' ' + ampm;
		// 	hours_array.push({ hours: hour_var});
		// 	//console.log(start_time_object.getTime());   
		// 	cnt ++;
		// }
		var hours_array = [];
		for (var i = $scope.h_time; i <= $scope.h_hour_value; i++) {
		  hours_array.push(i);
		}
		//var hours_length = parseInt($scope.h_time) + (parseInt($scope.h_hour_value) - 1);
		//console.log(hours_array);
		//return false;

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
						date_full_string: full_date_string,
						show_movetypes: show_movetypes,
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

function getemployee_data(hours_array, check_for, date_tran, $firebaseArray){
	var emp_dat = [];
	for (var keys in hours_array) {
		console.log(hours_array[keys]['hours']);
		
		emp_dat = getemployee_data_1(hours_array[keys]['hours'], check_for, date_tran, $firebaseArray);
		
		console.log('emp_dat in getemployee_data');
		console.log(emp_dat)

		if(!emp_dat){
			return false;
		}
	}
	return $emp_dat;
}

function getemployee_data_1(hours, check_for, date_tran, $firebaseArray){
	var emp_dat = [];
	var ref_allocted = firebase.database().ref('Employee Allocation/Unallocated/'+date_tran+'/').limitToFirst('3');
	var allocated_obj = $firebaseArray(ref_allocted);
	var cnt = 1;
	var keepGoing = 1;
	var emp_name = '';
	var emp_id = '';
	allocated_obj.$loaded().then(function() {
		var cnt = 1;
		var keepGoing = 1;
		var emp_name = '';
		var emp_id = '';
		console.log(allocated_obj);
		angular.forEach(allocated_obj, function(value,key, _ary){
			if(keepGoing){
				console.log(value);
				if(cnt == check_for){
					emp_name = value.$value;
					emp_id = value.$id;
					keepGoing = false;	
				}
			}
			cnt ++;
		})
		console.log('emp_id : ' + emp_id);
		if(emp_id == ''){
			emp_dat.push({ status: '0'});
			return emp_dat;
		} else {
			emp_dat.push({ status: '1', emp_id: emp_id, emp_name: emp_name});
			return emp_dat;
		}
	});
}