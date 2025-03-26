<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



///////////////Registration////////////////////////////
Route::get('hospital/register/form', function() {

//    'uses' => 'RegisterController@getregister'
return view('admindashboard.register');
});


Route::post('hospital/register/form', [

    'uses' => 'RegisterController@registerHospital'

]);

/////////////////Login////////////////////////////////


Route::get('admin/login', function(){
    return view('admindashboard.login');
});



 Route::post('admin/login', [
     'as' => 'login',
     'uses' => 'LoginController@login'
 ]);


Route::get('/logout', [
//    'as' => 'get_logout'
    'uses' => 'LoginController@getlogout'
]);


Route::post('admindashboard/hospital/{id}', [
    'uses' => 'AdminController@approveHospital'
]);

Route::post('admindashboard/hospitalreject/{id}', [
    'uses' => 'AdminController@rejectHospital'
]);


Route::get('change-password', function() {return view('admindashboard.ChangePassword'); });


//Route::get('change-password', [
////    'as' => 'get_logout'
//    'uses' => 'ChangePasswordController@getChangePassword'
//]);
Route::post('change-password', [

    'uses' => 'ChangePasswordController@ChangePassword'
]);


Route::group(['middleware' => 'auth'], function () {

/////////Super admin dashboard//////////

    Route::get('admindashboard', 'AdminController@main');

/////////add hospital////////////
    Route::get('add_hospital', [
        'as' => 'add_hospital',
        'uses' => 'AdminController@addhospital'
    ]);

    Route::post('add_hospital', [
        'as' => 'post_hospital',
        'uses' => 'AdminController@posthospital'
    ]);



/////////Edit hospital////////////
    Route::get('/edit_hospital/{id}', [
        'as' => 'edit_hospital',
        'uses' => 'AdminController@getedit'
    ]);
///////////Update Hospital //////////
    Route::post('/edit_hospital/{id}', [
        'as' => 'edit_hospital',
        'uses' => 'AdminController@postedit'
    ]);
/////////Delete Hospital///////////////
    Route::get('admindashboard/{id}', [
        'as' => 'delete_hospital',
        'uses' => 'AdminController@deletehospital'
    ]);


    Route::get('admindashboard/hospital/{id}', 'AdminController@hospitallist');

    Route::get('admindashboard/hospital/{id}/add_staff', [
        'as' => 'add_staff',
        'uses' => 'AdminController@addstaff'
    ]);

    Route::post('admindashboard/hospital/{id}/add_staff', [
        'as' => 'post_staff',
        'uses' => 'AdminController@poststaff'
    ]);
/////////////////Change Status of Approval////////////////




    ////////////////////////////////////////////////Hospital DashBoard//////////////////////////////////////////////////////////////////////

//
//
//    Route::get('admin/hospital/login', function(){
//        return view('hospitaldashboard.login');
//
//    });
//
//
//    Route::post('admin/hospital/login', [
//        'as' => 'login',
//        'uses' => 'HospitalLoginController@hospitallogin'
//    ]);
//



//Route::group(['middleware' => ['Hospital']], function () {


///////////////add staff///////////////
//    Route::get('admindashboard/hospitals/{id}', [
//        'as' => 'get_dashboard',
//        'uses' => 'AdminController@mainpanel'
//
//    ]);

//    Route::get('/admin/add_staff', [
//        'as' => 'add_staff',
//        'uses' => 'AdminController@addstaff'
//    ]);
//
//    Route::post('/admin/add_staff', [
//        'as' => 'post_staff',
//        'uses' => 'AdminController@poststaff'
//    ]);

/////////Edit staff////////////
    Route::get('/admin/edit_staff/{id}', [
        'as' => 'edit_staff',
        'uses' => 'AdminController@geteditstaff'
    ]);
///////////Update staff
    Route::post('/admin/edit_staff/{id}', [
        'as' => 'edit_staff',
        'uses' => 'AdminController@posteditstaff'
    ]);
    /////////////Delete Document///////////////////
    Route::get('/admin/edit_staff/document/{id}', [
        'as' => 'del_document',
        'uses' => 'AdminController@deletedocument'
    ]);

/////////Delete staff/////////////////////
    Route::get('/admin/HospitalDashboard/{id}', [
        'as' => 'del_staff',
        'uses' => 'AdminController@deletestaff'
    ]);
    
    


Route::get('hospital/patients_list_view', function(){
    return view('hospital_views.patients_list');
});
Route::get('hospital/patient_detail_view', function(){
    return view('hospital_views.patient_detail');
});
Route::get('hospital/patient_emergency_view', function(){
    return view('hospital_views.patient_emergency');
});
Route::get('hospital/first_responder_chat_view', function(){
    return view('hospital_views.first_responder_chat');
});
Route::get('hospital/emergency_form', function(){
    return view('hospital_views.emergency_form');
});
Route::get('hospital/dashboard_view', function(){
    return view('hospital_views.dashboard');
});
//});





});

    //Views
Route::get('hospital/login_view', function(){
    return view('hospital_views.login');
});

Route::post('login','HospitalLoginController@hospitallogin');

Route::group(['middleware' => 'Hospital'], function () {

    Route::get('hospital/dashboard', 'Hospital\HospitalController@getDashboard'); 
    Route::get('hospital/get_patients', 'Hospital\HospitalController@getPatients'); 
    Route::get('hospital/get_patient_analytics', 'Hospital\HospitalController@getIncomingPatientAnalytics');
    Route::get('hospital/get_patient/{user_id}', 'Hospital\PateintController@getPatientDetail');
    Route::post('/reminder', 'ReminderController@store');
    Route::post('/patient_detail', 'Hospital\PateintController@getPatientSummary');
    Route::post('/reminder_delete', 'ReminderController@destroy');
    Route::get('hospital/get_patient_emergency/{user_id}', 'Hospital\PateintController@getPatientEmergency');
    
    Route::get('hospital/add_walkin_patient', 'Hospital\PateintController@addWalkinPatient');

    //  Chat Section
    Route::get('hospital/messages', 'Hospital\ChatController@getChats');
    Route::get('hospital/message-detail/{id}', 'Hospital\ChatController@getChatDetails');
    Route::get('hospital/message-user-detail/{other_id}', 'Hospital\ChatController@getChatUserDetails');
    Route::post('hospital/add_message', 'Hospital\ChatController@addMessage');
//    Route::post('add-file', 'Web\ChatController@addFile');
//    Route::get('delete-chat/{id}', 'Web\ChatController@deleteChat');
    Route::get('hospital/get_url_message', 'Hospital\ChatController@returnMessage');
    
    
});

 Route::get('/logout', 'HospitalLoginController@getlogout');