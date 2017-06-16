var app = angular.module("gago",["ui.router"]);

app.config(function($stateProvider, $urlRouterProvider) {
	
    $stateProvider
    .state('index', {
	    url: "/",
	    templateUrl: "views/home/index.html"
    })
    .state("login", {
    	url: "/login",
        templateUrl : "views/auth/login.html",
        controller: 'AuthController'
    })
    .state("register", {
    	url: "/register",
        templateUrl : "views/auth/register.html",
        controller: 'AuthController'
    })
    .state("reset", {
    	url: "/reset",
        templateUrl : "views/auth/passwords/reset.html",
        controller: 'AuthController'
    })
    .state("email", {
    	url: "/email",
        templateUrl : "views/auth/passwords/email.html",
        controller: 'AuthController'
    });

    $urlRouterProvider.otherwise("/");
});