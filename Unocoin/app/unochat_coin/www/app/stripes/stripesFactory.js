stripesModule.factory('StripesFactory', function($http, config) {
    var makePayment = function(user, cc) {       	       
        return $http.post(config.baseUrl + config.servicePaths.stripePaymentUrl, {
        	cc_number: cc.cc_number,
        	cvc: cc.cvc,
        	exp_month: cc.expire_month,
        	exp_year: cc.exp_year,
        	uid: user.uid,
        	username: user.username,
        	amount: user.amount
        });        	
    };

    return {
        makePayment: makePayment
    };
})