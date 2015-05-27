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

	.when('/table-editor',
	{
		templateUrl: 'php/table-editor.php',
		controller: 'table-editor-ctrl'
	})

	.when('/course-tbl-create',
	{
		templateUrl: 'php/course-tbl-create.php',
		controller: 'course-tbl-create-ctrl'
	})

	.when('/new-student',
	{
		templateUrl: 'php/new-student.php',
		controller: 'new-student-ctrl'
	})

	.when('/student-tbl-created',
	{
		templateUrl: 'php/student-tbl-created.php',
		controller: 'student-tbl-created-ctrl'
	})

	.otherwise({redirectTo: '/'});
});

adminApp.controller('admin-home-ctrl', function($scope){});
adminApp.controller('new-course-ctrl', function($scope){});
adminApp.controller('course-profile-ctrl', function($scope){});
adminApp.controller('course-tbl-create-ctrl', function($scope){});
adminApp.controller('table-editor-ctrl', function($scope){});
adminApp.controller('new-student-ctrl', function($scope){});
adminApp.controller('student-tbl-created-ctrl', function($scope){});