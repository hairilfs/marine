<?php

use App\Model\Status_Notification;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	if(!Auth::check()){
		return Redirect::to('auth/login');            
	} else {
		$this->data['data_notif'] = Status_Notification::where('id_user', Auth::user()->id_role)
														->where('last_read_date', null)
														->get();
		// return view('app');
		return \View::make('app')->with('data_notif',$this->data['data_notif']);
	}

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/login','Auth\AuthController@getLogin');

// Route::post('auth/login','Auth\AuthController@login');
// Route::post('auth/dologin','Auth\AuthController@do_login');
// Route::post('auth/logout','Auth\AuthController@getLogout');


Route::get('doc_type','Doc_TypeController@index');
Route::get('doc_type/add','Doc_TypeController@add');
Route::post('doc_type/save','Doc_TypeController@save');
Route::get('doc_type/edit/{id}','Doc_TypeController@edit');
Route::post('doc_type/update','Doc_TypeController@update');
Route::get('doc_type/delete/{id}','Doc_TypeController@delete');
Route::get('doc_type/detail/{id}','Doc_TypeController@detail');
Route::post('faculty/search','Doc_TypeController@search');

Route::get('faculty','FacultyController@index'); 
Route::get('faculty/add','FacultyController@add');
Route::post('faculty/save','FacultyController@save');
Route::get('faculty/edit/{id}','FacultyController@edit');
Route::post('faculty/update','FacultyController@update');
Route::get('faculty/delete/{id}','FacultyController@delete');
Route::get('faculty/detail/{id}','FacultyController@detail');
Route::post('faculty/search','FacultyController@search');

Route::get('major','MajorController@index');
Route::get('major/add','MajorController@add');
Route::post('major/save','MajorController@save');
Route::get('major/edit/{id}','MajorController@edit');
Route::post('major/update','MajorController@update');
Route::get('major/delete/{id}','MajorController@delete');
Route::get('major/detail/{id}','MajorController@detail');
Route::post('major/search','MajorController@search');

Route::get('university','UniversityController@index');
Route::get('university/add','UniversityController@add');
Route::post('university/save','UniversityController@save');
Route::get('university/edit/{id}','UniversityController@edit');
Route::post('university/update','UniversityController@update');
Route::get('university/delete/{id}','UniversityController@delete');
Route::get('university/detail/{id}','UniversityController@detail');
Route::post('university/search','UniversityController@search');

Route::get('training_type','Training_TypeController@index');
Route::get('training_type/add','Training_TypeController@add');
Route::post('training_type/save','Training_TypeController@save');
Route::get('training_type/edit/{id}','Training_TypeController@edit');
Route::post('training_type/update','Training_TypeController@update');
Route::get('training_type/delete/{id}','Training_TypeController@delete');
Route::get('training_type/detail/{id}','Training_TypeController@detail');
Route::post('training_type/search','Training_TypeController@search');

Route::get('emp_grade','Emp_GradeController@index');
Route::get('emp_grade/add','Emp_GradeController@add');
Route::post('emp_grade/save','Emp_GradeController@save');
Route::get('emp_grade/edit/{id}','Emp_GradeController@edit');
Route::post('emp_grade/update','Emp_GradeController@update');
Route::get('emp_grade/delete/{id}','Emp_GradeController@delete');
Route::get('emp_grade/detail/{id}','Emp_GradeController@detail');
Route::post('emp_grade/search','Emp_GradeController@search');


Route::get('emp_functional_position/add/{id?}', function(){
	return 'WEEEEEWWW';
});

Route::get('harbour_head','Harbour_HeadController@index');
Route::get('harbour_head/add','Harbour_HeadController@add');
Route::post('harbour_head/save','Harbour_HeadController@save');
Route::get('harbour_head/edit/{id}','Harbour_HeadController@edit');
Route::post('harbour_head/update','Harbour_HeadController@update');
Route::get('harbour_head/delete/{id}','Harbour_HeadController@delete');
Route::get('harbour_head/detail/{id}','Harbour_HeadController@detail');
Route::post('harbour_head/search','Harbour_HeadController@search');

Route::get('harbour_area','Harbour_AreaController@index');
Route::get('harbour_area/add','Harbour_AreaController@add');
Route::post('harbour_area/save','Harbour_AreaController@save');
Route::get('harbour_area/edit/{id}','Harbour_AreaController@edit');
Route::post('harbour_area/update','Harbour_AreaController@update');
Route::get('harbour_area/delete/{id}','Harbour_AreaController@delete');
Route::get('harbour_area/detail/{id}','Harbour_AreaController@detail');
Route::post('harbour_area/search','Harbour_AreaController@search');

Route::get('harbour_master','Harbour_MasterController@index');
Route::get('harbour_master/add','Harbour_MasterController@add');
Route::post('harbour_master/save','Harbour_MasterController@save');
Route::get('harbour_master/edit/{id}','Harbour_MasterController@edit');
Route::post('harbour_master/update','Harbour_MasterController@update');
Route::get('harbour_master/delete/{id}','Harbour_MasterController@delete');
Route::get('harbour_master/detail/{id}','Harbour_MasterController@detail');
Route::post('harbour_master/search','Harbour_MasterController@search');

Route::get('harbour_grade','Harbour_GradeController@index');
Route::get('harbour_grade/add','Harbour_GradeController@add');
Route::post('harbour_grade/save','Harbour_GradeController@save');
Route::get('harbour_grade/edit/{id}','Harbour_GradeController@edit');
Route::post('harbour_grade/update','Harbour_GradeController@update');
Route::get('harbour_grade/delete/{id}','Harbour_GradeController@delete');
Route::get('harbour_grade/detail/{id}','Harbour_GradeController@detail');
Route::post('harbour_grade/search','Harbour_GradeController@search');

Route::get('shipping_company','Shipping_CompanyController@index');
Route::get('shipping_company/add','Shipping_CompanyController@add');
Route::post('shipping_company/save','Shipping_CompanyController@save');
Route::get('shipping_company/edit/{id}','Shipping_CompanyController@edit');
Route::post('shipping_company/update','Shipping_CompanyController@update');
Route::get('shipping_company/delete/{id}','Shipping_CompanyController@delete');
Route::get('shipping_company/detail/{id}','Shipping_CompanyController@detail');
Route::post('shipping_company/search','Shipping_CompanyController@search');

Route::get('vessel','VesselController@index');
Route::get('vessel/add','VesselController@add');
Route::post('vessel/save','VesselController@save');
Route::get('vessel/edit/{id}','VesselController@edit');
Route::post('vessel/update','VesselController@update');
Route::get('vessel/delete/{id}','VesselController@delete');
Route::get('vessel/detail/{id}','VesselController@detail');
Route::post('vessel/search','VesselController@search');

Route::get('shipping_task','Shipping_TaskController@index');
Route::get('shipping_task/add','Shipping_TaskController@add');
Route::post('shipping_task/save','Shipping_TaskController@save');
Route::get('shipping_task/edit/{id}','Shipping_TaskController@edit');
Route::post('shipping_task/update','Shipping_TaskController@update');
Route::get('shipping_task/delete/{id}','Shipping_TaskController@delete');
Route::get('shipping_task/detail/{id}','Shipping_TaskController@detail');
Route::get('shipping_task/download/{id}','Shipping_TaskController@download');
Route::post('shipping_task/search','Shipping_TaskController@search');

Route::get('certificate_task_shipping','Certificate_Task_ShippingController@index');
Route::get('certificate_task_shipping/add','Certificate_Task_ShippingController@add');
Route::post('certificate_task_shipping/save','Certificate_Task_ShippingController@save');
Route::get('certificate_task_shipping/edit/{id}','Certificate_Task_ShippingController@edit');
Route::post('certificate_task_shipping/update','Certificate_Task_ShippingController@update');
Route::get('certificate_task_shipping/delete/{id}','Certificate_Task_ShippingController@delete');
Route::get('certificate_task_shipping/detail/{id}','Certificate_Task_ShippingController@detail');
Route::post('certificate_task_shipping/search','Certificate_Task_ShippingController@search');

Route::get('functional_title','Functional_TitleController@index');
Route::get('functional_title/add','Functional_TitleController@add');
Route::post('functional_title/save','Functional_TitleController@save');
Route::get('functional_title/edit/{id}','Functional_TitleController@edit');
Route::post('functional_title/update','Functional_TitleController@update');
Route::get('functional_title/delete/{id}','Functional_TitleController@delete');
Route::get('functional_title/detail/{id}','Functional_TitleController@detail');
Route::post('functional_title/search','Functional_TitleController@search');

Route::get('structural_title','Structural_TitleController@index');
Route::get('structural_title/add','Structural_TitleController@add');
Route::post('structural_title/save','Structural_TitleController@save');
Route::get('structural_title/edit/{id}','Structural_TitleController@edit');
Route::post('structural_title/update','Structural_TitleController@update');
Route::get('structural_title/delete/{id}','Structural_TitleController@delete');
Route::get('structural_title/detail/{id}','Structural_TitleController@detail');
Route::post('structural_title/search','Structural_TitleController@search');

Route::get('employee_profile','Employee_ProfileController@index');
Route::get('employee_profile/demo','Employee_ProfileController@demo');
Route::get('employee_profile/get_emp_profile','Employee_ProfileController@get_emp_profile');
Route::get('employee_profile/filter_by_training_type/{id}','Employee_ProfileController@filter_by_training_type');
Route::get('employee_profile/filter_by_graduate_date/{year?}','Employee_ProfileController@filter_by_graduate_date');
Route::get('employee_profile/filter_by_mi_date/{year?}','Employee_ProfileController@filter_by_mi_date');
Route::get('employee_profile/filter_by_harbour/{harbour_master_id?}','Employee_ProfileController@filter_by_harbour');
Route::get('employee_profile/filter_by_education/{sex?}/{id_university?}/{id_faculty?}/{id_major?}/{id_education_level?}','Employee_ProfileController@filter_by_education');
Route::get('employee_profile/list_only','Employee_ProfileController@list_only');
Route::get('employee_profile/filter_column','Employee_ProfileController@filter_column');
Route::get('employee_profile/add','Employee_ProfileController@add');
Route::post('employee_profile/save','Employee_ProfileController@save');
Route::get('employee_profile/edit/{id}','Employee_ProfileController@edit');
Route::get('employee_profile/print_drh/{id}','Employee_ProfileController@print_drh');
Route::get('employee_profile/print_profile_drh','Employee_ProfileController@print_profile_drh');
Route::get('employee_profile/delete/{id}','Employee_ProfileController@delete');
Route::get('employee_profile/detail/{id}','Employee_ProfileController@detail');
Route::get('employee_profile/get_photo/{id?}','Employee_ProfileController@get_photo');
Route::get('employee_profile/get_icon_photo/{id?}','Employee_ProfileController@get_icon_photo');
Route::post('employee_profile/search','Employee_ProfileController@search');
Route::post('employee_profile/update','Employee_ProfileController@update');
Route::post('employee_profile/save_appearance','Employee_ProfileController@save_appearance');
Route::post('employee_profile/save_profile_appearance','Employee_ProfileController@save_profile_appearance');
Route::get('employee_profile/edit_profile','Employee_ProfileController@edit_profile');
Route::post('employee_profile/save_profile','Employee_ProfileController@save_profile');
Route::get('employee_profile/list_employee_by_harbour_id/{id_harbour?}','Employee_ProfileController@list_employee_by_harbour_id');

// Route::get('emp_training','Emp_TrainingController@index');
Route::get('emp_training/add/{employee_profile_id?}','Emp_TrainingController@add');
Route::post('emp_training/save','Emp_TrainingController@save');
Route::get('emp_training/edit/{id}/{employee_profile_id?}','Emp_TrainingController@edit');
Route::post('emp_training/update','Emp_TrainingController@update');
Route::get('emp_training/delete/{id}/{employee_profile_id?}','Emp_TrainingController@delete');
Route::get('emp_training/detail/{id}/{employee_profile_id?}','Emp_TrainingController@detail');
Route::get('emp_training/download/{id}/{type}','Emp_TrainingController@download');
// Route::post('emp_training/search','Emp_TrainingController@search');

// Route::get('emp_education','Emp_EducationController@index');
Route::get('emp_education/add/{employee_profile_id?}','Emp_EducationController@add');
Route::post('emp_education/save','Emp_EducationController@save');
Route::get('emp_education/edit/{id}/{employee_profile_id?}','Emp_EducationController@edit');
Route::post('emp_education/update','Emp_EducationController@update');
Route::get('emp_education/delete/{id}/{employee_profile_id?}','Emp_EducationController@delete');
Route::get('emp_education/detail/{id}/{employee_profile_id?}','Emp_EducationController@detail');
Route::get('emp_education/download/{id}/{type}','Emp_EducationController@download');
// Route::post('emp_education/search','Emp_EducationController@search');

// Route::get('emp_basic_education','Emp_Basic_EducationController@index');
Route::get('emp_basic_education/add/{employee_profile_id?}','Emp_Basic_EducationController@add');
Route::post('emp_basic_education/save','Emp_Basic_EducationController@save');
Route::get('emp_basic_education/edit/{id}/{employee_profile_id?}','Emp_Basic_EducationController@edit');
Route::post('emp_basic_education/update','Emp_Basic_EducationController@update');
Route::get('emp_basic_education/delete/{id}/{employee_profile_id?}','Emp_Basic_EducationController@delete');
Route::get('emp_basic_education/detail/{id}/{employee_profile_id?}','Emp_Basic_EducationController@detail');
Route::get('emp_basic_education/download/{id}/{type}','Emp_Basic_EducationController@download');
// Route::post('emp_basic_education/search','Emp_Basic_EducationController@search');

// Route::get('emp_experience','Emp_ExperienceController@index');
Route::get('emp_experience/add/{employee_profile_id?}','Emp_ExperienceController@add');
Route::post('emp_experience/save','Emp_ExperienceController@save');
Route::get('emp_experience/edit/{id}/{employee_profile_id?}','Emp_ExperienceController@edit');
Route::post('emp_experience/update','Emp_ExperienceController@update');
Route::get('emp_experience/delete/{id}/{employee_profile_id?}','Emp_ExperienceController@delete');
Route::get('emp_experience/detail/{id}/{employee_profile_id?}','Emp_ExperienceController@detail');
Route::get('emp_experience/download/{id}/{type}','Emp_ExperienceController@download');
// Route::post('emp_experience/search','Emp_ExperienceController@search');

// Route::get('emp_addresses','Emp_AddressesController@index');
Route::get('emp_addresses/add/{employee_profile_id?}','Emp_AddressesController@add');
Route::post('emp_addresses/save','Emp_AddressesController@save');
Route::get('emp_addresses/edit/{id}/{employee_profile_id?}','Emp_AddressesController@edit');
Route::post('emp_addresses/update','Emp_AddressesController@update');
Route::get('emp_addresses/delete/{id}/{employee_profile_id?}','Emp_AddressesController@delete');
Route::get('emp_addresses/detail/{id}/{employee_profile_id?}','Emp_AddressesController@detail');
Route::get('emp_addresses/download/{id}/{type}','Emp_AddressesController@download');
// Route::post('emp_addresses/search','Emp_AddressesController@search');

// Route::get('emp_profile_training','Emp_Profile_TrainingController@index');
Route::get('emp_profile_training/add/{employee_profile_id?}','Emp_Profile_TrainingController@add');
Route::post('emp_profile_training/save','Emp_Profile_TrainingController@save');
Route::get('emp_profile_training/edit/{id}/{employee_profile_id?}','Emp_Profile_TrainingController@edit');
Route::post('emp_profile_training/update','Emp_Profile_TrainingController@update');
Route::get('emp_profile_training/delete/{id}/{employee_profile_id?}','Emp_Profile_TrainingController@delete');
Route::get('emp_profile_training/detail/{id}/{employee_profile_id?}','Emp_Profile_TrainingController@detail');
Route::get('emp_profile_training/download/{id}/{type}','Emp_Profile_TrainingController@download');
// Route::post('emp_profile_training/search','Emp_Profile_TrainingController@search');

// Route::get('emp_profile_education','Emp_Profile_EducationController@index');
Route::get('emp_profile_education/add/{employee_profile_id?}','Emp_Profile_EducationController@add');
Route::post('emp_profile_education/save','Emp_Profile_EducationController@save');
Route::get('emp_profile_education/edit/{id}/{employee_profile_id?}','Emp_Profile_EducationController@edit');
Route::post('emp_profile_education/update','Emp_Profile_EducationController@update');
Route::get('emp_profile_education/delete/{id}/{employee_profile_id?}','Emp_Profile_EducationController@delete');
Route::get('emp_profile_education/detail/{id}/{employee_profile_id?}','Emp_Profile_EducationController@detail');
Route::get('emp_profile_education/download/{id}/{type}','Emp_Profile_EducationController@download');
// Route::post('emp_profile_education/search','Emp_Profile_EducationController@search');

// Route::get('emp_profile_basic_education','Emp_Profile_Basic_EducationController@index');
Route::get('emp_profile_basic_education/add/{employee_profile_id?}','Emp_Profile_Basic_EducationController@add');
Route::post('emp_profile_basic_education/save','Emp_Profile_Basic_EducationController@save');
Route::get('emp_profile_basic_education/edit/{id}/{employee_profile_id?}','Emp_Profile_Basic_EducationController@edit');
Route::post('emp_profile_basic_education/update','Emp_Profile_Basic_EducationController@update');
Route::get('emp_profile_basic_education/delete/{id}/{employee_profile_id?}','Emp_Profile_Basic_EducationController@delete');
Route::get('emp_profile_basic_education/detail/{id}/{employee_profile_id?}','Emp_Profile_Basic_EducationController@detail');
Route::get('emp_profile_basic_education/download/{id}/{type}','Emp_Profile_Basic_EducationController@download');
// Route::post('emp_profile_basic_education/search','Emp_Profile_Basic_EducationController@search');

// Route::get('emp_profile_addresses','Emp_Profile_AddressesController@index');
Route::get('emp_profile_addresses/add/{employee_profile_id?}','Emp_Profile_AddressesController@add');
Route::post('emp_profile_addresses/save','Emp_Profile_AddressesController@save');
Route::get('emp_profile_addresses/edit/{id}/{employee_profile_id?}','Emp_Profile_AddressesController@edit');
Route::post('emp_profile_addresses/update','Emp_Profile_AddressesController@update');
Route::get('emp_profile_addresses/delete/{id}/{employee_profile_id?}','Emp_Profile_AddressesController@delete');
Route::get('emp_profile_addresses/detail/{id}/{employee_profile_id?}','Emp_Profile_AddressesController@detail');
Route::get('emp_profile_addresses/download/{id}/{type}','Emp_Profile_AddressesController@download');
// Route::post('emp_profile_addresses/search','Emp_Profile_AddressesController@search');

// Route::get('emp_profile_experience','Emp_Profile_ExperienceController@index');
Route::get('emp_profile_experience/add/{employee_profile_id?}','Emp_Profile_ExperienceController@add');
Route::post('emp_profile_experience/save','Emp_Profile_ExperienceController@save');
Route::get('emp_profile_experience/edit/{id}/{employee_profile_id?}','Emp_Profile_ExperienceController@edit');
Route::post('emp_profile_experience/update','Emp_Profile_ExperienceController@update');
Route::get('emp_profile_experience/delete/{id}/{employee_profile_id?}','Emp_Profile_ExperienceController@delete');
Route::get('emp_profile_experience/detail/{id}/{employee_profile_id?}','Emp_Profile_ExperienceController@detail');
Route::get('emp_profile_experience/download/{id}/{type}','Emp_Profile_ExperienceController@download');
// Route::post('emp_profile_experience/search','Emp_Profile_ExperienceController@search');

Route::get('map','MapController@index');
Route::get('map/map_user','MapController@map_user');
Route::get('map/manage','MapController@manage');
Route::get('map/list_marker','MapController@list_marker');
Route::post('map/save_location','MapController@save_location');

Route::get('document_explorer/browse_only/{dir_id?}', array('uses' => 'Document_ExplorerController@Browse_Only', 'as' => 'browse_document'));
Route::get('document_explorer/{dir_id?}', array('uses' => 'Document_ExplorerController@index', 'as' => 'document_explorer'));
// Route::get('document_explorer/view/{dir_id?}', array('uses' => 'Document_ExplorerController@view', 'as' => 'document_explorer'));
// Route::get('document_explorer/{dir_id?}','Document_ExplorerController@index');
Route::get('document_explorer/add','Document_ExplorerController@add');
Route::post('document_explorer/save','Document_ExplorerController@save');
Route::post('document_explorer/upload_document','Document_ExplorerController@upload_document');
// Route::get('document_explorer/edit/{id}','Document_ExplorerController@edit');
// Route::post('document_explorer/update','Document_ExplorerController@update');
Route::get('document_explorer/delete/{id}','Document_ExplorerController@delete');
Route::get('document_explorer/download/{id}','Document_ExplorerController@download');
Route::post('document_explorer/search','Document_ExplorerController@search');
Route::post('document_explorer/create_folder','Document_ExplorerController@create_folder');
Route::post('document_explorer/rename_folder','Document_ExplorerController@rename_folder');
Route::get('document_explorer/remove_folder/{dir_id}','Document_ExplorerController@remove_folder');
Route::get('document_explorer/get/tree/{target_id?}','Document_ExplorerController@get_tree_dir');

Route::get('user','UserController@index');
Route::get('user/add','UserController@add');
Route::post('user/save','UserController@save');
Route::get('user/edit/{id?}','UserController@edit');
Route::post('user/update','UserController@update');
Route::get('user/delete/{id?}','UserController@delete');
Route::get('user/reset_password/{user_id?}','UserController@reset_password');
Route::post('user/save_password','UserController@save_password');


Route::get('email','EmailController@index');
Route::post('email/send_email_all','emailController@send_email_all');
Route::get('email/view','emailController@view');
Route::get('email/success','emailController@success');

Route::get('messages','MessagesController@index');
Route::get('messages/user','MessagesController@user');
Route::get('messages/create','MessagesController@create');
Route::post('messages/store','MessagesController@store');
Route::get('messages/{id?}', array('uses' => 'MessagesController@show', 'as' => 'messages.show'));
Route::put('messages/{id?}', array('uses' => 'MessagesController@update', 'as' => 'messages.update'));
Route::get('messages/delete/{id?}','MessagesController@delete');

Route::get('notification','BaseController@list_notification')->name('notification_list');
Route::get('notification/add','BaseController@add_notification')->name('notification_new');
Route::post('notification/store','BaseController@insert_notification');
Route::get('notification/edit/{id?}','BaseController@edit_notification')->name('edit_notification');
Route::post('notification/update','BaseController@store_edit_notification')->name('store_edit_notification');
Route::get('notification/delete/{id?}','BaseController@delete_notif');
Route::post('notification/get/{id?}','BaseController@get_notif')->name('get_notif');
Route::post('notification/nav_notif/{id?}','BaseController@nav_notif');

// Route::group(['prefix' => 'messages'], function () {
//     Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
//     Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
//     Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
//     Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
//     Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
// });



Route::filter('csrf', function() {
    $token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
    if (Session::token() != $token)
        throw new Illuminate\Session\TokenMismatchException;
});
