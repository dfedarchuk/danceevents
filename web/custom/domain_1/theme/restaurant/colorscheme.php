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
body {
	color: #111;
	font-family: <?=SCHEME_FONTOPTION?>;
}
.text-muted {
	color: #b2b2b2 !important;
}
.text-primary {
color: #<?=SCHEME_COLOR1?>;
}
a, .hidden-info, .breadcrumb > li a {
color: #<?=SCHEME_COLOR1?>;
}
a:hover, .hidden-info:hover, .breadcrumb > li a:hover, a:focus, .hidden-info:focus, .breadcrumb > li a:focus {
color: #<?=SCHEME_COLOR1?>;
}
hr {
border-top: 1px solid #<?=SCHEME_COLOR1?>;
opacity: .5;
}
.text-striketrough {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.text-highlight {
color: #<?=SCHEME_COLOR1?>;
}
.text-primary {
color: #<?=SCHEME_COLOR1?>;
}
a.text-primary:hover {
color: gba(<?=SCHEME_COLOR1?>,0.9);
}
.text-info {
color: #<?=SCHEME_COLOR1?>;
}
a.text-info:hover {
color: gba(<?=SCHEME_COLOR1?>,0.6);
}
.bg-primary {
color: #<?=SCHEME_COLORNAVBAR?>;
background-color: #<?=SCHEME_COLOR1?>;
}
a.bg-primary:hover {
background-color: #<?=SCHEME_COLOR1?>;
}
.btn-default {
color: white;
background-color: #<?=SCHEME_COLOR1?>;
border-color: #<?=SCHEME_COLOR1?>;
}
.btn-default:hover, .btn-default:focus, .btn-default.focus, .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
color: white;
background-color: #<?=SCHEME_COLOR1?>;
border-color: #<?=SCHEME_COLOR1?>;
}
.btn-default.disabled, .btn-default[disabled], fieldset[disabled] .btn-default, .btn-default.disabled:hover, .btn-default[disabled]:hover, fieldset[disabled] .btn-default:hover, .btn-default.disabled:focus, .btn-default[disabled]:focus, fieldset[disabled] .btn-default:focus, .btn-default.disabled.focus, .btn-default[disabled].focus, fieldset[disabled] .btn-default.focus, .btn-default.disabled:active, .btn-default[disabled]:active, fieldset[disabled] .btn-default:active, .btn-default.disabled.active, .btn-default[disabled].active, fieldset[disabled] .btn-default.active {
background-color: #<?=SCHEME_COLOR1?>;
border-color: #<?=SCHEME_COLOR1?>;
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
opacity: 0.8;
}
.btn-primary.disabled, .btn-primary[disabled], fieldset[disabled] .btn-primary, .btn-primary.disabled:hover, .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary:hover, .btn-primary.disabled:focus, .btn-primary[disabled]:focus, fieldset[disabled] .btn-primary:focus, .btn-primary.disabled.focus, .btn-primary[disabled].focus, fieldset[disabled] .btn-primary.focus, .btn-primary.disabled:active, .btn-primary[disabled]:active, fieldset[disabled] .btn-primary:active, .btn-primary.disabled.active, .btn-primary[disabled].active, fieldset[disabled] .btn-primary.active {
background-color: #<?=SCHEME_COLOR1?>;
border-color: #<?=SCHEME_COLOR1?>;
}
.btn-success {
color: #fff;
background-color: #<?=SCHEME_COLOR1?>;
border-color: #<?=SCHEME_COLOR1?>;
}
.btn-success:hover, .btn-success:focus, .btn-success.focus, .btn-success:active, .btn-success.active, .open > .dropdown-toggle.btn-success {
color: #fff;
background-color: #<?=SCHEME_COLOR1?>;
border-color: #<?=SCHEME_COLOR1?>;
}
.btn-success.disabled, .btn-success[disabled], fieldset[disabled] .btn-success, .btn-success.disabled:hover, .btn-success[disabled]:hover, fieldset[disabled] .btn-success:hover, .btn-success.disabled:focus, .btn-success[disabled]:focus, fieldset[disabled] .btn-success:focus, .btn-success.disabled.focus, .btn-success[disabled].focus, fieldset[disabled] .btn-success.focus, .btn-success.disabled:active, .btn-success[disabled]:active, fieldset[disabled] .btn-success:active, .btn-success.disabled.active, .btn-success[disabled].active, fieldset[disabled] .btn-success.active {
background-color: #<?=SCHEME_COLOR1?>;
border-color: #<?=SCHEME_COLOR1?>;
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
.btn-info.disabled, .btn-info[disabled], fieldset[disabled] .btn-info, .btn-info.disabled:hover, .btn-info[disabled]:hover, fieldset[disabled] .btn-info:hover, .btn-info.disabled:focus, .btn-info[disabled]:focus, fieldset[disabled] .btn-info:focus, .btn-info.disabled.focus, .btn-info[disabled].focus, fieldset[disabled] .btn-info.focus, .btn-info.disabled:active, .btn-info[disabled]:active, fieldset[disabled] .btn-info:active, .btn-info.disabled.active, .btn-info[disabled].active, fieldset[disabled] .btn-info.active {
background-color: #<?=SCHEME_COLOR1?>;
border-color: #<?=SCHEME_COLOR1?>;
}
.btn-link {
color: #<?=SCHEME_COLOR1?>;
}
.btn-link:hover, .btn-link:focus {
color: #<?=SCHEME_COLOR1?>;
}
.btn-link[disabled]:hover, fieldset[disabled] .btn-link:hover, .btn-link[disabled]:focus, fieldset[disabled] .btn-link:focus {
color: #<?=SCHEME_COLOR1?>;
}
.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus {
background-color: #<?=SCHEME_COLOR1?>;
}
.dropdown-menu > .disabled > a, .dropdown-menu > .disabled > a:hover, .dropdown-menu > .disabled > a:focus {
color: #<?=SCHEME_COLOR1?>;
}
.form-control::-moz-placeholder, select.select::-moz-placeholder, .simple-select > select::-moz-placeholder {
color: #565656;
opacity: 1;
}
.form-control:-ms-input-placeholder, select.select:-ms-input-placeholder, .simple-select > select:-ms-input-placeholder {
color: #565656;
}
.form-control::-webkit-input-placeholder, select.select::-webkit-input-placeholder, .simple-select > select::-webkit-input-placeholder {
color: #565656;
}

.form-control, select.select, .simple-select > select {
	color: #111;
	border-color: #ddd;
}
.input-group-addon.bg-info, .input-group-addon-invisible.bg-info {
	border-color: #ddd;
}
.input-group-addon, .input-group-addon-invisible {
color: #<?=SCHEME_COLOR1?>;
}
.input-group .simple-select .form-control, .input-group .simple-select .form-control:last-child, .input-group .simple-select .form-control:first-child {
border-color: #<?=SCHEME_COLOR1?>;
}
.nav > li > a:hover, .nav > li > a:focus {
background-color: #<?=SCHEME_COLOR1?>;
}
.nav > li.disabled > a {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.nav > li.disabled > a:hover, .nav > li.disabled > a:focus {
color: #<?=SCHEME_COLORNAVBAR?>;
}
.nav .open > a, .nav .open > a:hover, .nav .open > a:focus {
background-color: #<?=SCHEME_COLOR1?>;
border-color: #<?=SCHEME_COLOR1?>;
}
.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
color: white;
background-color: #<?=SCHEME_COLOR1?>;
}
.navbar-toggle {
background-color: #<?=SCHEME_COLOR1?>;
border: 1px solid #<?=SCHEME_COLOR1?>;
}
.navbar-default {
background-color: #<?=SCHEME_COLORNAVBARLINK?>;
border-color: #<?=SCHEME_COLORNAVBAR?>;
}
.navbar-default .navbar-brand {
color: #<?=SCHEME_COLORNAVBAR?>;
}
.navbar-default .navbar-brand:hover, .navbar-default .navbar-brand:focus {
color: #<?=SCHEME_COLOR1?>;
}
.navbar-default .navbar-text {
color: #<?=SCHEME_COLORNAVBAR?>;
}
.navbar-default .navbar-nav > li > a {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}

.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
color: #fff;
background-color: #<?=SCHEME_COLOR1?>;
}
.navbar-default .navbar-nav > li.divider:before {
color: #<?=SCHEME_COLORNAVBAR?>;
}
.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
color: #fff;
background-color: #<?=SCHEME_COLOR1?>;
}
.navbar-default .navbar-nav > .disabled > a, .navbar-default .navbar-nav > .disabled > a:hover, .navbar-default .navbar-nav > .disabled > a:focus {
color: #<?=SCHEME_COLORNAVBAR?>;
background-color: #<?=SCHEME_COLOR1?>;
}
.navbar-default .navbar-toggle .icon-bar {
background-color: #<?=SCHEME_COLOR1?>;
}
.navbar-default .navbar-collapse, .navbar-default .navbar-form {
border-color: #<?=SCHEME_COLORNAVBAR?>;
}
.navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus {
background-color: #<?=SCHEME_COLOR1?>;
color: #<?=SCHEME_COLORNAVBAR?>;
}
@media (max-width: 767px) {
.navbar-default .navbar-nav .open .dropdown-menu > li > a {
color: #<?=SCHEME_COLORNAVBAR?>;
}
}
.navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
color: #<?=SCHEME_COLOR1?>;
background-color: #<?=SCHEME_COLORNAVBAR?>;
}
.navbar-default .navbar-nav .open .dropdown-menu > .active > a, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
color: #<?=SCHEME_COLORNAVBAR?>;
background-color: #<?=SCHEME_COLOR1?>;
}
.navbar-default .navbar-nav .open .dropdown-menu > .disabled > a, .navbar-default .navbar-nav .open .dropdown-menu > .disabled > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > .disabled > a:focus {
color: #<?=SCHEME_COLORNAVBARLINK?>;
background-color: #<?=SCHEME_COLORNAVBAR?>;
}
@media (min-width: 768px){
.nav-tabs.nav-justified > li > a {
border-bottom: 1px solid #ddd;
}
}
.nav-tabs.nav-justified > .active > a, .nav-tabs.nav-justified > .active > a:hover, .nav-tabs.nav-justified > .active > a:focus {
	border-color: #ddd;
}
#advertisePlans .nav-tabs.nav-justified > .active > a, #advertisePlans .nav-tabs.nav-justified > .active > a:hover, #advertisePlans .nav-tabs.nav-justified > .active > a:focus {
	border-bottom-color: #<?=SCHEME_COLORNAVBAR?>;
}
.nav-tabs.nav-justified > li > a {
	border-bottom-color: #ddd;
	border-right-color: #<?=SCHEME_COLORNAVBAR?>;
	background-color:#ddd;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
	color:#<?=SCHEME_COLOR1?>;
}
.nav-tabs > li > a:hover {
	color:#444;
}
.navbar-default .navbar-link {
color: #<?=SCHEME_COLOR1?>;
}
.navbar-default .navbar-link:hover {
color: #<?=SCHEME_COLOR1?>;
}
.navbar-default .btn-link {
color: #<?=SCHEME_COLORNAVBAR?>;
}
.navbar-default .btn-link:hover, .navbar-default .btn-link:focus {
color: #<?=SCHEME_COLOR1?>;
}
.navbar-default .btn-link[disabled]:hover, fieldset[disabled] .navbar-default .btn-link:hover, .navbar-default .btn-link[disabled]:focus, fieldset[disabled] .navbar-default .btn-link:focus {
color: #<?=SCHEME_COLORNAVBAR?>;
}
.navbar-inverse {
background-color: #<?=SCHEME_COLOR1?>;
}
.navbar-inverse .navbar-brand {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.navbar-inverse .navbar-brand:hover, .navbar-inverse .navbar-brand:focus {
color: #<?=SCHEME_COLORNAVBARLINK?>;
background-color: transparent;
}
.navbar-inverse .navbar-text {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.navbar-inverse .navbar-nav > li > a {
color:  #fff;
}
.navbar-inverse .navbar-nav > li > a:not(.btn):hover, .navbar-inverse .navbar-nav > li > a:not(.btn):focus {
color:  #fff;
background-color: #<?=SCHEME_COLOR1?>;
}
.navbar-inverse .navbar-nav > li > a.btn {
color: #fff;
}
.navbar-inverse .navbar-nav > li.divider:before {
color: #fff;
}
.navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:hover, .navbar-inverse .navbar-nav > .active > a:focus {
color: <?=SCHEME_COLOR2?>;
background-color: #<?=SCHEME_COLOR1?>;
}
.navbar-inverse .navbar-nav > .disabled > a, .navbar-inverse .navbar-nav > .disabled > a:hover, .navbar-inverse .navbar-nav > .disabled > a:focus {
color: #<?=SCHEME_COLORNAVBAR?>;
background-color: transparent;
}
.navbar-inverse .navbar-toggle {
border-color: #<?=SCHEME_COLOR1?>;
}
.navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form {
border-color: #<?=SCHEME_COLOR2?>;
}
.navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:hover, .navbar-inverse .navbar-nav > .open > a:focus {
background-color: #<?=SCHEME_COLOR1?>;
}
.navbar-inverse .navbar-nav > li > a.btn.btn-success {
background-color: #<?=SCHEME_COLOR2?>;
}
header.navbar-centered-logo .navbar-nav > li a.btn-primary-inverted {
border-color: #<?=SCHEME_COLOR2?>;
color: #<?=SCHEME_COLOR2?>;
}
header.navbar-centered-logo .navbar-nav > li a.btn-primary-inverted:hover, header.navbar-centered-logo .navbar-nav > li a.btn-primary-inverted:focus { 
background: #<?=SCHEME_COLOR2?>; 
color: #<?=SCHEME_COLORNAVBAR?>;
}
header.navbar-logo-plus-social .navbar-default .main-navbar .navbar-nav > li > a:hover {
color: #<?=SCHEME_COLOR1?>;
}
header.navbar-logo-plus-social .navbar-default .main-navbar .navbar-nav > li > a.btn-success:hover {
background-color: #<?=SCHEME_COLOR1?>;	
color: #fff;
opacity: 0.8;
}
header.navbar-logo-plus-social .navbar-inverse .main-navbar .navbar-nav li.active a,
header.navbar-logo-plus-social .navbar-inverse .main-navbar .navbar-nav li a:hover, 
header.navbar-logo-plus-social .navbar-inverse .main-navbar .navbar-nav li a:focus {
background-color: #<?=SCHEME_COLOR2?>;		
}
.carousel-indicators li {
	border-color: #<?=SCHEME_COLOR2?>;
}
.carousel-indicators .active {
	background-color: #<?=SCHEME_COLOR2?>;
}
.breadcrumb > li a {
color: #<?=SCHEME_COLOR1?>;
}
.breadcrumb > .active {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.breadcrumb-steps > li {
background-color: #<?=SCHEME_COLOR1?>;
color: #<?=SCHEME_COLOR1?>;
font-weight: 300;
}
.breadcrumb-steps > li + li:before {
border-color: transparent transparent transparent #<?=SCHEME_COLOR1?>;
}
.breadcrumb-steps.breadcrumb-steps-inverse > li {
background-color: #<?=SCHEME_COLOR1?>;
color: #<?=SCHEME_COLOR1?>;
}
.breadcrumb-steps.breadcrumb-steps-inverse > li + li:before {
border-color: transparent transparent transparent #<?=SCHEME_COLOR1?>;
}
.breadcrumb-steps.breadcrumb-steps-inverse > .active, .breadcrumb-steps.breadcrumb-steps-inverse > .active a {
background-color: #<?=SCHEME_COLOR1?>;
color: #<?=SCHEME_COLOR1?>;
}
.breadcrumb-steps.breadcrumb-steps-inverse > .active + li:before, .breadcrumb-steps.breadcrumb-steps-inverse > .active a + li:before {
border-color: transparent transparent transparent #<?=SCHEME_COLOR1?>;
}
.pagination > li > a, .pagination > li > span {
color: #<?=SCHEME_COLOR1?>;
border: 1px solid #<?=SCHEME_COLOR1?>;
}
.pagination > li > a:hover, .pagination > li > span:hover, .pagination > li > a:focus, .pagination > li > span:focus {
color: #<?=SCHEME_COLOR1?>;
background-color: #<?=SCHEME_COLOR1?>;
border-color: #ddd;
}
.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
background-color: #<?=SCHEME_COLOR1?>;
border-color: #<?=SCHEME_COLOR1?>;
cursor: default;
}
.pagination > .disabled > span, .pagination > .disabled > span:hover, .pagination > .disabled > span:focus, .pagination > .disabled > a, .pagination > .disabled > a:hover, .pagination > .disabled > a:focus {
color: #<?=SCHEME_COLOR1?>;
}
.badge.badge-primary {
background-color: #<?=SCHEME_COLOR1?>;
}
.badge.badge-success {
background-color: #<?=SCHEME_COLOR1?>;
}
.badge.badge-default {
border: 1px solid #<?=SCHEME_COLOR1?>;
background-color: #<?=SCHEME_COLOR1?>;
color: white;
}
.list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus {
background-color: #<?=SCHEME_COLOR1?>;
border-color: #<?=SCHEME_COLOR1?>;
}
.list-group-item.active .list-group-item-text, .list-group-item.active:hover .list-group-item-text, .list-group-item.active:focus .list-group-item-text {
color: <?=SCHEME_COLOR2?>;
}
.panel .panel-footer {
	background-color: transparent;
}
.panel-primary {
border-color: #<?=SCHEME_COLOR1?>;
}
.panel-primary > .panel-heading {
background-color: #<?=SCHEME_COLOR1?>;
border-color: #<?=SCHEME_COLOR1?>;
}
.panel-primary > .panel-heading + .panel-collapse > .panel-body {
border-top-color: #<?=SCHEME_COLOR1?>;
}
.panel-primary > .panel-heading .badge {
color: #<?=SCHEME_COLOR1?>;
}
.panel-primary > .panel-footer + .panel-collapse > .panel-body {
border-bottom-color: #<?=SCHEME_COLOR1?>;
}
.well {
border-color: #DDD;
}
.well-translucid:before {
background-color: #<?=SCHEME_COLOR2?>;
}
.header-brand {
background-color: #<?=SCHEME_COLORNAVBAR?>;
}
.footer-static-bottom {
background-color: #<?=SCHEME_COLORNAVBAR?>;
color: #<?=SCHEME_COLORFOOTERLINK?>;
}
.footer-static-bottom a {
color: #<?=SCHEME_COLORFOOTERLINK?>;
}
.footer-static-bottom a:hover, .footer-static-bottom a:focus {
color: #<?=SCHEME_COLORFOOTERLINK?>;
opacity: 0.8;
text-decoration: underline;
}
.footer-static-bottom p.small a {
color: #<?=SCHEME_COLORFOOTERLINK?>;
}
.footer-static-bottom .footer-links {
background-color: rgba(255, 255, 255, 0.1);
}
.footer-static-bottom .footer-links address .fa,
.footer-static-bottom .footer-links .social-links .fa {
color: #<?=SCHEME_COLOR2?>;
}
.footer-static-bottom.footer-with-newsletter .footer-social-links li .social-links .fa {
color: #<?=SCHEME_COLORFOOTERLINK?>;	
}
.footer-static-bottom.footer-with-socialmedia .social-links {
background-color: rgba(0,0,0,0.2);
}
.block.block-inverse {
background-color: #<?=SCHEME_COLOR2?>;
}
.sponsored-ads .title {
color: #<?=SCHEME_COLOR1?>;
}
.sponsored-ads .text {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.search-toolbar .panel-default {
border: 1px solid #<?=SCHEME_COLOR1?>;
background-color:transparent;
}
.search-filter .btn-filter {
color: #<?=SCHEME_COLOR1?>;
}
.search-filter .panel-info .panel-title {
border-top: 1px solid #<?=SCHEME_COLOR1?>;
border-bottom: 1px solid #<?=SCHEME_COLOR1?>;
margin-top: 1px;
}
.search-filter .panel-primary > .panel-title {
background-color: #<?=SCHEME_COLOR1?>;
}
.search-filter .list-group .list-group-item.active > a:after {
color: #<?=SCHEME_COLOR1?>;
}
.search-filter .list-group .list-group-item .badge {
background-color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.search-filter .list-categorytree .box-content {
background-color: #<?=SCHEME_COLOR1?>;
border-top: 1px solid #<?=SCHEME_COLOR1?>;
}
.hidden-info {
color: #<?=SCHEME_COLOR1?>;
}
.theme-title {
color: #111;
}
.theme-title > .view-more, .theme-title-large > .view-more {
color: #<?=SCHEME_COLOR1?>;
}
.theme-title-large h3 a {
color: #111;
}
.float-date, .theme-box .date.float-date {
background-color: #<?=SCHEME_COLOR1?>;
color: #fff;
}
.date.float-date-sm > em, .theme-box .date.float-date-sm > em {
background-color: #<?=SCHEME_COLOR1?>;
color: #fff;
}
.theme-box-featured .theme-box-content {
border-color: #ddd;
background-color: rgba(24,12,12,0.6);
}
.theme-box .theme-box-content a.text-success {
color: #<?=SCHEME_COLOR1?>;
}
.theme-box .theme-box-content .text-price .text-striketrough {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.theme-box .theme-box-content .text-price .text-highlight, .theme-box .theme-box-content .text-price .text-bigger, .theme-box .theme-box-content .text-price .text-highlight mark, .theme-box .theme-box-content .text-price .text-bigger mark {
color: #<?=SCHEME_COLOR1?>;
}
.theme-box .theme-box-content .text-price.text-bigger, .theme-box .theme-box-content .text-price.text-bigger mark {
color: #<?=SCHEME_COLOR1?>;
}
.theme-box .theme-box-content .deal-tag,
.theme-box .theme-box-content .deal-tag a {
background-color: #<?=SCHEME_COLOR1?>;
}
.theme-box .theme-box-content .deal-tag a:hover, .theme-box .theme-box-content .deal-tag a:focus {
background-color: #<?=SCHEME_COLOR1?>;
}
.theme-box-inverse .theme-box-content, .theme-box-inverse .theme-box-content p {
color: #<?=SCHEME_COLOR1?>;
}

.theme-box-primary .theme-box-title {
background-color: #<?=SCHEME_COLOR1?>;
}
.theme-box-primary .theme-box-title .view-more {
color: #<?=SCHEME_COLOR1?>;
}
.theme-box-primary .theme-box-content a {
color: #<?=SCHEME_COLOR1?>;
}
.stars-rating [class*="rate-"]:after {
color: #<?=SCHEME_COLOR1?>;
}
.review-box .review-top a {
color: #<?=SCHEME_COLOR1?>;
}
.review-box .review-top p {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.review-box .review-bottom p {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.list-calendar ul li {
background-color: #<?=SCHEME_COLOR1?>;
}
.list-calendar ul li.active, .list-calendar ul li:hover, .list-calendar ul li:focus {
background-color: #a0583a;
}
.calendar-dates .date-item {
border: 1px solid #<?=SCHEME_COLOR1?>;
background-color: #<?=SCHEME_COLOR1?>;
}
.calendar-dates .date-item.active {
background-color: #<?=SCHEME_COLOR1?>;
}
.summary-box.summary-event {
border-color: #<?=SCHEME_COLOR1?>;
}
.summary-box > .summary-content .deal-tag > a {
background-color: #<?=SCHEME_COLOR1?>;
}
.summary-box > .summary-content .deal-tag > a:hover, .summary-box > .summary-content .deal-tag > a:focus {
background-color: #<?=SCHEME_COLOR1?>;
}
.summary-box > .summary-content .contact-info mark a:hover, .summary-box > .summary-content .contact-info mark a:focus, .summary-box > .summary-content .contact-info mark a:visited {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.summary-box > .summary-content h6 a {
color: #<?=SCHEME_COLOR1?>;
}
.summary-box > .summary-content h6 a:hover, .summary-box > .summary-content h6 a:focus {
color: #<?=SCHEME_COLOR1?>;
}
.summary-box > .summary-content h6 a:visited {
color:  #<?=SCHEME_COLOR1?>;
}
.summary-box > .summary-content .text-info:hover {
color: #<?=SCHEME_COLOR1?>;
}
.details-sidebar .tag-cloud .badge {
background-color: #<?=SCHEME_COLOR1?>;
color: #<?=SCHEME_COLOR1?>;
}
.clock .clock-item em, .clock span em {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.post-tags .badge {
background-color: #<?=SCHEME_COLOR1?>;
}
.list-sitemap li > a {
color: #<?=SCHEME_COLOR1?>;
}
.list-sitemap li > a:hover, .list-sitemap li > a:focus {
color: #<?=SCHEME_COLOR1?>;
}
.list-sitemap > li > a:hover, .list-sitemap > li > a:focus {
color: #<?=SCHEME_COLOR1?>;
}
.plan-box {
border: 1px solid #ddd;
}
.plan-box .plan-title {
background-color: #<?=SCHEME_COLOR1?>;
color: #fff;
}
.plan-box .plan-info {
background-color: #<?=SCHEME_COLOR1?>;
opacity:0.8;
color: #fff;
}
.plan-box .plan-desc ul li.text-striketrough {
color: #ddd;
}
.plan-box .btn-highlight {
background-color: #<?=SCHEME_COLOR1?>;
opacity:0.8;
color: #fff;
border-color: #<?=SCHEME_COLOR1?>;
}
.plan-box .btn-highlight:hover, .plan-box .btn-highlight:focus {
background-color: #<?=SCHEME_COLOR1?>;
opacity:1;
}
.plan-box.plan-popular .plan-title {
background-color: #<?=SCHEME_COLOR2?>;
color: #fff;
}
.plan-box.plan-popular .plan-info {
background-color: #<?=SCHEME_COLOR2?>;
color: white;
opacity:0.8;
}
.plan-box.plan-popular .btn-highlight {
background-color: #<?=SCHEME_COLOR2?>;
color: #fff;
border-color: #<?=SCHEME_COLOR2?>;
}
.plan-box.plan-popular .btn-highlight:hover, .plan-box.plan-popular .btn-highlight:focus {
background-color: #<?=SCHEME_COLOR2?>;
}
.treeView .categoryAdd {
background-color: #<?=SCHEME_COLOR1?>;
}
.treeView .switchOpen, .treeView .switchClose {
background-color: #<?=SCHEME_COLOR1?>;
}
.sponsor-area .order-head li {
background-color: #<?=SCHEME_COLOR1?>;
}
.sponsor-area .order-head li.active {
background-color: #<?=SCHEME_COLOR1?>;
}
.notify {
background-color: #<?=SCHEME_COLOR1?>;
}
.addcontent a {
color: #<?=SCHEME_COLOR1?>;
}
.addcontent a:hover {
color: #391201;
}
.dashboard section.stats-summary h1 {
color: #<?=SCHEME_COLOR1?>;
}
.dashboard section.stats-summary h5 {
color: #<?=SCHEME_COLOR1?>;
}
.dashboard section.stats-summary p {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.dashboard .game-completion .step a, .dashboard .game-completion .step a:visited {
color: #<?=SCHEME_COLOR1?>;
}
.dashboard .game-completion .step a:hover {
color: #<?=SCHEME_COLOR1?>;
}
.dashboard .item-review .review-summary span {
color: #<?=SCHEME_COLOR1?>;
}
.dashboard .item-review .review-summary span.text-highlight {
color: #<?=SCHEME_COLOR1?>;
}
.dashboard .item-review .review-summary.new {
border: 1px solid #<?=SCHEME_COLOR1?>;
}
.dashboard .item-review .review-detail em {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.dashboard .item-review:hover {
border-color: #<?=SCHEME_COLORNAVBARLINK?>;
box-shadow: 0 0 3px #<?=SCHEME_COLOR1?>;
}
.chart-legends ul li {
color: #<?=SCHEME_COLORNAVBARLINK?>;
}
.minor-nav ul li a:hover, .minor-nav ul li a.active {
background-color: #<?=SCHEME_COLOR1?>;
}
.multiple-categories ul li.no-child span {
background: #<?=SCHEME_COLOR1?>;
}
.item-gallery.image-default:before {
background-color: #<?=SCHEME_COLOR1?>;
}
.slider-selection {
background-color: #<?=SCHEME_COLOR1?>;
}
.slider-selection.tick-slider-selection {
background-color: #<?=SCHEME_COLOR1?>;
}
.slider-handle {
background-color: #<?=SCHEME_COLOR1?>;
}
.selectize-control.multi .selectize-input > div.active {
background: #<?=SCHEME_COLOR1?>;
}
.selectize-dropdown .active {
background-color: #<?=SCHEME_COLOR1?>;
color: #<?=SCHEME_COLOR1?>;
}
.selectize-dropdown .active.create {
color: #<?=SCHEME_COLOR1?>;
}
.datepicker table tr td.active, .datepicker table tr td.active:hover, .datepicker table tr td.active.disabled, .datepicker table tr td.active.disabled:hover {
background-color: #<?=SCHEME_COLOR1?>;
}
.datepicker table tr td.active:hover, .datepicker table tr td.active:hover:hover, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active.disabled:hover:hover, .datepicker table tr td.active:focus, .datepicker table tr td.active:hover:focus, .datepicker table tr td.active.disabled:focus, .datepicker table tr td.active.disabled:hover:focus, .datepicker table tr td.active.focus, .datepicker table tr td.active:hover.focus, .datepicker table tr td.active.disabled.focus, .datepicker table tr td.active.disabled:hover.focus, .datepicker table tr td.active:active, .datepicker table tr td.active:hover:active, .datepicker table tr td.active.disabled:active, .datepicker table tr td.active.disabled:hover:active, .datepicker table tr td.active.active, .datepicker table tr td.active:hover.active, .datepicker table tr td.active.disabled.active, .datepicker table tr td.active.disabled:hover.active, .open > .dropdown-toggle.datepicker table tr td.active, .open > .dropdown-toggle.datepicker table tr td.active:hover, .open > .dropdown-toggle.datepicker table tr td.active.disabled, .open > .dropdown-toggle.datepicker table tr td.active.disabled:hover {
background-color: #<?=SCHEME_COLOR1?>;
}
.datepicker table tr td.active.disabled, .datepicker table tr td.active:hover.disabled, .datepicker table tr td.active.disabled.disabled, .datepicker table tr td.active.disabled:hover.disabled, .datepicker table tr td.active[disabled], .datepicker table tr td.active:hover[disabled], .datepicker table tr td.active.disabled[disabled], .datepicker table tr td.active.disabled:hover[disabled], fieldset[disabled] .datepicker table tr td.active, fieldset[disabled] .datepicker table tr td.active:hover, fieldset[disabled] .datepicker table tr td.active.disabled, fieldset[disabled] .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active:hover.disabled:hover, .datepicker table tr td.active.disabled.disabled:hover, .datepicker table tr td.active.disabled:hover.disabled:hover, .datepicker table tr td.active[disabled]:hover, .datepicker table tr td.active:hover[disabled]:hover, .datepicker table tr td.active.disabled[disabled]:hover, .datepicker table tr td.active.disabled:hover[disabled]:hover, fieldset[disabled] .datepicker table tr td.active:hover, fieldset[disabled] .datepicker table tr td.active:hover:hover, fieldset[disabled] .datepicker table tr td.active.disabled:hover, fieldset[disabled] .datepicker table tr td.active.disabled:hover:hover, .datepicker table tr td.active.disabled:focus, .datepicker table tr td.active:hover.disabled:focus, .datepicker table tr td.active.disabled.disabled:focus, .datepicker table tr td.active.disabled:hover.disabled:focus, .datepicker table tr td.active[disabled]:focus, .datepicker table tr td.active:hover[disabled]:focus, .datepicker table tr td.active.disabled[disabled]:focus, .datepicker table tr td.active.disabled:hover[disabled]:focus, fieldset[disabled] .datepicker table tr td.active:focus, fieldset[disabled] .datepicker table tr td.active:hover:focus, fieldset[disabled] .datepicker table tr td.active.disabled:focus, fieldset[disabled] .datepicker table tr td.active.disabled:hover:focus, .datepicker table tr td.active.disabled.focus, .datepicker table tr td.active:hover.disabled.focus, .datepicker table tr td.active.disabled.disabled.focus, .datepicker table tr td.active.disabled:hover.disabled.focus, .datepicker table tr td.active[disabled].focus, .datepicker table tr td.active:hover[disabled].focus, .datepicker table tr td.active.disabled[disabled].focus, .datepicker table tr td.active.disabled:hover[disabled].focus, fieldset[disabled] .datepicker table tr td.active.focus, fieldset[disabled] .datepicker table tr td.active:hover.focus, fieldset[disabled] .datepicker table tr td.active.disabled.focus, fieldset[disabled] .datepicker table tr td.active.disabled:hover.focus, .datepicker table tr td.active.disabled:active, .datepicker table tr td.active:hover.disabled:active, .datepicker table tr td.active.disabled.disabled:active, .datepicker table tr td.active.disabled:hover.disabled:active, .datepicker table tr td.active[disabled]:active, .datepicker table tr td.active:hover[disabled]:active, .datepicker table tr td.active.disabled[disabled]:active, .datepicker table tr td.active.disabled:hover[disabled]:active, fieldset[disabled] .datepicker table tr td.active:active, fieldset[disabled] .datepicker table tr td.active:hover:active, fieldset[disabled] .datepicker table tr td.active.disabled:active, fieldset[disabled] .datepicker table tr td.active.disabled:hover:active, .datepicker table tr td.active.disabled.active, .datepicker table tr td.active:hover.disabled.active, .datepicker table tr td.active.disabled.disabled.active, .datepicker table tr td.active.disabled:hover.disabled.active, .datepicker table tr td.active[disabled].active, .datepicker table tr td.active:hover[disabled].active, .datepicker table tr td.active.disabled[disabled].active, .datepicker table tr td.active.disabled:hover[disabled].active, fieldset[disabled] .datepicker table tr td.active.active, fieldset[disabled] .datepicker table tr td.active:hover.active, fieldset[disabled] .datepicker table tr td.active.disabled.active, fieldset[disabled] .datepicker table tr td.active.disabled:hover.active {
background-color: #<?=SCHEME_COLOR1?>;
}
.datepicker table tr td span.active, .datepicker table tr td span.active:hover, .datepicker table tr td span.active.disabled, .datepicker table tr td span.active.disabled:hover {
background-color: #<?=SCHEME_COLOR1?>;
}
.datepicker table tr td span.active:hover, .datepicker table tr td span.active:hover:hover, .datepicker table tr td span.active.disabled:hover, .datepicker table tr td span.active.disabled:hover:hover, .datepicker table tr td span.active:focus, .datepicker table tr td span.active:hover:focus, .datepicker table tr td span.active.disabled:focus, .datepicker table tr td span.active.disabled:hover:focus, .datepicker table tr td span.active.focus, .datepicker table tr td span.active:hover.focus, .datepicker table tr td span.active.disabled.focus, .datepicker table tr td span.active.disabled:hover.focus, .datepicker table tr td span.active:active, .datepicker table tr td span.active:hover:active, .datepicker table tr td span.active.disabled:active, .datepicker table tr td span.active.disabled:hover:active, .datepicker table tr td span.active.active, .datepicker table tr td span.active:hover.active, .datepicker table tr td span.active.disabled.active, .datepicker table tr td span.active.disabled:hover.active, .open > .dropdown-toggle.datepicker table tr td span.active, .open > .dropdown-toggle.datepicker table tr td span.active:hover, .open > .dropdown-toggle.datepicker table tr td span.active.disabled, .open > .dropdown-toggle.datepicker table tr td span.active.disabled:hover {
background-color: #<?=SCHEME_COLOR1?>;
}
.datepicker table tr td span.active.disabled, .datepicker table tr td span.active:hover.disabled, .datepicker table tr td span.active.disabled.disabled, .datepicker table tr td span.active.disabled:hover.disabled, .datepicker table tr td span.active[disabled], .datepicker table tr td span.active:hover[disabled], .datepicker table tr td span.active.disabled[disabled], .datepicker table tr td span.active.disabled:hover[disabled], fieldset[disabled] .datepicker table tr td span.active, fieldset[disabled] .datepicker table tr td span.active:hover, fieldset[disabled] .datepicker table tr td span.active.disabled, fieldset[disabled] .datepicker table tr td span.active.disabled:hover, .datepicker table tr td span.active.disabled:hover, .datepicker table tr td span.active:hover.disabled:hover, .datepicker table tr td span.active.disabled.disabled:hover, .datepicker table tr td span.active.disabled:hover.disabled:hover, .datepicker table tr td span.active[disabled]:hover, .datepicker table tr td span.active:hover[disabled]:hover, .datepicker table tr td span.active.disabled[disabled]:hover, .datepicker table tr td span.active.disabled:hover[disabled]:hover, fieldset[disabled] .datepicker table tr td span.active:hover, fieldset[disabled] .datepicker table tr td span.active:hover:hover, fieldset[disabled] .datepicker table tr td span.active.disabled:hover, fieldset[disabled] .datepicker table tr td span.active.disabled:hover:hover, .datepicker table tr td span.active.disabled:focus, .datepicker table tr td span.active:hover.disabled:focus, .datepicker table tr td span.active.disabled.disabled:focus, .datepicker table tr td span.active.disabled:hover.disabled:focus, .datepicker table tr td span.active[disabled]:focus, .datepicker table tr td span.active:hover[disabled]:focus, .datepicker table tr td span.active.disabled[disabled]:focus, .datepicker table tr td span.active.disabled:hover[disabled]:focus, fieldset[disabled] .datepicker table tr td span.active:focus, fieldset[disabled] .datepicker table tr td span.active:hover:focus, fieldset[disabled] .datepicker table tr td span.active.disabled:focus, fieldset[disabled] .datepicker table tr td span.active.disabled:hover:focus, .datepicker table tr td span.active.disabled.focus, .datepicker table tr td span.active:hover.disabled.focus, .datepicker table tr td span.active.disabled.disabled.focus, .datepicker table tr td span.active.disabled:hover.disabled.focus, .datepicker table tr td span.active[disabled].focus, .datepicker table tr td span.active:hover[disabled].focus, .datepicker table tr td span.active.disabled[disabled].focus, .datepicker table tr td span.active.disabled:hover[disabled].focus, fieldset[disabled] .datepicker table tr td span.active.focus, fieldset[disabled] .datepicker table tr td span.active:hover.focus, fieldset[disabled] .datepicker table tr td span.active.disabled.focus, fieldset[disabled] .datepicker table tr td span.active.disabled:hover.focus, .datepicker table tr td span.active.disabled:active, .datepicker table tr td span.active:hover.disabled:active, .datepicker table tr td span.active.disabled.disabled:active, .datepicker table tr td span.active.disabled:hover.disabled:active, .datepicker table tr td span.active[disabled]:active, .datepicker table tr td span.active:hover[disabled]:active, .datepicker table tr td span.active.disabled[disabled]:active, .datepicker table tr td span.active.disabled:hover[disabled]:active, fieldset[disabled] .datepicker table tr td span.active:active, fieldset[disabled] .datepicker table tr td span.active:hover:active, fieldset[disabled] .datepicker table tr td span.active.disabled:active, fieldset[disabled] .datepicker table tr td span.active.disabled:hover:active, .datepicker table tr td span.active.disabled.active, .datepicker table tr td span.active:hover.disabled.active, .datepicker table tr td span.active.disabled.disabled.active, .datepicker table tr td span.active.disabled:hover.disabled.active, .datepicker table tr td span.active[disabled].active, .datepicker table tr td span.active:hover[disabled].active, .datepicker table tr td span.active.disabled[disabled].active, .datepicker table tr td span.active.disabled:hover[disabled].active, fieldset[disabled] .datepicker table tr td span.active.active, fieldset[disabled] .datepicker table tr td span.active:hover.active, fieldset[disabled] .datepicker table tr td span.active.disabled.active, fieldset[disabled] .datepicker table tr td span.active.disabled:hover.active {
background-color: #<?=SCHEME_COLOR1?>;
}
.modal-header {
background-color: #<?=SCHEME_COLOR1?>;
}
.carousel-indicators.carousel-name-indicators .active {
background-color: #<?=SCHEME_COLOR1?>;
}
.multiple-categories {
	background-color: transparent;
	border-color: #ddd;
}
.ionicons.ion-ios7-minus-outline:before, .icon-edit38.ion-ios7-minus-outline:before, .icon-ion-ios7-trash-outline.ion-ios7-minus-outline:before, .icon-ion-ios7-close-empty.ion-ios7-minus-outline:before, .ionicons.ion-ios7-plus-outline:before, .icon-edit38.ion-ios7-plus-outline:before, .icon-ion-ios7-trash-outline.ion-ios7-plus-outline:before, .icon-ion-ios7-close-empty.ion-ios7-plus-outline:before {
	color:#<?=SCHEME_COLOR1?>;
}

.help-block {
	color: #<?=SCHEME_COLOR1?>;
}
.form-control[disabled], select.select[disabled], .simple-select > select[disabled], .form-control[readonly], select.select[readonly], .simple-select > select[readonly], fieldset[disabled] .form-control, fieldset[disabled] select.select, fieldset[disabled] .simple-select > select {
	background-color: #eee;
}
.webitem.active, .webitem.active:hover {
	border-color:#<?=SCHEME_COLOR1?>;
}
.webitem .action {
	color: #<?=SCHEME_COLOR1?>;
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
.results-page.results-page-grid .summary-box > .summary-content .contact-info mark a {
    color: #<?=SCHEME_COLOR2?>;
}