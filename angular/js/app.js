var app = angular.module("gago",["ui.router"]);
app.config(function($stateProvider, $urlRouterProvider) {
	
    $stateProvider
    // .state('index', {
    //     url: "/",
    //     templateUrl: "index.html",
    //     controller: 'AuthController'
    // })
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