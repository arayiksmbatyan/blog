app.controller('HomeController', ['$scope', '$rootScope', '$http', function($scope, $rootScope, $http) { 
	$rootScope.user = localStorage['user'];
    $rootScope.id = localStorage['id'];
    $rootScope.loggedIn = localStorage['loggedIn'];
}]);