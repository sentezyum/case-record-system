<?php

// stylesheets
echo $this->Bower->component('css', '/components/bootstrap/dist/css/bootstrap.min.css');
echo $this->Bower->component('css', '/components/fontawesome/css/font-awesome.min.css');
echo $this->Bower->component('css', '/components/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css');
echo $this->Bower->component('css', '/components/toastr/toastr.min.css');

// lib
echo $this->Bower->component('js', '/components/jquery/dist/jquery.min.js');
echo $this->Bower->component('js', '/components/underscore/underscore-min.js');
echo $this->Bower->component('js', '/components/bootstrap/dist/js/bootstrap.min.js');
echo $this->Bower->component('js', '/components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js');
echo $this->Bower->component('js', '/components/moment/min/moment-with-locales.min.js');
echo $this->Bower->component('js', '/components/toastr/toastr.min.js');

// angular lib
echo $this->Bower->component('js', '/components/angular/angular.min.js');
echo $this->Bower->component('js', '/components/angular-resource/angular-resource.min.js');
echo $this->Bower->component('js', '/components/angular-sanitize/angular-sanitize.min.js');
echo $this->Bower->component('js', '/components/angular-utils-pagination/dirPagination.js');
echo $this->Bower->component('js', '/components/angular-bootstrap/ui-bootstrap.min.js');
echo $this->Bower->component('js', '/components/angular-bootstrap/ui-bootstrap-tpls.js');
echo $this->Bower->component('js', '/components/angular-moment/angular-moment.min.js');

// Angular app
echo $this->Html->script('angular_app.js?v1');
echo $this->Html->script('angular_locale.js?v1');
echo $this->Html->script('angular_service.js?v1');
echo $this->Html->script('CaseRecordSystemController.js?v1');
echo $this->Html->script('menu/Menu.js?v1');

// user_defined scripts
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>
