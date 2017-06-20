app.controller('PostController', ['$scope', '$http', '$stateParams', '$rootScope','$state', 'Upload', function($scope, $http, $stateParams, $rootScope, $state, Upload) { 
	$rootScope.user = localStorage['user'];
    $rootScope.id = localStorage['id'];
    $rootScope.loggedIn = localStorage['loggedIn'];

    if ($stateParams.obj != null) {
        $scope.message = $stateParams.message;
    }
    if ($stateParams.obj != null) {
        $scope.categories = $stateParams.obj;
    }
    if ($stateParams.obj != null) {
        $scope.post = $stateParams.obj;
    }

    if($state.current.name == 'addPost' || $state.current.name == 'editPost') {
        $http.get('/api/myCategory').then(function(response){
           var x = [], data = response.data.categories;
           data.forEach(function (item) {
           		x.push({id: item.id, name: item.name})
           });
           $scope.categories = x;
  
        });
    }
    else if ($state.current.name == 'myPost') {
        $http.get('/api/myPost').then(function(response){
           $scope.posts = response.data.posts;
        });
    }
    else if ($state.current.name == 'allPost') {
        $http.get('/api/allPost').then(function(response){
           $scope.posts = response.data.posts;
           $scope.user = $rootScope.id;
        });
    }
    if ($state.current.name == 'editPost') {
        var id = $stateParams.obj;
        $http.get('/api/editPost/' + id).then(function(response){
            $scope.post = response.data.post;
        });
    }

    $scope.addPost = function (inputs, file) {
        $scope.inputs = inputs;
        if(file != undefined) {
          $scope.inputs.image = file;
          file.upload = Upload.upload({
                url: '/api/addPost',
                data: $scope.inputs,
            });
            file.upload.then(function (response) 
            {
                $scope.message = response.data.message;
            });
        } else {
          $http.post('/api/addPost',$scope.inputs).then(function(response){
            $scope.message = response.data.message;
          },
          function(response){
              $state.go('addPost');
          }); 
        }
    }


    $scope.edit = function(inputs){
        $scope.inputs = inputs;
        $state.go('editPost', {obj: $scope.inputs});
    }

    $scope.update = function(inputs, file){
      $scope.inputs = inputs;
      if(file != undefined) {

        $scope.inputs.image = file;
        file.upload = Upload.upload({
          url: '/api/updatePost/' + $scope.inputs.id,
          data: $scope.inputs,
        });
        file.upload.then(function (response) 
        {
          $scope.message = response.data.message;
        });
      } else {
        $http.post('/api/updatePost/' + $scope.inputs.id, $scope.inputs).then(function(response){
          $scope.message = response.data.message;
        },
        function(response){
          $scope.message = response.data.message;
        }); 
      }
    }

    $scope.delete = function(inputs){
        $scope.inputs = inputs;
        $http.delete('/api/deletePost/' + $scope.inputs).then(function(response){
            $scope.message = response.data.message;
        }); 
    }
}]);