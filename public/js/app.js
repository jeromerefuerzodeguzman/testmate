var app = angular.module("app", []);

app.config(function($routeProvider){
	$routeProvider.when('/nsi' , {
		templateUrl: 'templates/frontpage.html',
		controller: 'FrontPageController'
	});

	$routeProvider.when('/nsiexam/code/:code', {
		templateUrl: 'templates/questions.html',
		controller: 'ExamController',
	});

	$routeProvider.when('/endexam', {
		templateUrl: 'templates/endexam.html',
	});

	$routeProvider.otherwise({ redirectTo: '/nsi' });
});


app.factory("CodeAuthentication", function($http) {
	return {
		login: function(credentials) {
			return $http.post("codeauth", credentials);
		}
	};
});

app.controller("FrontPageController", function($scope, $location, CodeAuthentication, $timeout) {
	$scope.credentials = { code: "" };
	$scope.loader = true;
	
	$scope.login = function() {
		CodeAuthentication.login($scope.credentials).success( function(data) {
			if(data.code) {
				$scope.loader = false;

				$timeout(function() { 
					$scope.loader = true;
					$location.path('/nsiexam/code/' + data.code);
				}, 2000);

				
			} else {
				$scope.loader = false;
				
				$timeout(function() { 
					alert(data.flash);
					$scope.loader = true; 
				}, 2000);
				
			}
		});
	};
});

app.controller("ExamController", function($scope, $routeParams, $http, $location, $timeout) {
	$scope.loader = true;

	//Gets the question and exams
	$http.get('nsiexam/' + $routeParams.code).success( function(data) {
		$scope.sets = data.sets;
		$scope.code = data.code;
		$scope.applicant_id = data.applicant_id;
		$scope.session_id = data.session_id;
		$scope.examdetails = {
			'id' : data.id,
			'title' : data.title,
			'passing_score' : data.passing_score,
			'duration' : data.duration
		};


	})
	
	//function that activates the answer when start is click
	$scope.countdown = function(min) {
		$scope.loader = false;

		$timeout(function() {
			$scope.clickme = true;
			$scope.loader = true;
			$scope.counter = min * 60;
			$scope.onTimeout = function(){
				$scope.counter--;
				if ($scope.counter > 0) {
					mytimeout = $timeout($scope.onTimeout,1000);
				}
				else {
					alert("Time is up!");
					$location.path('/endexam');
				}
			}
			var mytimeout = $timeout($scope.onTimeout,1000);
		}, 2000);
	}

	//creates or updates answers
	$scope.updateAns = function(lbl, question_id, code, session_id) {
		$scope.lbl = '';
		var data = {
			'lbl' : lbl,
			'question_id' : question_id,
			'code' : code,
			'session_id' : session_id
		};
		$http.post('answer', data);
	};


	

	//Submit exam and compute result
	$scope.submitexam = function (applicant_id, session_id) {
		var data = {
			'applicant_id' : applicant_id,
			'session_id' : session_id

		};

		$scope.loader = false;
		
		$timeout(function() { 
			$scope.loader = true;
			$http.post('checkanswer', data).success(function() {
				$location.path('/endexam');
			});
		}, 2000);

		
	};

/*	//confirmation when leaving/reloading page
	var leavingPageText = "Leaving this page is abandoning the exam";
	window.onbeforeunload = function(){
		return leavingPageText;
	}

	$scope.$on('$locationChangeStart', function(event, next, current) {
		if(!confirm(leavingPageText + "\n\nAre you sure you want to leave this page?")) {
			event.preventDefault();
		}
	});
*/


});

