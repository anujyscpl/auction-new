var app = angular.module('App', [], ['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
}]);

app.controller('ProductUploadController', ['$scope', '$http', '$window','$timeout', function ($scope, $http, $window, $timeout) {

    $scope.error = false;
    $scope.message = false;

    $scope.items = [];
    $scope.currentItem = [];
    $scope.edited = '';
    $scope.exists = false;
    $scope.success = '';

    const formData = new FormData();

    $scope.uploadFile = function () {

        const request = {
            method: 'POST',
            url: '/upload/file',
            data: formData,
            headers: {
                'Content-Type': undefined
            }
        };

        $http(request)
            .then(function success(e) {
                $scope.items = e.data.data;
                $scope.error = false;
                // clear uploaded file
                document.getElementById('csv_file').value = '';
                $scope.message = e.data.message;

                $timeout(function() {
                    $scope.message = false;
                }, 5000);

            }, function error(e) {
                $scope.error = e.data.errors;
                $timeout(function() {
                    $scope.error = false;
                }, 5000);
            });
    };

    $scope.setTheFiles = function ($files) {
        angular.forEach($files, function (value, key) {
            formData.append('csv_file', value);
        });
    };

    $scope.deleteFile = function (index) {
        const conf = confirm("Do you really want to delete this file?");

        if (conf === true) {
            $scope.items.splice(index, 1);
        }
    };

    $scope.setColor = function(item) {
        if (item.error) {
            return "background-color: red; color:white";
        }
        if (item.duplicates) {
            return "background-color: grey; color:white";
        }
    }

    //show modal form
    $scope.openEditModal = function(item, index){
        $scope.edited = index;
        $scope.currentItem = angular.copy(item)
        $("#myModal").modal("show");
    }

    $scope.update = function(newItem) {
        $scope.exists = false;
        angular.forEach($scope.items, function(item, index){
            if (index !== $scope.edited) {
                if ((item.sap_id === newItem.sap_id) || (item.loop_back === newItem.loop_back) || (item.host_name === newItem.host_name) ||(item.mac_address === newItem.mac_address) ) {
                    $scope.exists = true;
                }else {
                    item.duplicates = false;
                }
            }
        });

        if ($scope.exists) {
            return false;
        }

        if (newItem.error) {
            newItem.error = false;
        }
        if (newItem.duplicates) {
            newItem.duplicates = false;
        }
        $scope.items[$scope.edited] = newItem;
        $("#myModal").modal("hide");
    }

    $scope.checkData = function() {
        let check = false;
        $scope.items.forEach(item => {
            if ((item.error === true) || (item.duplicates === true) ) {
                check = true;
            }
        });

        return check;
    }

    $scope.save = function () {
        const request = {
            method: 'POST',
            url: '/file/save',
            data: {data:$scope.items}
        };

        $http(request)
            .then(function success(e) {
                $scope.message = e.data.message;
                $timeout(function() {
                    $scope.message = false;
                    location.reload();
                }, 5000);
            }, function error(e) {
                $scope.error = e.data.errors;
                $timeout(function() {
                    $scope.error = false;
                }, 5000);
            });
    };

}]);

app.directive('ngFiles', ['$parse', function ($parse) {

    function file_links(scope, element, attrs) {
        var onChange = $parse(attrs.ngFiles);
        element.on('change', function (event) {
            onChange(scope, {$files: event.target.files});
        });
    }

    return {
        link: file_links
    }
}]);
