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

	.when('/construction',
	{
		templateUrl: 'html/construction.html',
		controller: 'construction-ctrl'
	})

	.otherwise({redirectTo: '/'});
});

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
});

databaseApp.controller('construction-ctrl', function($scope){

});