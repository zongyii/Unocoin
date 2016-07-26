var Profile = function() {

    var dashboardMainChart = null;

    return {

        //main function
        init: function() {
        
            Profile.initMiniCharts();
            Profile.initTable1();
        },

        initMiniCharts: function() {

            // IE8 Fix: function.bind polyfill
            if (Metronic.isIE8() && !Function.prototype.bind) {
                Function.prototype.bind = function(oThis) {
                    if (typeof this !== "function") {
                        // closest thing possible to the ECMAScript 5 internal IsCallable function
                        throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");
                    }

                    var aArgs = Array.prototype.slice.call(arguments, 1),
                        fToBind = this,
                        fNOP = function() {},
                        fBound = function() {
                            return fToBind.apply(this instanceof fNOP && oThis ? this : oThis,
                                aArgs.concat(Array.prototype.slice.call(arguments)));
                        };

                    fNOP.prototype = this.prototype;
                    fBound.prototype = new fNOP();

                    return fBound;
                };
            }

            $("#sparkline_bar").sparkline([8, 9, 10, 11, 10, 10, 12, 10, 10, 11, 9, 12, 11], {
                type: 'bar',
                width: '100',
                barWidth: 6,
                height: '45',
                barColor: '#F36A5B',
                negBarColor: '#e02222'
            });

            $("#sparkline_bar2").sparkline([9, 11, 12, 13, 12, 13, 10, 14, 13, 11, 11, 12, 11], {
                type: 'bar',
                width: '100',
                barWidth: 6,
                height: '45',
                barColor: '#5C9BD1',
                negBarColor: '#e02222'
            });
        },

        initTable1: function () {

            var table = $('#sample_1');

            // begin first table
            table.dataTable({

                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "No entries found",
                    "infoFiltered": "(filtered1 from _MAX_ total entries)",
                    "lengthMenu": "Show _MENU_ entries",
                    "search": "Search:",
                    "zeroRecords": "No matching records found"
                },

                // Or you can use remote translation file
                //"language": {
                //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                //},

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "columns": [{
                    "orderable": false
                }, {
                    "orderable": true
                }, {
                    "orderable": true
                }, {
                    "orderable": true
                }, {
                    "orderable": false
                }, {
                    "orderable": false
                }, {
                    "orderable": false
                }, {
                    "orderable": false
                }, {
                    "orderable": false
                }, {
                    "orderable": false
                }],
                "lengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 5,            
                "pagingType": "bootstrap_full_number",
                "language": {
                    "search": "Search: ",
                    "lengthMenu": "  _MENU_ records",
                    "paginate": {
                        "previous":"Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },
                "columnDefs": [{  // set default column settings
                    'orderable': false,
                    'targets': [0]
                }, {
                    "searchable": false,
                    "targets": [0]
                }],
                "order": [
                    [1, "asc"]
                ] // set first column as a default sort by asc
            });

            var tableWrapper = jQuery('#sample_1_wrapper');

            table.find('.group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                        $(this).parents('tr').addClass("active");
                    } else {
                        $(this).attr("checked", false);
                        $(this).parents('tr').removeClass("active");
                    }
                });
                jQuery.uniform.update(set);
            });

            table.on('change', 'tbody tr .checkboxes', function () {
                $(this).parents('tr').toggleClass("active");
            });

            tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
        },        

        save_personal_info: function() {
            var reseller_id = $('#reseller_id').val();
            var base_currency = $('#base_currency').val();
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var email = $('#email').val();
            var username = $('#username').val();
            var phone = $('#phone_number').val();
            var password = $('#password').val();
            var repassword = $('#repassword').val();
            var company_name = $('#company_name').val();
            var about = $('#about').val();
            var website_url = $('#website_url').val();
            var twitter_url = $('#twitter_url').val();
            var facebook_url = $('#facebook_url').val();

            var term = "reseller_id=" + reseller_id + 
                    "&base_currency=" + encodeURIComponent(base_currency) + 
                    "&first_name=" + first_name + 
                    "&last_name=" + last_name + 
                    "&username=" + username + 
                    "&email=" + email + 
                    "&phone_number=" + phone + 
                    "&repassword=" + repassword + 
                    "&password=" + password +
                    "&about=" + encodeURIComponent(about) + 
                    "&twitter_url=" + encodeURIComponent(twitter_url) + 
                    "&facebook_url=" + encodeURIComponent(facebook_url) + 
                    "&website_url=" + encodeURIComponent(website_url)
                    ;

            $.ajax({
                type : "POST",
                async : true,
                url : save_personal_info_url,
                dataType : "json",
                timeout : 30000,
                cache : false,
                data : term,
                error : function(request, status, error) {
                    console.log(error);                    
                },
                success : function(response) {
                    var messages_str = "";
                    if(response.status === false) {
                        $('#messages').css('display', 'block');                        
                        $.each(response.messages, function(index, val) {
                            messages_str += val;
                            messages_str += "<br />";
                        });
                        var error_div = "<div class='alert alert-danger'>" + messages_str + "</div>";
                        $('#messages').html($(error_div));
                        return false;
                    } else {
                        $('#messages').css('display', 'block');
                        $.each(response.messages, function(index, val) {
                            messages_str += val;
                            messages_str += "<br />";
                        });
                        var error_div = "<div class='alert alert-success'>" + messages_str + "</div>";
                        $('#messages').html($(error_div));
                        $('#messages').fadeOut(5000, function() {
                            location.replace(list_reseller_url);
                        });
                        return false;
                    }
                }
            });            
        },

        delete_user: function(user_id) {
        
            $("#delete_id").val(user_id);
            $('#confirmModal').modal({ keyboard: true });            
        },

        delete_vendor: function(vendor_id) {
        
            $("#delete_id").val(vendor_id);
            $('#confirmModal').modal({ keyboard: true });            
        },

        ok_hit1: function() {
            $('#confirmModal').modal('hide');

            var form_data = "vendor_id=" + $("#delete_id").val();

            $.ajax({
                type : "POST",
                async : true,
                url : delete_url,
                dataType : "json",
                timeout : 30000,
                cache : false,
                data : form_data,
                error : function(request, status, error) {

                },
                success : function(response) {

                    if(response.status)
                    {
                        var page_segment = $('#page_segment').val();
                        var per_page = $('#per_page').val();


                        var url = view_url + "/" + page_segment + "/" + per_page;

                        //location.replace(url);
                        location.reload();
                    }
                    else
                    {
                        $('#info_message').html(response.message);
                        //alert(delete_error_message);
                    }
                }
            });
        },

        ok_hit: function() {
            $('#confirmModal').modal('hide');

            var form_data = "user_id=" + $("#delete_id").val();

            $.ajax({
                type : "POST",
                async : true,
                url : delete_url,
                dataType : "json",
                timeout : 30000,
                cache : false,
                data : form_data,
                error : function(request, status, error) {

                },
                success : function(response) {

                    if(response.status)
                    {
                        var page_segment = $('#page_segment').val();
                        var per_page = $('#per_page').val();


                        var url = view_url;

                        location.replace(url);
                    }
                    else
                    {
                        $('#info_message').html(response.message);
                        //alert(delete_error_message);
                    }
                }
            });
        },

        change_permission: function() {
            var checkboxs = $('.permission_table').find('input:checkbox');
            var ids = [];
            var reseller_id = $('#reseller_id').val();
            $.each(checkboxs, function(index, val) {
                if($(this).attr('checked') === 'checked')
                    ids.push($(this).val());
            });

            $.ajax({
                type : "POST",
                async : true,
                url : change_permission_url,
                dataType : "json",
                timeout : 30000,
                cache : false,
                data : {ids: ids, reseller_id: reseller_id},
                error : function(request, status, error) {
                    console.log(error);
                },
                success : function(response) {

                    console.log(response);

                    if(response.status)
                    {
                        var side_menu = '';
                        var reseller_id = $('#reseller_id').val();
                        side_menu = side_menu + '<ul class="nav">';
                        if(response.service.mtu === true) {
                            side_menu = side_menu + '<li><a href="' + mtu_url + '/' + reseller_id + '"><i class="fa fa-mobile-phone"></i>';
                            side_menu = side_menu + mtu_side_menu_label + '</a></li>';                            
                        }

                        if(response.service.bp === true) {   
                            side_menu = side_menu + '<li><a href="' + bps_url + '/' + reseller_id + '"><i class="fa fa-money"></i>';
                            side_menu = side_menu + bps_side_menu_label + '</a></li>';
                        }  

                        if(response.service.mt === true) {   
                            side_menu = side_menu + '<li><a href=""><i class="fa fa-send"></i>';
                            side_menu = side_menu + mt_side_menu_label + '</a></li>';
                        } 

                        if(response.service.ce === true) {   
                            side_menu = side_menu + '<li><a href=""><i class="fa fa-exchange"></i>';
                            side_menu = side_menu + ce_side_menu_label + '</a></li>';
                        } 

                        side_menu = side_menu + '</ul>';

                        $('.profile-usermenu').html(side_menu);

                        $('#messages').css('display', 'block');
                        var success_div = "<div class='alert alert-success'>" + response['message'] + "</div>";
                        $('#messages').html($(success_div));
                        $('#messages').fadeOut(5000);
                        return false;
                    }
                    else
                    {
                        if(response.login) {
                            location.replace(login_url);
                        } else {
                            var error_div = "<div class='alert alert-danger'>" + response['message'] + "</div>";
                            $('#messages').html($(error_div));
                            return false;
                        }
                    }
                    
                }
            });            

        },

        save_profile_pic: function() {
            var reseller_id = $('#reseller_id').val();
            var file_data = $('#profile_pic').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            form_data.append('reseller_id', reseller_id);

            $.ajax({
                url: save_profile_pic_url, 
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                error : function(request, status, error) {
                    
                },                
                success: function(response) {
                    if(response.status) {
                        var success_div = "<div class='alert alert-success'>" + response['message'] + "</div>";
                        $('#messages').css('display', 'block');
                        $('#messages').html($(success_div));
                        $('#messages').fadeOut(5000);
                        $("#profile_picture").attr('src', response['file_path']);
                    } else {
                        $('#messages').css('display', 'block');
                        var error_div = "<div class='alert alert-danger'>" + response['message'] + "</div>";
                        $('#messages').html($(error_div));
                        $('#messages').fadeOut(5000);
                    }
                }
            });
        },

        change_password: function() {
            var old_password = $('#old_password').val();
            var change_password = $('#change_password').val();
            var change_password_confirm = $('#change_password_confirm').val();
            var reseller_id = $('#reseller_id').val();
            if(reseller_id == '' || reseller_id == '-1' || reseller_id == -1)
            {
                var success_div = "<div class='alert alert-success'>Please select the user.</div>";
                $('#messages').html($(success_div));               
            }

            var term = "reseller_id=" + reseller_id + "&old_password=" + old_password + "&change_password=" + change_password + "&change_password_confirm=" + change_password_confirm;
            $.ajax({
                type : "POST",
                async : true,
                url : change_password_url,
                dataType : "json",
                timeout : 30000,
                cache : false,
                data : term,
                error : function(request, status, error) {
                    console.log(error);
                },
                success : function(response) {

                    console.log(response);

                    if(response.status)
                    {
                        $('#messages').css('display', 'block');
                        var success_div = "<div class='alert alert-success'>" + response['message'] + "</div>";
                        $('#messages').html($(success_div));
                        $('#messages').fadeOut(5000);
                        $('#old_password').val('');
                        $('#change_password').val('');
                        $('#change_password_confirm').val('');
                        return false;
                    }
                    else
                    {
                        $('#messages').css('display', 'block');
                        var error_div = "<div class='alert alert-danger'>" + response['message'] + "</div>";
                        $('#messages').html($(error_div));
                        $('#messages').fadeOut(5000);
                        $('#old_password').val('');
                        $('#change_password').val('');
                        $('#change_password_confirm').val('');                        
                        return false;
                    }                    
                }
            });
        },

        save_amazon_info: function() {
            var country = $('#country').val();
            var amazon_app_name = $('#amazon_app_name').val();
            var amazon_app_version = $('#amazon_app_version').val();
            var amazon_merchant_id = $('#amazon_merchant_id').val();
            var amazon_merchant_token = $('#amazon_merchant_token').val();
            var amazon_marketplace_id = $('#amazon_marketplace_id').val();
            var amazon_buybox_per = $('#amazon_buybox_per').val();
            var amazon_mws_auth_token = $('#amazon_mws_auth_token').val();
            var amazon_is_sync;

            if($('#amazon_is_sync').attr('checked') == 'checked') {
                amazon_is_sync = 1;
            } else {
                amazon_is_sync = 0;
            }

            var user_id = $('#user_id').val();
            if(user_id == '' || user_id == '-1' || user_id == -1)
            {
                var success_div = "<div class='alert alert-success'>Please select the user.</div>";
                $('#messages').html($(success_div));               
            }

            var term = "user_id=" + user_id + "&amazon_app_name=" + amazon_app_name + "&amazon_app_version=" + amazon_app_version + "&amazon_merchant_id=" + amazon_merchant_id + "&amazon_merchant_token=" + amazon_merchant_token + "&amazon_marketplace_id=" + amazon_marketplace_id + "&amazon_is_sync=" + amazon_is_sync + "&amazon_buybox_per=" + amazon_buybox_per + "&country=" + country + "&amazon_mws_auth_token=" + amazon_mws_auth_token;
            
            $.ajax({
                type : "POST",
                async : true,
                url : save_amazon_info_url,
                dataType : "json",
                timeout : 30000,
                cache : false,
                data : term,
                error : function(request, status, error) {
                    console.log(error);
                },
                success : function(response) {
                    console.log(response);

                    if(response.status)
                    {
                        $('#messages').css('display', 'block');
                        var success_div = "<div class='alert alert-success'>" + response['message'] + "</div>";
                        $('#messages').html($(success_div));
                        $('#messages').fadeOut(5000);
                        return false;
                    }
                    else
                    {
                        $('#messages').css('display', 'block');
                        var error_div = "<div class='alert alert-danger'>" + response['message'] + "</div>";
                        $('#messages').html($(error_div));
                        $('#messages').fadeOut(5000);
                        return false;
                    }                  
                }
            });
        },

        save_company_info: function() {
            var name = $('#company_name').val();
            var address = $('#company_address').val();
            var code = $('#postal_code').val();
            var country = $('#company_country').val();
            var contact_number = $('#company_contact_number').val();
            var city = $('#company_city').val();
            var email = $('#company_email').val();
            var reseller_id = $('#reseller_id').val();


            $.ajax({
                type : "POST",
                async : true,
                url : save_company_info_url,
                dataType : "json",
                timeout : 30000,
                cache : false,
                data : {reseller_id: reseller_id,
                        name: name,
                        address: address,
                        city: city,
                        country: country,
                        contact_number: contact_number,
                        code: code,
                        email: email},
                error : function(request, status, error) {
                    console.log(error);
                },
                success : function(response) {
                    console.log(response);

                    if(response.status)
                    {
                        $('#messages').css('display', 'block');
                        var success_div = "<div class='alert alert-success'>" + response['message'] + "</div>";
                        $('#messages').html($(success_div));
                        $('#profile-usertitle').html(name);
                        $('#profile-useremail').html(email);
                        $('#messages').fadeOut(5000);
                    }
                    else
                    {
                        $('#messages').css('display', 'block');
                        var error_div = "<div class='alert alert-danger'>" + response['message'] + "</div>";
                        $('#messages').html($(error_div));
                        return false;
                        $('#messages').fadeOut(5000);
                    }                    
                }
            });            

        }
    };
}();