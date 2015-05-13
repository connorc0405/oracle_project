var adminApp = angular.module('adminApp', ['ngRoute']);

var controllers = {};

adminApp.config(function($routeProvider){
	$routeProvider
	.when('/',
	{
		templateUrl: 'html/admin-home.html',
		controller: 'admin-home-ctrl'
	})

	.otherwise({redirectTo: '/'});
});

adminApp.controller('admin-home-ctrl', function($scope){});