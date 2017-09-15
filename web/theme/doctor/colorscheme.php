<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /theme/default/colorscheme.php
	# ----------------------------------------------------------------------------------------------------

	header("Content-type: text/css");

?>
/**/
body {

}
body {
    font-family: <?=SCHEME_FONTOPTION?>;
}
.text-highlight {
    color: #<?=SCHEME_COLOR2?>;
}
.text-muted {
    color: #b2b2b2 !important;
}
.text-primary {
    color: rgba(<?=SCHEME_COLOR1?>,0.8);
}
a, .hidden-info, .breadcrumb > li a {
    color: #<?=SCHEME_COLOR2?>;
}
a:hover, .hidden-info:hover, .breadcrumb > li a:hover, a:focus, .hidden-info:focus, .breadcrumb > li a:focus {
    color: #<?=SCHEME_COLOR1?>;
}
a.text-primary:hover {
    color: #<?=SCHEME_COLOR1?>;
}
.text-success {
    color: #<?=SCHEME_COLOR2?>;
}
a.text-success:hover {
    color: #<?=SCHEME_COLOR2?>;
}
.text-info {
    color: #<?=SCHEME_COLOR1?>;
}
a.text-info:hover {
    color: #<?=SCHEME_COLOR1?>;
}
.text-warning {
    color: #c87f0a;
}
a.text-warning:hover {
    color: #976008;
}
.text-danger {
    color: #962d22;
}
a.text-danger:hover {
    color: #6d2018;
}
.bg-primary {
    color: #fff;
    background-color: #<?=SCHEME_COLOR1?>;
}
a.bg-primary:hover {
    background-color: #<?=SCHEME_COLOR1?>;
}
.bg-success {
    background-color: #<?=SCHEME_COLOR2?>;
}
a.bg-success:hover {
    background-color: #<?=SCHEME_COLOR2?>;
}
.bg-info {
    background-color: #<?=SCHEME_COLOR1?>;
}
a.bg-info:hover {
    background-color: #<?=SCHEME_COLOR1?>;
}
.bg-warning {
    background-color: #fdedd4;
}
a.bg-warning:hover {
    background-color: #fad9a4;
}
.bg-danger {
    background-color: #f7ddda;
}
a.bg-danger:hover {
    background-color: #edb6b0;
}
.post-tags .badge {
    background-color: #<?=SCHEME_COLOR2?>;
}
.btn:hover, .btn:focus, .btn:active, .btn.active {
    opacity:0.8;
}
.btn-circle:hover, .btn-circle.active {
    border: 1px solid #<?=SCHEME_COLOR2?>;
    color: #<?=SCHEME_COLOR2?>;
}
.btn-circle:hover, .btn-circle.active {
    border: 1px solid #<?=SCHEME_COLOR2?>;
    color: #<?=SCHEME_COLOR2?>;
}
.btn-default {
    color: #797979;
    background-color: #f4f4f4;
    border-color: #d5d8dc;
}
.btn-default:hover, .btn-default:focus, .btn-default.focus, .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
    color: #797979;
    background-color: #dbdbdb;
    border-color: #b4b9c0;
}
.btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
    background-image: none;
}
.btn-default.disabled, .btn-default[disabled], fieldset[disabled] .btn-default, .btn-default.disabled:hover, .btn-default[disabled]:hover, fieldset[disabled] .btn-default:hover, .btn-default.disabled:focus, .btn-default[disabled]:focus, fieldset[disabled] .btn-default:focus, .btn-default.disabled.focus, .btn-default[disabled].focus, fieldset[disabled] .btn-default.focus, .btn-default.disabled:active, .btn-default[disabled]:active, fieldset[disabled] .btn-default:active, .btn-default.disabled.active, .btn-default[disabled].active, fieldset[disabled] .btn-default.active {
    background-color: #f4f4f4;
    border-color: #d5d8dc;
}
.btn-default .badge {
    color: #f4f4f4;
    background-color: #797979;
}
.btn-default.active, .btn-default:focus, .btn-default:active {
    background-color: #<?=SCHEME_COLOR1?>;
    color: #fff;
    border-color: #<?=SCHEME_COLOR1?>;
}
.btn-primary {
    color: #fff;
    background-color: #<?=SCHEME_COLOR1?>;
    border-color: #<?=SCHEME_COLOR1?>;
}
.btn-primary:hover, .btn-primary:focus, .btn-primary.focus, .btn-primary:active, .btn-primary.active, .open > .dropdown-toggle.btn-primary {
    color: #fff;
    background-color: #<?=SCHEME_COLOR1?>;
    border-color: #<?=SCHEME_COLOR1?>;
}
.btn-primary:active, .btn-primary.active, .open > .dropdown-toggle.btn-primary {
    background-image: none;
}
.btn-primary.disabled, .btn-primary[disabled], fieldset[disabled] .btn-primary, .btn-primary.disabled:hover, .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary:hover, .btn-primary.disabled:focus, .btn-primary[disabled]:focus, fieldset[disabled] .btn-primary:focus, .btn-primary.disabled.focus, .btn-primary[disabled].focus, fieldset[disabled] .btn-primary.focus, .btn-primary.disabled:active, .btn-primary[disabled]:active, fieldset[disabled] .btn-primary:active, .btn-primary.disabled.active, .btn-primary[disabled].active, fieldset[disabled] .btn-primary.active {
    background-color: #<?=SCHEME_COLOR1?>;
    border-color: #<?=SCHEME_COLOR1?>;
}
.btn-primary .badge {
    color: #<?=SCHEME_COLOR1?>;
    background-color: #fff;
}
.btn-success {
    color: #fff;
    background-color: #<?=SCHEME_COLOR2?>;
    border-color: #<?=SCHEME_COLOR2?>;
}
.btn-success:hover, .btn-success:focus, .btn-success.focus, .btn-success:active, .btn-success.active, .open > .dropdown-toggle.btn-success {
    color: #fff;
    background-color: #<?=SCHEME_COLOR2?>;
    border-color:#<?=SCHEME_COLOR2?>;
}
.btn-success:active, .btn-success.active, .open > .dropdown-toggle.btn-success {
    background-image: none;
}
.btn-success.disabled, .btn-success[disabled], fieldset[disabled] .btn-success, .btn-success.disabled:hover, .btn-success[disabled]:hover, fieldset[disabled] .btn-success:hover, .btn-success.disabled:focus, .btn-success[disabled]:focus, fieldset[disabled] .btn-success:focus, .btn-success.disabled.focus, .btn-success[disabled].focus, fieldset[disabled] .btn-success.focus, .btn-success.disabled:active, .btn-success[disabled]:active, fieldset[disabled] .btn-success:active, .btn-success.disabled.active, .btn-success[disabled].active, fieldset[disabled] .btn-success.active {
    background-color: #<?=SCHEME_COLOR2?>;
    border-color: #<?=SCHEME_COLOR2?>;
}
.btn-success .badge {
    color: #<?=SCHEME_COLOR2?>;
    background-color: #fff;
}
.btn-info {
    color: #fff;
    background-color: #<?=SCHEME_COLOR1?>;
    border-color: #<?=SCHEME_COLOR1?>;
}
.btn-info:hover, .btn-info:focus, .btn-info.focus, .btn-info:active, .btn-info.active, .open > .dropdown-toggle.btn-info {
    color: #fff;
    background-color: #<?=SCHEME_COLOR1?>;
    border-color: #<?=SCHEME_COLOR1?>;
}
.btn-info:active, .btn-info.active, .open > .dropdown-toggle.btn-info {
    background-image: none;
}
.btn-info.disabled, .btn-info[disabled], fieldset[disabled] .btn-info, .btn-info.disabled:hover, .btn-info[disabled]:hover, fieldset[disabled] .btn-info:hover, .btn-info.disabled:focus, .btn-info[disabled]:focus, fieldset[disabled] .btn-info:focus, .btn-info.disabled.focus, .btn-info[disabled].focus, fieldset[disabled] .btn-info.focus, .btn-info.disabled:active, .btn-info[disabled]:active, fieldset[disabled] .btn-info:active, .btn-info.disabled.active, .btn-info[disabled].active, fieldset[disabled] .btn-info.active {
    background-color: #<?=SCHEME_COLOR1?>;
    border-color: #<?=SCHEME_COLOR1?>;
}
.btn-info .badge {
    color: #<?=SCHEME_COLOR1?>;
    background-color: #fff;
}
.btn-warning {
    color: #fff;
    background-color: #f39c12;
    border-color: #e08e0b;
}
.btn-warning:hover, .btn-warning:focus, .btn-warning.focus, .btn-warning:active, .btn-warning.active, .open > .dropdown-toggle.btn-warning {
    color: #fff;
    background-color: #c87f0a;
    border-color: #a66908;
}
.btn-warning:active, .btn-warning.active, .open > .dropdown-toggle.btn-warning {
    background-image: none;
}
.btn-warning.disabled, .btn-warning[disabled], fieldset[disabled] .btn-warning, .btn-warning.disabled:hover, .btn-warning[disabled]:hover, fieldset[disabled] .btn-warning:hover, .btn-warning.disabled:focus, .btn-warning[disabled]:focus, fieldset[disabled] .btn-warning:focus, .btn-warning.disabled.focus, .btn-warning[disabled].focus, fieldset[disabled] .btn-warning.focus, .btn-warning.disabled:active, .btn-warning[disabled]:active, fieldset[disabled] .btn-warning:active, .btn-warning.disabled.active, .btn-warning[disabled].active, fieldset[disabled] .btn-warning.active {
    background-color: #f39c12;
    border-color: #e08e0b;
}
.btn-warning .badge {
    color: #f39c12;
    background-color: #fff;
}
.btn-danger {
    color: #fff;
    background-color: #c0392b;
    border-color: #ab3326;
}
.btn-danger:hover, .btn-danger:focus, .btn-danger.focus, .btn-danger:active, .btn-danger.active, .open > .dropdown-toggle.btn-danger {
    color: #fff;
    background-color: #962d22;
    border-color: #79241b;
}
.btn-danger:active, .btn-danger.active, .open > .dropdown-toggle.btn-danger {
    background-image: none;
}
.btn-danger.disabled, .btn-danger[disabled], fieldset[disabled] .btn-danger, .btn-danger.disabled:hover, .btn-danger[disabled]:hover, fieldset[disabled] .btn-danger:hover, .btn-danger.disabled:focus, .btn-danger[disabled]:focus, fieldset[disabled] .btn-danger:focus, .btn-danger.disabled.focus, .btn-danger[disabled].focus, fieldset[disabled] .btn-danger.focus, .btn-danger.disabled:active, .btn-danger[disabled]:active, fieldset[disabled] .btn-danger:active, .btn-danger.disabled.active, .btn-danger[disabled].active, fieldset[disabled] .btn-danger.active {
    background-color: #c0392b;
    border-color: #ab3326;
}
.btn-danger .badge {
    color: #c0392b;
    background-color: #fff;
}
.btn-link {
    color: #<?=SCHEME_COLOR2?>;
}
.btn-link:hover, .btn-link:focus {
    opacity:0.8;
}
.btn-link[disabled]:hover, fieldset[disabled] .btn-link:hover, .btn-link[disabled]:focus, fieldset[disabled] .btn-link:focus {
    color: #d5d8dc;
}
.input-group-addon, .input-group-addon-invisible {
    color: #<?=SCHEME_COLOR2?>;
}
.input-group-addon.bg-info, .input-group-addon-invisible.bg-info {
    border-right: 1px solid #d5d8dc !important;
}
.nav > li > a:hover, .nav > li > a:focus {
    background-color: #<?=SCHEME_COLOR2?>;
}
.nav .open > a, .nav .open > a:hover, .nav .open > a:focus {
    background-color: #<?=SCHEME_COLOR2?>;
    border-color: #<?=SCHEME_COLOR2?>;
}
.nav-tabs > li > a:hover {
    background-color: #<?=SCHEME_COLOR2?>;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #<?=SCHEME_COLOR2?>;
    border: 1px solid #d5d8dc;
}
.nav-tabs > li.disabled > a {
    color: #999899;
    background-color: #fff;
    border: 1px solid #e3e5e8;
}
.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
    color: #fff;
    background-color: #<?=SCHEME_COLOR1?>;
}
.navbar-toggle {
    background-color: #<?=SCHEME_COLOR1?>;
    border: 1px solid #<?=SCHEME_COLOR1?>;
}
.navbar-default {
    background-color: #<?=SCHEME_COLORNAVBAR?>;
    border-color: #<?=SCHEME_COLORNAVBAR?>;
}
.header-brand {
    background-color: #<?=SCHEME_COLORNAVBAR?>;
}
.navbar-default .navbar-brand {
    color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.navbar-default .navbar-brand:hover, .navbar-default .navbar-brand:focus {
    color: #<?=SCHEME_COLORNAVBARLINK?>;
    background-color: transparent;
}
.navbar-default .navbar-text {
    color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.navbar-default .navbar-nav > li > a {
    color: #<?=SCHEME_COLORNAVBARLINK?>;
    position: relative;
}
.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
    color: #<?=SCHEME_COLORNAVBARLINK?>;
    background-color: transparent;
}
.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
    color: #fff;
    background-color: #<?=SCHEME_COLOR1?>;
}
.navbar-default .navbar-nav > li > a:after {
    border-bottom: 6px solid #<?=SCHEME_COLORNAVBARLINK?>;
}
.navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus {
    background-color: #ddd;
}
.navbar-default .navbar-toggle .icon-bar {
    background-color: #888;
}
.navbar-default .navbar-collapse, .navbar-default .navbar-form {
    border-color: #e7e7e7;
}
.navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus {
    background-color: transparent;
    color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.navbar-default .navbar-nav .open .dropdown-menu > li > a {
    color: #<?=SCHEME_COLORNAVBARLINK?>;
}

.navbar-default .navbar-nav .dropdown-menu {
    background-color: #<?=SCHEME_COLORNAVBAR?>;
}
.navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
    color: #4b4b4b;
}
.navbar-default .navbar-nav .open .dropdown-menu > .active > a, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
    color: #<?=SCHEME_COLORNAVBARLINK?>;
    background-color: transparent;
}
.navbar-default .navbar-nav .open .dropdown-menu > .disabled > a, .navbar-default .navbar-nav .open .dropdown-menu > .disabled > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > .disabled > a:focus {
    color: #ccc;
    background-color: transparent;
}
}
.navbar-default .navbar-link {
    color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.navbar-default .navbar-link:hover {
    color: #4b4b4b;
}
.navbar-default .btn-link {
    color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.navbar-default .btn-link:hover, .navbar-default .btn-link:focus {
    color: #4b4b4b;
}
.navbar-default .btn-link[disabled]:hover, fieldset[disabled] .navbar-default .btn-link:hover, .navbar-default .btn-link[disabled]:focus, fieldset[disabled] .navbar-default .btn-link:focus {
    color: #ccc;
}
.navbar-inverse {
    background-color: #<?=SCHEME_COLOR1?>;
}
.breadcrumb-steps > li {
    background-color: #<?=SCHEME_COLOR1?>;
    color: #f4f4f4;
}

.breadcrumb-steps > li + li:before {
    border-color: transparent transparent transparent #<?=SCHEME_COLOR1?>;
}
.breadcrumb-steps > .active, .breadcrumb-steps > .active a {
    color: #<?=SCHEME_COLOR2?>;
}
.breadcrumb-steps.breadcrumb-steps-inverse > li {
    background-color:  #<?=SCHEME_COLOR2?>;
    color: #f4f4f4;
}
.breadcrumb-steps.breadcrumb-steps-inverse > .active, .breadcrumb-steps.breadcrumb-steps-inverse > .active a {
    background-color: #f4f4f4;
    color: #<?=SCHEME_COLOR2?>;
}
.breadcrumb-steps.breadcrumb-steps-inverse > li + li:before {
    border-color: transparent transparent transparent  #<?=SCHEME_COLOR2?>;
}
.breadcrumb-steps.breadcrumb-steps-inverse > .active + li:before, .breadcrumb-steps.breadcrumb-steps-inverse > .active a + li:before {
    border-color: transparent transparent transparent #f4f4f4;
}
.notify {
    background-color: #<?=SCHEME_COLOR2?>;
}
.pagination > li > a, .pagination > li > span {
    color: #<?=SCHEME_COLOR2?>;
}
.pagination > li > a:hover, .pagination > li > span:hover, .pagination > li > a:focus, .pagination > li > span:focus {
    color: #<?=SCHEME_COLOR2?>;
    background-color: #f4f4f4;
    border-color: #ddd;
}
.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
    z-index: 2;
    color: #fff;
    background-color: #<?=SCHEME_COLOR2?>;
    border-color: #<?=SCHEME_COLOR2?>;
    cursor: default;
}
.pagination > .disabled > span, .pagination > .disabled > span:hover, .pagination > .disabled > span:focus, .pagination > .disabled > a, .pagination > .disabled > a:hover, .pagination > .disabled > a:focus {
    color: #d5d8dc;
    background-color: #fff;
    border-color: #ddd;
}
.pager li > a, .pager li > span {
    display: inline-block;
    padding: 5px 14px;
    background-color: #fff;
    border: 1px solid #d5d8dc;
    border-radius: 15px;
}
.pager li > a:hover, .pager li > a:focus {
    text-decoration: none;
    background-color: #f4f4f4;
}
.label-default {
    background-color: #d5d8dc;
}
.label-default[href]:hover, .label-default[href]:focus {
    background-color: #b9bec5;
}
.label-primary {
    background-color: #<?=SCHEME_COLOR1?>;
}
.label-primary[href]:hover, .label-primary[href]:focus {
    background-color: #2b2a33;
}
.label-success {
    background-color: #<?=SCHEME_COLOR2?>;
}
.label-success[href]:hover, .label-success[href]:focus {
    background-color: #ff272e;
}
.label-info {
    background-color: #<?=SCHEME_COLOR1?>;
}
.label-info[href]:hover, .label-info[href]:focus {
    background-color: #716f87;
}
.label-warning {
    background-color: #f39c12;
}
.label-warning[href]:hover, .label-warning[href]:focus {
    background-color: #c87f0a;
}
.label-danger {
    background-color: #c0392b;
}
.label-danger[href]:hover, .label-danger[href]:focus {
    background-color: #962d22;
}
.badge {
    background-color: #d5d8dc;
}
a.badge:hover, a.badge:focus {
    color: #fff;
}
.list-group-item.active > .badge, .nav-pills > .active > a > .badge {
    color: #<?=SCHEME_COLOR2?>;
    background-color: #fff;
}
.list-group-item {
    background-color: #fff;
    border: 1px solid #ddd;
}
a.list-group-item {
    color: #555;
}
a.list-group-item .list-group-item-heading {
    color: #333;
}
a.list-group-item:hover, a.list-group-item:focus {
    color: #555;
    background-color: #f5f5f5;
}
.list-group-item.disabled, .list-group-item.disabled:hover, .list-group-item.disabled:focus {
    background-color: #f4f4f4;
    color: #d5d8dc;
}
.list-group-item.disabled .list-group-item-text, .list-group-item.disabled:hover .list-group-item-text, .list-group-item.disabled:focus .list-group-item-text {
    color: #d5d8dc;
}
.list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus {
    color: #fff;
    background-color: #<?=SCHEME_COLOR1?>;
    border-color: #<?=SCHEME_COLOR1?>;
}
.list-group-item.active .list-group-item-text, .list-group-item.active:hover .list-group-item-text, .list-group-item.active:focus .list-group-item-text {
    color: #a7a6b6;
}
.panel-default {
    border-color: transparent;
}
.panel-default > .panel-heading {
    color: #797979;
    background-color: transparent;
    border-color: transparent;
}
.panel-default > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: transparent;
}
.panel-default > .panel-heading .badge {
    color: transparent;
    background-color: #797979;
}
.panel-default > .panel-footer + .panel-collapse > .panel-body {
    border-bottom-color: transparent;
}
.panel-primary {
    border-color: #d5d8dc;
}
.panel-primary > .panel-heading {
    color: #fff;
    background-color: #<?=SCHEME_COLOR1?>;
    border-color: #d5d8dc;
}
.panel-primary > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: #d5d8dc;
}
.panel-primary > .panel-heading .badge {
    color: #<?=SCHEME_COLOR1?>;
    background-color: #fff;
}
.panel-primary > .panel-footer + .panel-collapse > .panel-body {
    border-bottom-color: #d5d8dc;
}
.panel-success {
    border-color: #c6dee5;
}
.panel-success > .panel-heading {
    color: #1f5373;
    background-color: #d7e5ed;
    border-color: #c6dee5;
}
.panel-success > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: #c6dee5;
}
.panel-success > .panel-heading .badge {
    color: #d7e5ed;
    background-color: #1f5373;
}
.panel-success > .panel-footer + .panel-collapse > .panel-body {
    border-bottom-color: #c6dee5;
}
.panel-info {
    border-color: #e6e7eb;
}
.panel-info > .panel-heading {
    color: #fff;
    background-color: #<?=SCHEME_COLOR2?>;
    border-color: #<?=SCHEME_COLOR2?>;
}
.panel-info > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: #e6e7eb;
}
.panel-info > .panel-heading .badge {
    color: #fafafb;
    background-color: #716f87;
}
.panel-info > .panel-footer + .panel-collapse > .panel-body {
    border-bottom-color: #e6e7eb;
}
.panel-warning {
    border-color: #fcd8bc;
}
.panel-warning > .panel-heading {
    color: #c87f0a;
    background-color: #fdedd4;
    border-color: #fcd8bc;
}
.panel-warning > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: #fcd8bc;
}
.panel-warning > .panel-heading .badge {
    color: #fdedd4;
    background-color: #c87f0a;
}
.panel-warning > .panel-footer + .panel-collapse > .panel-body {
    border-bottom-color: #fcd8bc;
}
.panel-danger {
    border-color: #f2c5c8;
}
.panel-danger > .panel-heading {
    color: #962d22;
    background-color: #f7ddda;
    border-color: #f2c5c8;
}
.panel-danger > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: #f2c5c8;
}
.panel-danger > .panel-heading .badge {
    color: #f7ddda;
    background-color: #962d22;
}
.panel-danger > .panel-footer + .panel-collapse > .panel-body {
    border-bottom-color: #f2c5c8;
}
.panel-accordion {
    border-color: transparent;
}
.panel-accordion > .panel-heading {
    color: #797979;
    background-color: transparent;
    border-color: transparent;
}
.panel-accordion > .panel-heading .badge {
    color: transparent;
    background-color: #797979;
}
.well-translucid {
    background-color: transparent;
    position: relative;
}
.well-translucid:before {
    content: "";
    position: absolute;
    top:0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #<?=SCHEME_COLOR1?>;
    opacity: 0.6;
    z-index: -1;
}
.well-translucid .form,
.well-translucid .form-group {
    position: relative;
}
.well-translucid .well-title {
    background-color: transparent;
}
.well-translucid, .well-translucid p {
    color: white;
}
.footer-static-bottom {
    background-color: #<?=SCHEME_COLOR1?>;
    color: #<?=SCHEME_COLORFOOTERLINK?> ;
}
.footer-static-bottom a,
.footer-static-bottom .footer-links address,
.footer-static-bottom h5,
.footer-static-bottom.footer-with-socialmedia p,
.footer-static-bottom.footer-with-socialmedia p a {
    color: #<?=SCHEME_COLORFOOTERLINK?>;
}
.footer-static-bottom a:hover, .footer-static-bottom a:focus {
    color: #<?=SCHEME_COLORFOOTERLINK?>;
    opacity: 0.8;
}
.footer-static-bottom p.small a {
    color: #<?=SCHEME_COLORFOOTERLINK?>;
    opacity: 0.7;
}
.footer-static-bottom .footer-links {
    background-color: rgba(0, 0, 0, 0.1);
}
.footer-static-bottom .footer-links address .fa,
.social-links .fa, .footer-static-bottom .footer-links .fa {
    color: #<?=SCHEME_COLOR2?>;
}
.footer-static-bottom.footer-with-socialmedia .social-links {
    background-color: #<?=SCHEME_COLORFOOTERLINK?>;
}
.footer-static-bottom.footer-with-socialmedia .footer-links ul.list-footer li {
    border-color: #<?=SCHEME_COLORFOOTERLINK?>;
}
.footer-static-bottom.footer-with-newsletter .footer-social-links li .social-links .fa {
    color: #<?=SCHEME_COLORFOOTERLINK?>;
}
.newsletter .newsletter-box legend {
    color: #<?=SCHEME_COLOR1?>;
}
.block.block-inverse .theme-box .theme-box-content {
    background-color: rgba(255, 255, 255, 0.95);
    border: none;
}
.block-background-map .theme-box .theme-box-content  {
    background:none;
    border:none;
}
.search-filter .btn-filter {
    color: #<?=SCHEME_COLOR2?>;
}
.search-filter .btn-filter:hover, .search-filter .btn-filter:focus, .search-filter .btn-filter:active,
.search-filter .list-group .list-group-item.active > a:after {
    color: #<?=SCHEME_COLOR2?>;
}
.advanced-search-box .btn-link:hover, .advanced-search-box .btn-link:active, .advanced-search-box .btn-link.active, .advanced-search-box .btn-link:focus {
    color: #<?=SCHEME_COLOR2?>;
}
.advanced-search-box h5 {
    background-color: #e3e5e8;
    color: #333;
}
.theme-title {
    color: #333;
}
.theme-title > .view-more {
    color: #<?=SCHEME_COLOR2?>;
}
.theme-title.theme-title-centered {
    color: #333;
}
.theme-title-large h3 a {
    color: #4c4c4c;
}
.theme-title-large > .view-more {
    color: #<?=SCHEME_COLOR2?>;
}
.theme-box .theme-box-content {
    background-color: #fff;
    border: 1px solid #d5d8dc;
}
.theme-box-inverse .theme-box-content {
    background-color: #<?=SCHEME_COLOR1?>;
}
.theme-box-inverse:nth-child(2n + 1) .theme-box-content {
    background-color: #<?=SCHEME_COLOR2?>;
}
.theme-box-expanded .theme-box-content {
    border: none;
    background-color: transparent;
}
.theme-box .theme-box-content a, .theme-box .theme-box-content a:hover {
    color: #333;
}
.theme-box .theme-box-content a:focus, .theme-box .theme-box-content a:visited {
    color: #797979;
    opacity: 0.8;
}
.theme-box.theme-box-bg .theme-box-content a, .theme-box .theme-box-content a:hover {
    color: #<?=SCHEME_COLOR2?>;
}
.theme-box.theme-box-bg .theme-box-content a.text-primary{
    color: #<?=SCHEME_COLOR1?>;
}
.theme-box .theme-box-content a.text-success {
    color: #<?=SCHEME_COLOR2?>;
}
.theme-box .theme-box-content h4 a:visited, .theme-box .theme-box-content h4 a:focus {
    color: #999899;
}
.theme-box-inverse .theme-box-content h3 a, .theme-box-inverse .theme-box-content h4 a,
.theme-box-inverse .theme-box-content h3 a:visited, .theme-box-inverse .theme-box-content h4 a:visited,
.theme-box-inverse .theme-box-content h3 a:hover, .theme-box-inverse .theme-box-content h4 a:hover,
.theme-box-inverse .theme-box-content h3 a:focus, .theme-box-inverse .theme-box-content h4 a:focus {
    color: #fff;
}
.theme-box .theme-box-content hr {
    border-top: 1px solid #d5d8dc;
    border-bottom: 1px solid #fff;
}
.theme-box .theme-box-content p {
    color: #797979;
}
.theme-box .theme-box-content .deal-tag,
.theme-box .theme-box-content .deal-tag a {
    background-color: #<?=SCHEME_COLOR2?>;
    color: white;
}
.theme-box .theme-box-content .deal-tag a:hover, .theme-box .theme-box-content .deal-tag a:focus {
    background-color: #<?=SCHEME_COLOR2?>;
    color: white;
}
.theme-box .theme-box-content .date.float-date {
    background-color: #<?=SCHEME_COLOR2?>;
}
.theme-box .theme-box-content .date.float-date-sm {
    border: 1px solid #<?=SCHEME_COLOR2?>;
}
.theme-box .theme-box-content .date.float-date-sm > em {
    background-color: #<?=SCHEME_COLOR2?>;
}
.theme-box-inverse .theme-box-content, .theme-box-inverse .theme-box-content p {
    color: #<?=SCHEME_COLORFOOTERLINK?>;
}
.theme-box.theme-box-inverse .theme-box-content p, .theme-box.theme-box-inverse .theme-box-content h3 a:hover, .theme-box.theme-box-inverse .theme-box-content h3 a, .theme-box.theme-box-inverse .theme-box-content h3 a:visited  {
    color: #fff;
}
.theme-box-inverse .theme-box-content a, .theme-box-inverse .theme-box-content a:hover, .theme-box-inverse .theme-box-content a:focus, .theme-box-inverse .theme-box-content a:visited {
    color: #fff;
}
.theme-box-primary .theme-box-title {
    background-color: #<?=SCHEME_COLOR1?>;
    color: #fff;
}
.theme-box-primary .theme-box-title .view-more {
    color: #fff3f3;
}
.theme-box-primary .theme-box-content a {
    color: #<?=SCHEME_COLOR2?>;
}
div.select-rating > span:after, div.select-rating > span:after {
    color: #<?=SCHEME_COLOR2?>;
}
.stars-rating [class*="rate-"]:after {
    color: #<?=SCHEME_COLOR1?>;
}
.social-links .fa {
    color: #fff;
}
.table-calendar > tbody > tr > td:hover, .table-calendar > tbody > tr > td.active, .table-calendar > tbody > tr > td:hover > a, .table-calendar > tbody > tr > td.active > a {
    background-color: #<?=SCHEME_COLOR2?>;
}
.list-calendar ul li {
    background-color: #<?=SCHEME_COLOR2?>;
}
.list-calendar ul li.active, .list-calendar ul li:hover, .list-calendar ul li:focus {
    background-color: #<?=SCHEME_COLOR1?>;
}
.calendar-dates mark {
    background-color: rgba(255, 255, 255, 0.95);
}
.calendar-dates .date-item {
    border: 1px solid #d5d8dc;
    background-color: #<?=SCHEME_COLOR1?>;
}
.calendar-dates .date-item.active {
    background-color: #<?=SCHEME_COLOR2?>;
}
.calendar-dates .date-item.active mark {
    background-color: rgba(0, 0, 0, 0.15);
    color: white;
}
.calendar-carousel .calendar-control:hover, .calendar-carousel .calendar-control:focus {
    opacity: 1;
}
.summary-box.summary-classified {
    background-color: white;
    border-color: #<?=SCHEME_COLOR1?>;
}
.summary-box.summary-deal {
    border-color: #<?=SCHEME_COLOR1?>;
}
.summary-box > .summary-content .deal-tag > a {
    background-color: #<?=SCHEME_COLOR2?>;
}
.summary-box > .summary-content .deal-tag > a:hover, .summary-box > .summary-content .deal-tag > a:focus {
    background-color: #<?=SCHEME_COLOR1?>;
}
.summary-box > .summary-content h6 a {
    color: #<?=SCHEME_COLOR1?>;
}
.summary-box > .summary-content h6 a:hover, .summary-box > .summary-content h6 a:focus {
    color: #<?=SCHEME_COLOR2?>;
}
.summary-box > .summary-content h6 a:visited {
    color: #716f87;
}
.summary-box > .summary-content .text-info:hover {
    color: #<?=SCHEME_COLOR2?>;
}
.list-sitemap li > a {
    color: #2b2a33;
}
.list-sitemap li > a:hover, .list-sitemap li > a:focus {
    color: #<?=SCHEME_COLOR1?>;
}
.list-sitemap > li > a:hover, .list-sitemap > li > a:focus {
    color: #<?=SCHEME_COLOR1?>;
}
.panel-theme .panel-body {
    border: 1px solid #d5d8dc;
}
.plan-box {
    border: 1px solid #e3e5e8;
}
.plan-box .plan-title {
    background-color: #<?=SCHEME_COLOR1?>;
}
.plan-box .plan-info {
    background-color: #<?=SCHEME_COLOR1?>;
    opacity: 0.8;
    color: white;
}
.plan-box .plan-info mark {
    color: white;
}
.plan-box .plan-desc ul li.text-striketrough {
    color: #d5d8dc;
}
.plan-box .btn-highlight {
    background-color: #<?=SCHEME_COLOR1?>;
    color: #fff;
    border-color: #<?=SCHEME_COLOR1?>;
}
.plan-box .btn-highlight:hover, .plan-box .btn-highlight:focus {
    background-color: #<?=SCHEME_COLOR1?>;
    opacity: 0.8;
}
.plan-box.plan-popular .plan-title {
    background-color: #<?=SCHEME_COLOR2?>;
    color: #fff;
}
.plan-box.plan-popular .plan-info {
    background-color: #<?=SCHEME_COLOR2?>;
    color: white;
    opacity: 0.8;
}
.plan-box.plan-popular .plan-info mark {
    color: white;
}
.plan-box.plan-popular .btn-highlight {
    background-color: #<?=SCHEME_COLOR2?>;
    color: #fff;
    border-color: #<?=SCHEME_COLOR2?>;
}
.plan-box.plan-popular .btn-highlight:hover, .plan-box.plan-popular .btn-highlight:focus {
    background-color:  #<?=SCHEME_COLOR2?>;
    opacity: 0.8;
}
.treeView .categoryAdd {
    background-color: #<?=SCHEME_COLOR1?>;
}
.multiple-categories ul li.no-child span {
    background-color: #<?=SCHEME_COLOR2?>;
}
.ionicons.ion-ios7-minus-outline:before, .ionicons.ion-ios7-plus-outline:before {
    color: #<?=SCHEME_COLOR2?>;
}
.members .order-head ol {
    background-color: #<?=SCHEME_COLOR1?>;
}
.members .order-head li.active {
    background-color: #<?=SCHEME_COLOR2?>;
}

.tip-base {
    background-color: #fcf8e3;
    border: 1px solid #fbeed5;
    color: #c09853;
}
.tip-base p {
    color: #c09853;
}
.checking .positive {
    color: #27ae60;
}
.checking .negative {
    color: #c0392b;
}
.sponsor-area .notify {
    background-color: #<?=SCHEME_COLOR1?>;
    color: white;
}
.sponsor-area .admin-actions .admin-btn {
    background-color: #<?=SCHEME_COLOR1?>;
    color: #FFFFFF;
}
.sponsor-area .admin-actions .admin-btn:hover, .sponsor-area .admin-actions .admin-btn:focus {
    background-color: #<?=SCHEME_COLOR1?>;
}
.sponsor-area table.warningBOXtext {
    background-color: #fcf8e3;
    border: 1px solid #fbeed5;
    color: #c09853;
}
.sponsor-area [class*="standard-table"] .highlight, .sponsor-area [class*="standard-table"] input[type="file"].highlight {
    border-color: #<?=SCHEME_COLOR2?>;
    background-color: #fff7f7;
}
.sponsor-area [class*="standard-table"] .highlight.successMessage, .sponsor-area [class*="standard-table"] input[type="file"].highlight.successMessage {
    color: #<?=SCHEME_COLOR2?>;
}
.sponsor-area .levelTitle {
    background-color: #<?=SCHEME_COLOR1?>;
    color: white;
}
.sponsor-area .levelTopdetail {
    background-color: #7b7a84;
    color: #fff;
}
.sponsor-area .webitem .desc p span {
    color: #f39c12;
}
.sponsor-area .webitem .desc span.status > span.status-active {
    color: #<?=SCHEME_COLOR2?>;
}
.sponsor-area .webitem .desc span.status > span.status-active:before {
    background-color: #<?=SCHEME_COLOR2?>;
}
.sponsor-area .webitem .desc span.status > span.status-suspended {
    color: #f39c12;
}
.sponsor-area .webitem .desc span.status > span.status-suspended:before {
    background-color: #f39c12;
}
.sponsor-area .webitem .desc span.status > span.status-expired {
    color: #c0392b;
}
.sponsor-area .webitem .desc span.status > span.status-expired:before {
    background-color: #c0392b;
}
.sponsor-area .webitem .desc span.status > span.status-pending {
    color: #f39c12;
}
.sponsor-area .webitem .desc span.status > span.status-pending:before {
    background-color: #f39c12;
}
.sponsor-area .webitem .action {
    background-color: #fff;
    color: #<?=SCHEME_COLOR2?>;
}
.sponsor-area .webitem.active, .sponsor-area .webitem.active:hover {
    border-color: #<?=SCHEME_COLOR2?>;
    box-shadow: 1px 2px 2px #f4f4f4;
}
.sponsor-area .addcontent a {
    color: #<?=SCHEME_COLOR2?>;
}
.sponsor-area .addcontent a:hover {
    color: #802d30;
}
.sponsor-area .alert-new {
    background-color: #<?=SCHEME_COLOR2?>;
}
.sponsor-area .dashboard section.stats-summary h1 {
    color: #<?=SCHEME_COLOR1?>;
}
.sponsor-area .dashboard section.stats-summary h5 {
    color: #<?=SCHEME_COLOR1?>;
}
.sponsor-area .dashboard .game-completion .step a, .sponsor-area .dashboard .game-completion .step a:visited {
    color: #<?=SCHEME_COLOR2?>;
}
.sponsor-area .dashboard .game-completion .step a:hover {
    color: #<?=SCHEME_COLOR2?>;
}
.sponsor-area .dashboard .item-review .review-summary span {
    color: #<?=SCHEME_COLOR2?>;
}
.sponsor-area .dashboard .item-review .review-summary span.text-muted {
    color: #999899;
}
.sponsor-area .dashboard .item-review .review-summary span.text-highlight {
    color: #<?=SCHEME_COLOR2?>;
}
.sponsor-area .dashboard .item-review .review-summary.new {
    border: 1px solid #<?=SCHEME_COLOR2?>;
}
.sponsor-area .minor-nav ul li a:hover, .sponsor-area .minor-nav ul li a.active {
    background-color: #<?=SCHEME_COLOR1?>;
    color: white;
}
.sponsor-area .table-itemlist .main-options b {
    color: #<?=SCHEME_COLOR2?>;
}
.sponsor-area .table-itemlist .status-pending {
    color: #f39c12;
}
.sponsor-area .table-itemlist .status-suspended {
    color: #<?=SCHEME_COLOR2?>;
}
.sponsor-area .table-itemlist .status-expired {
    color: #c0392b;
}
.sponsor-area .table-itemlist .status-active {
    color: #<?=SCHEME_COLOR2?>;
}
.modal-header {
    background-color: #<?=SCHEME_COLOR1?>;
}
.tooltip {
    font-family: <?=SCHEME_FONTOPTION?>;
}
.popover {
    font-family: <?=SCHEME_FONTOPTION?>;
}
.carousel-indicators.carousel-name-indicators .active {
    background-color: #<?=SCHEME_COLOR1?>;
}
.slider-handle {
    background-color: #<?=SCHEME_COLOR1?>;
}
.slider-selection {
    background-color: #<?=SCHEME_COLOR2?>;
}
.sponsored-ads .title {
    color: #<?=SCHEME_COLOR1?>;
    opacity: 0.5;
}
.slider-handle:after {
    color: white;
}
.datepicker-days .active.selected.day {
    background-color: #<?=SCHEME_COLOR2?>;
    border-color: #<?=SCHEME_COLOR2?>;
}
.social-follow a {
    background-color: #<?=SCHEME_COLOR2?>;
}
.social-follow a:hover {
    background-color: #<?=SCHEME_COLOR2?>;
    opacity: 0.8
}
.edit-this-page:before {
    background-color: #<?=SCHEME_COLOR1?>;
}
.theme-box-reviews .theme-box-content h4 a {
    color: #<?=SCHEME_COLOR2?>;
}
.download-yourapps a {
    color: white;
    opacity: 1;
}
.results-page.results-page-grid .summary-box > .summary-content .contact-info mark a {
    color: #<?=SCHEME_COLOR2?>;
}
header .navbar-inverse .navbar-nav li a.btn-success {
    background-color: #<?=SCHEME_COLOR2?>;
    border-color: #<?=SCHEME_COLOR2?>;
}
.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
    background-color: #<?=SCHEME_COLOR1?>;
    color: white;
}
header.navbar-centered-logo .navbar-nav > li a.btn-primary-inverted {
    border-color: #<?=SCHEME_COLOR2?>;
    color: #<?=SCHEME_COLOR2?>;
}
header.navbar-centered-logo .navbar-nav > li a.btn-primary-inverted:hover {
    background-color: #<?=SCHEME_COLOR2?>;
}
header.navbar-logo-plus-social .navbar-inverse .main-navbar .navbar-nav li.active a,
header.navbar-logo-plus-social .navbar-default .main-navbar .navbar-nav > li > a.btn-success:hover,
header.navbar-logo-plus-social .navbar-inverse .main-navbar .navbar-nav li a:hover,
header.navbar-logo-plus-social .navbar-inverse .main-navbar .navbar-nav li a:focus {
    background-color: #<?=SCHEME_COLOR2?>;
}
header.navbar-logo-plus-social .navbar-default .main-navbar .navbar-nav > li > a.social-links .fa {
    color: #<?=SCHEME_COLOR2?>;
}
header.navbar-logo-plus-social .navbar-default .main-navbar .navbar-nav > li > a:hover,
header.navbar-logo-plus-social .navbar-default .navbar-nav > li.divider:before {
    color: #<?=SCHEME_COLORNAVBARLINK?>;
}
@media (max-width: 768px) {
  header.navbar-logo-plus-social .navbar-default .main-navbar .navbar-nav > li > a:hover {
    background-color: #<?=SCHEME_COLOR2?>;
  }
}
.navbar-inverse .navbar-nav > li > a:not(.btn):hover,
.navbar-inverse .navbar-nav > li > a:not(.btn):focus,
.navbar-inverse .navbar-nav > li > a {
    color: #<?=SCHEME_COLORNAVBARLINK?>;
}
