app.controller('CategoryController', ['$scope', '$http', '$stateParams', '$rootScope','$state', function($scope, $http, $stateParams, $rootScope, $state) { 
	$rootScope.user = localStorage['user'];
    $rootScope.id = localStorage['id'];
    $rootScope.loggedIn = localStorage['loggedIn'];

    if ($stateParams.obj != null) {
        $scope.message = $stateParams.message;
    }
    if ($stateParams.obj != null) {
        $scope.categories = $stateParams.obj;
    }

    $scope.addCategory = function(inputs){
        $scope.inputs = inputs;
        $scope.inputs.user_id = $rootScope.id;

        $http.post('/api/addCategory',$scope.inputs).then(function(response){
            $scope.message = response.data.message;
        },
        function(response){

            $state.go('addCategory');
        }); 
    }
    if($state.current.name == 'myCategory') {
        $http.get('/api/myCategory').then(function(response){
           $scope.categories = response.data.categories;
        });
    }
    else if($state.current.name == 'allCategory') {
        $http.get('/api/allCategory').then(function(response){
            $scope.categories = response.data.categories;
        });
    }
    else if ($state.current.name == 'editCategory') {
        var id = $stateParams.obj;
        $http.get('/api/editCategory/' + id).then(function(response){
            $scope.categories = response.data.category;
        });
    }

    $scope.edit = function(inputs){
        $scope.inputs = inputs;
        $state.go('editCategory', {obj: $scope.inputs});
    }

    $scope.update = function(inputs){
        $scope.inputs = inputs;
        $http.put('/api/updateCategory/' + $scope.inputs.id, $scope.inputs).then(function(response){
            $scope.message = response.data.message;
        }); 
    }

    $scope.delete = function(inputs){
        $scope.inputs = inputs;
        $http.delete('/api/deleteCategory/' + $scope.inputs).then(function(response){
            $scope.message = response.data.message;
        }); 
    }
}]);