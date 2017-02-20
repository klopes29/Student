'use strict';

// Declare app level module which depends on views, and components
angular.module('webApp', [
  'ngRoute',
  'webApp.home',
  'webApp.register',
  'webApp.welcome',
  'webApp.addPost',
  'webApp.booking',
  'webApp.profile',
  'webApp.cancel',
  'webApp.menu'
]).
config(['$locationProvider', '$routeProvider', function($locationProvider, $routeProvider) {
  
  $routeProvider.otherwise({redirectTo: '/home'});
}]);
