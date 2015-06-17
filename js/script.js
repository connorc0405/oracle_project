/* Make the app and assign it to a vairable */
var databaseApp = angular.module('databaseApp', ['ngRoute']);

var controllers = {};

/* The code responsible for navigation. */
databaseApp.config(function($routeProvider) {
	$routeProvider
	.when('/',
	{
		templateUrl: 'php/welcome.php',
		controller: 'welcome-ctrl'
	})

	.when('/construction',
	{
		templateUrl: 'html/construction.html',
		controller: 'construction-ctrl'
	})

	.when('/student-profile',
	{
		templateUrl: 'html/student-profile.html',
		controller: 'student-profile-ctrl'
	})

	.when('/login',
	{
		templateUrl: 'html/login.html',
		controller: 'login-ctrl'
	})

	.when('/register',
	{
		templateUrl: 'html/register.html',
		controller: 'register-ctrl'
	})

	.otherwise({redirectTo: '/'});
});

databaseApp.controller('login-ctrl', function($scope){});
databaseApp.controller('register-ctrl', function($scope){});
databaseApp.controller('welcome-ctrl', function($scope){
	// Code to make the page scroll to a specific section.  Code idea from http://jsfiddle.net/ryXFt/3/
	$('.student-link').click(function(){
		$('html,body').animate({
			scrollTop:
			$('#students').offset().top-50},
				'slow');
		});
	$('.parent-link').click(function(){
		$('html,body').animate({
			scrollTop:
			$('#parents').offset().top-50},
				'slow');
		});
	$('.admin-link').click(function(){
		$('html,body').animate({
			scrollTop:
			$('#admin').offset().top-50},
				'slow');
		});

	
	$('#studentTab').click(function(){
		$('#dropdownShow').html('Student Profiles');
	});
	$('#parentTab').click(function(){
		$('#dropdownShow').html('Parent Profiles');
	});
	$('#adminTab').click(function(){
		$('#dropdownShow').html('Admin Profiles');
		
	});

	$('#student-img').fadeIn("slow", function(){});
});

databaseApp.controller('construction-ctrl', function($scope){
});
databaseApp.controller('student-profile-ctrl', function($scope){
});
databaseApp.controller('login-ctrl', function($scope){});


$('#example').click(function () {
  $('[data-toggle="popover"]').popover()
});