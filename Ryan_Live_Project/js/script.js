/* Make the app and assign it to a vairable */
var databaseApp = angular.module('databaseApp', ['ngRoute']);

var controllers = {};

/* The code responsible for navigation. */
databaseApp.config(function($routeProvider) {
	$routeProvider
	.when('/',
	{
		templateUrl: 'html/welcome.html',
		controller: 'welcome-ctrl'
	})

	.otherwise({redirectTo: '/'});
});

databaseApp.controller('welcome-ctrl', function($scope){

});