var app = angular.module("gago",["ui.router"]);
app.config(function($stateProvider, $urlRouterProvider) {
	
    $stateProvider
    .state('index', {
        url: "/"
    })
    .state('home', {
	    url: "/home",
        params: {
            obj: null
        },
	    templateUrl: "views/home/index.html",
        controller: 'HomeController'
    })
    .state("login", {
    	url: "/login",
        params: {
            obj: null
        },
        templateUrl : "views/auth/login.html",
        controller: 'AuthController'
    })
    .state("register", {
    	url: "/register",
        params: {
            obj: null
        },
        templateUrl : "views/auth/register.html",
        controller: 'AuthController'
    })
    .state("addCategory", {
        url: "/add-category",
        params: {
            obj: null
        },
        templateUrl : "views/category/add.html",
        controller: 'CategoryController'
    })
    .state("myCategory", {
        url: "/my-category",
        params: {
            obj: null
        },
        templateUrl : "views/category/index.html",
        controller: 'CategoryController'
    })
    .state("allCategory", {
        url: "/all-category",
        params: {
            obj: null
        },
        templateUrl : "views/category/all.html",
        controller: 'CategoryController'
    })
    .state("editCategory", {
        url: "/edit-category",
        params: {
            obj: null
        },
        templateUrl : "views/category/edit.html",
        controller: 'CategoryController'
    })
    .state("addPost", {
        url: "/add-post",
        params: {
            obj: null
        },
        templateUrl : "views/post/add.html",
        controller: 'PostController'
    })
    .state("myPost", {
        url: "/my-post",
        params: {
            obj: null
        },
        templateUrl : "views/post/index.html",
        controller: 'PostController'
    })
    .state("allPost", {
        url: "/all-post",
        params: {
            obj: null
        },
        templateUrl : "views/post/all.html",
        controller: 'PostController'
    })
    .state("reset", {
    	url: "/reset",
        params: {
            obj: null
        },
        templateUrl : "views/auth/passwords/reset.html",
        controller: 'AuthController'
    })
    .state("change", {
    	url: "/change",
        params: {
            obj: null
        },
        templateUrl : "views/auth/passwords/change.html",
        controller: 'AuthController'
    });

    $urlRouterProvider.otherwise("/");
});