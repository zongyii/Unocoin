<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title></title>
    <!--<link href='https://fonts.googleapis.com/css?family=RobotoDraft:400,500,700,400italic' rel='stylesheet' type='text/css'>-->
    <link href="<?php echo base_url('assets/www/lib/ionic/css/ionic.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/www/lib/ion-md-input/css/ion-md-input.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/www/lib/ionic-material/dist/ionic.material.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/www/css/style.css'); ?>" rel="stylesheet">
   
    <script src="http://code.ionicframework.com/1.3.1/js/ionic.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/www/lib/ionic-material/dist/ionic.material.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/www/lib/ion-md-input/js/ion-md-input.min.js'); ?>"></script>
    <!-- // <script src="cordova.js"></script> -->
    <script src="<?php echo base_url('assets/www/js/app.js'); ?>"></script>
    <script src="<?php echo base_url('assets/www/js/controllers.js'); ?>"></script>


</head>
<body ng-app="starter">
    <ion-nav-view>
        <ion-side-menus enable-menu-with-back-views="true">
            <ion-side-menu-content>
                <ion-nav-bar class="bar-assertive-900" ng-class="{expanded: isExpanded, 'has-header-fab-left': hasHeaderFabLeft, 'has-header-fab-right': hasHeaderFabRight}" align-title="left">
                    <ion-nav-back-button class="no-text">
                    </ion-nav-back-button>
                    <ion-nav-buttons side="right">
                        <button class="button button-icon button-clear ion-android-more-vertical" menu-toggle="right">
                        </button>
                    </ion-nav-buttons>
                </ion-nav-bar>
                <ion-nav-view name="fabContent"></ion-nav-view>
                <ion-nav-view name="menuContent" ng-class="{expanded: isExpanded}" >
                    <ion-view view-title="Feature">
                        <ion-content ng-class="{expanded:isExpanded}" class="animate-fade-slide-in has-header">
                            <!--<div class="hero has-mask " style="background-image: url('img/jon-snow.jpg');">-->
                            <div class="hero has-mask " style="background-image: url('<?php echo base_url('assets/www/img/jon-snow.jpg'); ?>');">
                                <div class="content">
                                    <div class="avatar" style="background-image: url('<?php echo base_url('assets/www/img/daenerys.jpg'); ?>');"></div>
                                    <h3><a class="light">Daenerys Targaryen</a></h3>
                                
                                    <button class="button button-large button-clear flat waves-effect waves-button waves-light icon ion-heart pull-right text-white"></button>
                                    <button class="button button-large button-clear flat waves-effect waves-button waves-light icon ion-images pull-right text-white"></button>
                                    <button class="button button-large button-clear flat waves-effect waves-button waves-light icon ion-map pull-right text-white"></button>
                                </div>
                            </div>
                            <div class="mid-bar dark-bg z1 padding">
                                <h3>Dachstein Glacier</h3>
                                <p>$1,530 USD</p>
                            </div>
                            <div class="content double-padding">
                                <h4 class="positive">Book The Trek</h4>
                                <p class="text-muted">
                                    Immerse yourself in the scenic beauty of the Hallstatt region in Gosau am Dachstein. Decide for yourself whether or not you agree that this is the most beautiful spot in Austria.
                                </p>
                                <h3 class="outline padding balanced inline img-rounded">
                            4.2
                          </h3>
                            </div>
                            <button class="button button-fab button-fab-bottom-right button-assertive icon ion-paper-airplane waves-effect waves-button waves-light"></button>
                        </ion-content>
                    </ion-view>













                </ion-nav-view>
            </ion-side-menu-content>
            <ion-side-menu side="right">
                <ion-header-bar class="dark-bg expanded">
                    <span class="avatar" style="background: url('<?php echo base_url('assets/www/img/crown.jpg'); ?>'); background-size: cover;"></span>
                    <h2>Thronester</h2>
                </ion-header-bar>
                <ion-content class="stable-bg has-expanded-header">
                    <ion-list>
                        <ion-item nav-clear menu-close ui-sref="app.activity">
                            Activity
                        </ion-item>
                        <ion-item nav-clear menu-close ui-sref="app.login">
                            Login
                        </ion-item>
                        <ion-item nav-clear menu-close ui-sref="app.profile">
                            Profile
                        </ion-item>
                        <ion-item nav-clear menu-close ui-sref="app.friends">
                            Friends
                        </ion-item>
                        <ion-item nav-clear menu-close ui-sref="app.gallery">
                            Gallery
                        </ion-item>
                    </ion-list>
                </ion-content>
            </ion-side-menu>
        </ion-side-menus>

    </ion-nav-view>
</body>
</html>