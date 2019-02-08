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

///////////// guests routes
Route::get('/', 'UserController@index')->name('home');
Route::view('test', 'video-call2');
Route::post('/user-registration', 'UserController@registration');
Route::post('/user-login', 'UserController@login');
Route::post('/password-update', 'UserController@passwordUpdate')->middleware('auth');
Route::get('/all-subjects', 'UserController@allSubjects');
Route::any('tutors/{query?}', 'UserController@allTutors');
Route::any('filter/tutors', 'UserController@filterTutors');
Route::get('about-us', 'UserController@aboutUs');
Route::post('support-message', 'UserController@supportMessage');
Route::post('user-feedback', 'HomeController@userFeedback');
Route::get('tutor/profile/{id}', 'UserController@tutorProfile');
Route::get('search-course/{query}', 'UserController@searchCourse');
//////////// end guests routes
// auth requests
Route::get('hire-request/{id}', 'HomeController@hireRequest');
Route::get('hire/{id}', 'HomeController@hire');
Route::post('hire-request-store/{id}', 'HomeController@requestStore');
Route::get('get-messages/{id}', 'HomeController@getMessages');
Route::get('store-message/{id}/{msg}', 'HomeController@storeMessage');
Route::get('new/conversation/{msg}/{id}', 'HomeController@newConversationMessage');
Route::get('video-call-initiate/{id}', 'HomeController@videoCall');
Route::get('video-local-page/{id}', 'HomeController@videoLocalPage')->name('video-local-page');
Route::get('video-remote-page/{id}', 'HomeController@videoRemotePage');


////////////////////////    tutor routes ////////////////////////////////////////
Route::group(['prefix' => 'tutor', 'middleware' => ['IsTutor']], function () {

    Route::get('/', 'TutorController@index');
    Route::get('/logout', 'TutorController@logout');
    Route::post('/profile-info-update', 'TutorController@profileUpdate');
    Route::post('/profile-contact-info-update', 'TutorController@profileContactUpdate');
    Route::get('/password', 'TutorController@viewPassword');
    Route::get('/skills', 'TutorController@viewSkills');
    Route::post('/add-subCourses/{course_id}', 'TutorController@storeSkills');
    Route::get('/requests', 'TutorController@viewRequests');
    Route::get('/request/approve/{id}/{status}', 'TutorController@approveRequest');
    Route::get('/request/delete/{id}', 'TutorController@deleteRequest');
    Route::get('/students', 'TutorController@viewStudents');
    Route::post('/student-report-store', 'TutorController@storeReportStudent');
    Route::get('/reports', 'TutorController@viewReport');
    Route::get('/inbox', 'TutorController@viewInbox');
    Route::get('/payments', 'TutorController@viewPayments');
});
////////////////////////   end tutor routes  /////////////////////////////////////

////////////////////////    student routes ////////////////////////////////////////
Route::group(['prefix' => 'student', 'middleware' => ['IsStudent']], function () {

    Route::get('/', 'StudentController@index');
    Route::get('/logout', 'StudentController@logout');
    Route::post('/profile-info-update', 'StudentController@profileUpdate');
    Route::get('/password', 'StudentController@viewPassword');
    Route::get('/tutors', 'StudentController@viewTutor');
    Route::get('/request/delete/{id}', 'StudentController@deleteRequest');
    Route::get('/reports', 'StudentController@viewReport');
    Route::get('/payments', 'StudentController@viewPayments');
    Route::post('/payment-store', 'StudentController@storePayment');
    Route::get('/inbox', 'StudentController@viewInbox');
});
////////////////////////   end student routes  /////////////////////////////////////
///
////////////////////////    Parent routes ////////////////////////////////////////
Route::group(['prefix' => 'parent', 'middleware' => ['IsParent']], function () {

    Route::get('/', 'ParentController@index');
    Route::get('/logout', 'ParentController@logout');
    Route::post('/profile-info-update', 'ParentController@profileUpdate');
    Route::get('/password', 'ParentController@viewPassword');
    Route::get('/tutors', 'ParentController@viewTutor');
    Route::get('/request/delete/{id}', 'ParentController@deleteRequest');
    Route::get('/reports', 'ParentController@viewReport');
    Route::get('/payments', 'ParentController@viewPayments');
    Route::post('/payment-store', 'ParentController@storePayment');
    Route::get('/inbox', 'ParentController@viewInbox');
    Route::get('/children', 'ParentController@viewChildren');
    Route::post('/children-store/{id?}', 'ParentController@storeChildren');

});
////////////////////////   end student routes  /////////////////////////////////////


//////    admin routes /////////
Route::get('admin/login', 'AdminController@adminLoginView');
Route::post('admin/login/form', 'AdminController@adminLogin')->name('admin/login/form');

Route::group(['prefix' => 'admin', 'middleware' => ['IsAdmin']], function () {

    Route::get('dashboard', 'AdminController@create')->name('admin/dashboard');
    Route::get('logout', 'AdminController@logOut');
    Route::get('profile', 'AdminController@profileUpdate')->name('admin/profile');
    Route::post('password/update', 'AdminController@updatePassword');
    Route::post('profile/update', 'AdminController@profileEdit');

    // courses routes
    Route::get('courses', 'AdminController@coursesView')->name('/courses');
    Route::get('delete/course/{id}', 'AdminController@deleteCourse')->name('/courses');
    Route::post('add/courses/{id?}', 'AdminController@addCourses');

    // sub courses
    Route::get('sub-courses', 'AdminController@viewSubCourses');
    Route::post('add/sub-courses/{id?}', 'AdminController@addSubCourses');
    Route::get('delete/sub-course/{id}', 'AdminController@deleteSubCourse');
    // users manage routes
    Route::get('users', 'AdminController@viewUser');
    Route::get('delete/user/{id}', 'AdminController@deleteUser');
    Route::get('status/user/{id}', 'AdminController@statusUser');

    // tutot account reques
    Route::get('tutor/request', 'AdminController@viewTutorRequest');
    Route::get('tutor/account/{accept}/{id}', 'AdminController@tutorRequestAccount');


    // complaint delete
    Route::get('support-delete/{id}', 'AdminController@complainDelete');

    // feeddback routes
    Route::get('feedback', 'AdminController@feedbackView');
    Route::get('feedback-delete/{id}', 'AdminController@feedbackDelete');
});

// end admin routes /////////////

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// social login routes

// google socilalite
Route::get('login/google', 'SocialLoginController@loginGoogle');
Route::get('register/google', 'SocialLoginController@redirectToProviderGoogle');
Route::get('login/google/callback', 'SocialLoginController@handleProviderCallbackGoogle');
// twitter socilalite
Route::get('login/twitter', 'SocialLoginController@loginTwitter');
Route::get('register/twitter', 'SocialLoginController@redirectToProviderTwitter');
Route::get('login/twitter/callback', 'SocialLoginController@handleProviderCallbackTwitter');
