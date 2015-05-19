var adminApp = angular.module('adminApp', ['ngRoute']);

var controllers = {};

adminApp.config(function($routeProvider){
	$routeProvider
	.when('/',
	{
		templateUrl: 'html/admin-home.html',
		controller: 'admin-home-ctrl'
	})

	.when('/new-course',
	{
		templateUrl: 'php/new-course.php',
		controller: 'new-course-ctrl'
	})

	.when('/course-profile',
	{
		templateUrl: 'php/course-profile.php',
		controller: 'course-profile-ctrl'
	})

	.otherwise({redirectTo: '/'});
});

adminApp.controller('admin-home-ctrl', function($scope){});
adminApp.controller('new-course-ctrl', function($scope){});
adminApp.controller('course-profile-ctrl', function($scope){});