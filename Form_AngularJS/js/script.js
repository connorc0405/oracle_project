/*
 * Ryan Dean
 * Period: A
*/



/********MAKE A MEHTOD TO CHANGE THE ACTIVE CLASS*****/
var profileApp = angular.module('profileApp', ['ngRoute']);
var controllers = {};
var students;
var fName;
var lName;
var grade;
var yog;
var dob;
var classess;
var abt;
var imgPath;

profileApp.factory('dataHandler', function($http){
})

profileApp.config(function($routeProvider) {
	$routeProvider
	.when('/',
	{
		templateUrl: 'views/welcome.html',
		controller: 'welcomeCtrl'
	})

	.when('/sample-profile',
	{
		templateUrl: 'views/sample-profile.html',
		controller: 'sample-profileCtrl'
	})

	.when('/new-profile',
	{
		templateUrl: 'views/new-profile.html',
		controller: 'new-profileCtrl'
	})

	.when('/view-profiles',
	{
		templateUrl: 'views/view-profiles.html',
		controller: 'view-profilesCtrl'
	})

	.when('/student-profile',
	{
		templateUrl: 'views/student-profile.html',
		controller: 'student-profileCtrl'
	})

	.otherwise({redirectTo: '/'});
});

profileApp.controller('welcomeCtrl', function($scope) {
})

profileApp.controller('sample-profileCtrl', function($scope) {
})

profileApp.controller('new-profileCtrl', ['$scope', function($scope) {

}]);

profileApp.controller('view-profilesCtrl', function($scope) {
})

profileApp.controller('student-profileCtrl', function($scope) {
})



function drop(){
	var id = prompt("Enter the ID for the row you would like to delete: ");
	document.getElementById(id).innerHTML = "";
}