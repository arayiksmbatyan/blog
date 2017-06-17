app.controller('AuthController', ['$scope', '$http', '$stateParams', '$rootScope','$state', function($scope, $http, $stateParams, $rootScope, $state) { 
	// localStorage.clear();
	$scope.inputs = {};
    $rootScope.user = '';
    $rootScope.loggedIn = false;

    if ($stateParams.obj != null) {
    	$scope.message = $stateParams.obj;
    }

    $scope.submit = function(inputs){
        $scope.inputs = inputs;
        $http.post('/api/login',$scope.inputs).then(function(response){

            if(response.status == 200){
                localStorage.setItem('id',response.data.user.id);
                localStorage.setItem('user',response.data.user.name);
                $rootScope.user = localStorage['user'];
                $rootScope.id = localStorage['id'];
             
                localStorage.setItem('loggedIn',true);
                $rootScope.loggedIn = localStorage['loggedIn'];
               
                $state.go('home', {obj: response.data.name});
            } 
           
        },
        function(response){
            $state.go('login', {obj: response.data.message});
        }); 
    }

    $rootScope.user = localStorage['user'];
    $rootScope.id = localStorage['id'];
    $rootScope.loggedIn = localStorage['loggedIn'];

 //    if($rootScope.user != ''){
	// 	$state.go('home');
	// }

	$scope.logout = function () {
		// console.log(5568555);
		$http.get('/api/logout').then(function (response) {
			console.log(response);

				localStorage.clear();
        		$rootScope.loggedIn = false;
        		$state.go('login');
			
		});
	}

}]);