<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| ----------------------------------------------------------------	---------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['index']='home/index';
$route['services']='home/services';
$route['services/(:num)']='home/services/$1';
$route['service-category/(:num)']='home/services_category/$1';
$route['service-category/(:num)/(:num)']='home/services_category/$1/$1';
$route['serviceprovider-details/(:num)']='home/serviceprovider_details/$1';
$route['about']='home/about';
$route['login']='home/login';
$route['forgot-password'] = 'home/forgotpassword';
$route['changepassword'] = 'home/changepassword';
$route['register']='home/register';
$route['admin'] = 'admin/index';
$route['logout-admin'] = 'admin/logout';
$route['dashboard'] = 'admin/dashboard';
$route['customer-enquiries']='admin/enquiries';
$route['categories'] = 'category/index';
$route['service-providers']='admin/serviceproviders';
$route['view-services/(:num)']='admin/user_services/$1';
$route['tags'] = 'tag/index';
// $route['jobs'] = 'jobs/index';
// $route['add-job'] = 'jobs/postjob';
$route['invite-service-provider/(:num)']='admin/invitesrs/$1';
$route['view-job-notification/(:num)']='admin/jobnotification/$1';
$route['work-room/(:any)'] = 'admin/workroom/$1';
// $route['view-refno/(:num)'] = 'jobs/viewjobrefno/$1';
$route['site-setting'] = 'settings/index';
$route['banner-image'] = 'settings/bannerimage';
$route['admin-profile'] = 'settings/updateprofile';

$route['post-ads']='customer/postjob';
$route['new-post']='admin/newarticle';
$route['view-post']='admin/viewarticles';
$route['edit-post/(:num)'] = 'admin/editarticle/$1';
$route['view-comments/(:num)']='admin/view_comments/$1';

$route['view-testimonial']='admin/viewfeedback';

$route['customer-inquiries']='admin/mailinquiries';
$route['service-inquiries']='admin/srmailinquiries';



// user
$route['verify'] = 'user/verify';
$route['user'] = 'user/login';
$route['user-dashboard']='user/dashboard';
$route['user-logout'] = 'home/logout';

$route['user-dashboard'] = 'user/dashboard';
$route['user-profile'] = 'user/user_profile';
$route['my-services/(:num)'] = 'user/user_services/$1';
$route['delete-my-services/(:num)'] = 'user/delete_myservice/$1';
$route['my-services'] = 'user/user_services';
$route['add-service'] = 'user/add_service';
$route['edit-my-service/(:num)'] = 'user/edit_service/$1';
$route['download/(:any)'] = "/home/download_servicepdf/$1";
$route['my-ads/(:num)'] = 'customer/user_ads/$1';
$route['my-ads'] = 'customer/user_ads';
$route['ad-details/(:num)'] = 'customer/ad_details/$1';
$route['serviceprovider-profile/(:num)']='user/serviceprovider_profile/$1';
$route['view-job-proposals/(:num)']='customer/job_proposals/$1';
$route['view-job-proposals/(:num)/(:num)']='customer/job_proposals/$1/$1';
$route['my-job-invitation']='user/job_notification';
$route['my-job-invitation/(:num)']='user/job_notification/$1';
$route['chat-room/(:any)'] = 'user/workroom/$1';
$route['post-details/(:num)'] = 'blog/postdetails/$1';
$route['blog/(:num)'] = 'blog/blog_post_list/$1';
$route['blog'] = 'blog/blog_post_list';
$route['search'] = 'services/search';
$route['search-services'] = 'services/search1';
$route['contact'] = 'home/contact';
$route['getquote'] = 'home/getquote';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;