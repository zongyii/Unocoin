loginModule.controller('LoginCtrl', function($scope, $log, $location, $ionicLoading, $cordovaToast, config, database, LoginFactory) {
	var moduleName = 'LoginCtrl';

	$scope.user = {
		uid: '105843',
		username: 'ddksaku5',
		amount: '1'
	};

	$scope.checkout = function(isValid) {
		var functionName = 'checkout';
		$scope.submitted = true;

		if(isValid) {
			//$ionicLoading.show({template: 'Loading...'});
			var uid = $scope.user.uid;
			var username = $scope.user.username;
			var amount = $scope.user.amount;

			config.user = {
				username: username,
				uid: uid,
				amount: amount
			};	

			$log.info(moduleName, functionName, config.user);

			$location.path('/stripes');		
		}
	}

});