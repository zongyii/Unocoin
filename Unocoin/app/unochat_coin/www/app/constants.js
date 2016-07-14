app.value('config', {
    baseUrl: 'http://localhost:8008/unocoin/index.php/api/',
    // baseUrl: 'http://localhost:88/',
    servicePaths: {
    	stripePaymentUrl: 'stripe_payment',
    },
    serviceStatuses: {
        success: 200
    },
    tableNames: {

    },
    user: {
    	username: '',
    	uid: '',
    	amount: ''
    },
    cc: {
    	cc_number: '',
    	cvc: '',
    	expire_month: '',
    	expire_year: ''
    }

});