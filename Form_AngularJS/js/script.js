/*
 * Ryan Dean
 * Period: A
*/



/********MAKE A MEHTOD TO CHANGE THE ACTIVE CLASS*****/
var profileApp = angular.module('profileApp', ['ngRoute']);
var controllers = {};

profileApp.factory('dataHandler', function($http){
})

profileApp.config(function($routeProvider) {
	$routeProvider
	.when('/',
	{
		templateUrl: 'views/welcome.html',
		controller: 'welcomeCtrl'
	})

	.when('/sample-student',
	{
		templateUrl: 'views/sample-student.html',
		controller: 'sample-studentCtrl'
	})

	.when('/new-student',
	{
		templateUrl: 'views/new-student.html',
		controller: 'new-studentCtrl'
	})

	.when('/manage-profiles',
	{
		templateUrl: 'php/manage-profiles.php',
		controller: 'manage-profilesCtrl'
	})

	.when('/student-profile',
	{
		templateUrl: 'views/student-profile.html',
		controller: 'student-profileCtrl'
	})

	.when('/construction',
	{
		templateUrl: 'views/construction.html',
		controller: 'constructionCtrl'
	})

	.when('/form',
	{
		templateUrl: 'php/form.php',
		controller: 'formCtrl'
	})

	.otherwise({redirectTo: '/'});
});

profileApp.controller('welcomeCtrl', function($route, $scope) {
	activeTab($route.current.templateUrl);
	
});

profileApp.controller('sample-studentCtrl', function($route, $scope) {
	activeTab($route.current.templateUrl);
});

profileApp.controller('new-studentCtrl', function($route, $scope) {
	activeTab($route.current.templateUrl);
});

profileApp.controller('manage-profilesCtrl', function($route, $scope) {
	activeTab($route.current.templateUrl);
	var cells = [];
	$scope.getStudentData = function(index){
		var table = $('#student-table');
		var rows = $('tr', table);
		var row = rows.eq(index);
		cells = [];
		for(var i = 0; i < 1; i++){
			$('td', row).each(function() {
				cells.push($(this).html());
			});
		}
		$scope.id_num = cells[0];
		$scope.first_name = cells[1];
		$scope.last_name = cells[2];
		$scope.grade = cells[3];
		$scope.year_graduation = cells[4];
		$scope.dob = cells[5];
		$scope.class_list = cells[6];
		$scope.about = cells[7];
	}
});

profileApp.controller('constructionCtrl', function($route, $scope) {
	activeTab($route.current.templateUrl);
});

profileApp.controller('student-profileCtrl', function($scope) {});
profileApp.controller('formCtrl', function($scope) {});


function drop(){
	var id = prompt("Enter the ID for the row you would like to delete: ");
	document.getElementById(id).innerHTML = "";
}

function checkForm(){
	var typeFName = document.getElementById("inputFirstName").value;
	if(typeof typeFName != String){
		document.getElementById("inputFirstName").style = "background-color: #FF0000;";
	}
}

/*
 * Takes the current templateUrl as a parameter and either adds or removes the active class depending on 
 * it.  This changes the gray active tab in the navbar.
*/
function activeTab(currentTemplateUrl){
	$('.navbar').css('opacity', '1');
	$('#navbarWelcome').removeClass('active');
	$('#navbarSample').removeClass('active');
	$('#navbarNew').removeClass('active');
	$('#navbarManage').removeClass('active');

	if(currentTemplateUrl == 'views/welcome.html'){
		$('.navbar').css('opacity', '0.75');
		$('#navbarWelcome').addClass('active');
	}
	else if(currentTemplateUrl == 'views/sample-student.html'){
		$('#navbarSample').addClass('active');
	}
	else if(currentTemplateUrl == 'views/new-student.html'){
		$('#navbarNew').addClass('active');
	}
	else if(currentTemplateUrl == 'php/manage-profiles.php'){
		$('#navbarManage').addClass('active');
	}
}