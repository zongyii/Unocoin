stripesModule.controller('StripesCtrl', function($scope, $log, $location, $ionicLoading, $cordovaToast, config, database, StripesFactory) {
	var moduleName = 'StripesCtrl';

	$scope.cc = {
		cc_number: '',
		cvc: '',
		expire_month: '',
		expire_year: ''
	};

	$scope.stripeCheckout = function(isValid) {
		var functionName = 'stripe_checkout';
		$scope.submitted = true;

		if(isValid) {
			var cc_number = $scope.cc.cc_number;
			var cvc = $scope.cc.cvc;
			var expire_month = $scope.cc.expire_month;
			var expire_year = $scope.cc.expire_year;
			var amount = config.user.amount;

			config.cc.cc_number = cc_number;
			config.cc.cvc = cvc;
			config.cc.expire_month = expire_month;
			config.cc.expire_year;

			$ionicLoading.show({template: 'Logging in...'});

    		StripesFactory.makePayment(config.user, config.cc).success(function(data) {					
				$ionicLoading.hide();
				console.log(data);
				if (data.status === true) {
					$cordovaToast.showLongBottom(data.message);

				} else {
					$cordovaToast.showLongBottom(data.message);
				}	                
            }).error(function(error) {	            	
            	$ionicLoading.hide();	            	
                $cordovaToast.showLongBottom('The web service is offline.');
            });			
		}

	}

	var stripeResponseHandler = function(status, response) {
		console.log(response['id']);
	}

});