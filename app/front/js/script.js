var postApp = angular.module('formApp', []);
postApp.controller('formController', function ($scope, $http) {
    $scope.submit = function () {
        $http({
            method: 'POST',
            url: 'http://172.17.0.3/user/login?_format=json',
            data: {"name":$scope.formData.name, "pass":$scope.formData.superheroAlias}, //forms user object
      //      withCredentials: true,
            'Content-Type': 'application/json',
        })
            .success(function (data) {
                if (data.errors) {
                    // Showing errors.
                    $scope.errorName = data.errors.name;
                    $scope.errorUserName = data.errors.username;
                    $scope.errorEmail = data.errors.email;
                }else {
                    console.log(data);
                    $scope.message = data;
                    var $aa = {"type":'article',"title":{"value":"assadasdd"}};
                    $http({
                        method: 'POST',
                        url: 'http://172.17.0.3/entity/node?_format=json',
                        data: JSON.stringify($aa), //forms user object
                        withCredentials: true,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    })
                        .success(function (data) {
                            if (data.errors) {
                                // Showing errors.
                                $scope.errorName = data.errors.name;
                                $scope.errorUserName = data.errors.username;
                                $scope.errorEmail = data.errors.email;
                            } else {
                                $scope.message = data;
                            }
                        });
                }
            });
    };
});

/*postApp.controller('PostFormController', function ($scope, $http) {
    var $aa = {"type":'article',"title":{"value":"assadasdd"}};
    $http({
        method: 'POST',
        url: 'http://172.17.0.4/entity/node?_format=json',
        data: JSON.stringify($aa), //forms user object
        withCredentials: true,
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    })
        .success(function (data) {
            if (data.errors) {
                // Showing errors.
                $scope.errorName = data.errors.name;
                $scope.errorUserName = data.errors.username;
                $scope.errorEmail = data.errors.email;
            } else {
                $scope.message = data;
            }
        });
});*/



