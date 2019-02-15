<?php
Route::get('/', 'HomeController@index')->name('home');  
Auth::routes(); 
Route::get('/home', 'HomeController@index'); 
Route::post('/uploadpicture', 'HomeController@uploadpicture')->name('uploadpicture');  
Route::group(['prefix' => 'admin',  'namespace' => 'admin', 'middleware' => ['auth', 'admin']], function (){
	Route::get('/home', 'HomeController@index')->name('adminhome');
	//Worker Management
	Route::get('/employees', 					'WorkersController@index')->name('adminworkers');
	Route::get('/employees/create', 			'WorkersController@create')->name('adminworkerscreate');
	Route::post('/employees/create', 			'WorkersController@create'); 
	Route::get('/employees/update/{id}', 		'WorkersController@update')->name('adminworkersupdate');
	Route::post('/employees/update/{id}',   	'WorkersController@update'); 
	Route::get('/employees/delete/{id}',    	'WorkersController@delete')->name('adminworkersdelete'); 
	Route::post('/employees/detail',   			'WorkersController@detail')->name('adminemployeedetail'); 
	//Client Management
	Route::get('/clients', 						'ClientsController@index')->name('adminclients');
	Route::get('/clients/create', 				'ClientsController@create')->name('adminclientscreate');
	Route::post('/clients/create', 				'ClientsController@create'); 
	Route::get('/clients/update/{id}', 			'ClientsController@update')->name('adminclientsupdate');
	Route::post('/clients/update/{id}', 		'ClientsController@update');
	Route::get('/clients/delete/{id}', 			'ClientsController@delete')->name('adminclientsdelete');
	Route::post('/clients/backup/{id}', 		'ClientsController@backup')->name('adminclientsbackup');
	Route::post('/clients/detail',   			'ClientsController@detail')->name('adminclientdetail');  
	Route::post('/clients/uploadimage',   		'ClientsController@uploadimage')->name('adminclientuploadimage'); 
	//Task Management
	Route::get('/history', 						'TaskController@index')->name('admintasks');   
	Route::post('/taskdetail', 					'TaskController@taskdetail')->name('taskdetail');   
	//Maintenance Management
	Route::get('/maintenances', 				'MaintenanceController@index')->name('adminmaintenances');
	Route::get('/maintenances/create', 			'MaintenanceController@create')->name('adminmaintenancescreate');
	Route::post('/maintenances/create', 		'MaintenanceController@create'); 
	Route::post('/maintenances/createsign', 	'MaintenanceController@addsign')->name('adminmaintenancesaddsign'); 
	Route::get('/maintenances/update/{id}', 	'MaintenanceController@update')->name('adminmaintenancesupdate');
	Route::post('/maintenances/update/{id}', 	'MaintenanceController@update');
	Route::get('/maintenances/delete/{id}', 	'MaintenanceController@delete')->name('adminmaintenancesdelete');
	Route::post('/maintenances/detail', 		'MaintenanceController@detail')->name('adminmaintenancesetail'); 
	Route::post('/maintenances/addnewrow', 		'MaintenanceController@addnewrow')->name('adminmaintenanceaddnewrow'); 
	Route::post('/maintenances/deleterow', 		'MaintenanceController@deleterow')->name('adminmaintenancedeleterow'); 
	
	Route::get('/maintenances/table/create', 	'MaintenanceController@createtable')->name('adminmaintenancescreatetable');
	Route::post('/maintenances/table/create', 	'MaintenanceController@createtable'); 
	Route::post('/maintenances/posttable', 		'MaintenanceController@posttable')->name('adminmaintenancesposttable');
	Route::post('/maintenances/detail', 		'MaintenanceController@detail')->name('adminmaintenancesdetail');  
	//Service Management
	Route::get('/services', 					'ServiceController@index')->name('adminservices');
	Route::get('/services/create', 				'ServiceController@create')->name('adminservicescreate');
	Route::post('/services/create', 			'ServiceController@create');
	Route::get('/services/update/{id}', 		'ServiceController@update')->name('adminservicesupdate');
	Route::post('/services/update/{id}', 		'ServiceController@update');
	Route::get('/services/delete/{id}', 		'ServiceController@delete')->name('adminservicesdelete');
	Route::post('/services/detail', 			'ServiceController@detail')->name('adminservicesdetail'); 
	// History Activity
	//Route::get('history',   					'HomeController@history')->name('adminhistory');
	Route::get('/calendar', 					'HomeController@calendar')->name('followcalendar');  
	Route::get('/getnewsigns', 					'HomeController@getnewsigns')->name('getnewsigns'); 
	//Additional Job Management      
	Route::get('/additionals', 					'AdditionalController@index')->name('adminadditionals'); 
	Route::get('/additionals/delete/{id}', 		'AdditionalController@delete')->name('adminadditionalsdelete');
	Route::post('/additionals/detail', 			'AdditionalController@detail')->name('adminadditionalsdetail');  
});
 
Route::group(['prefix' => 'employee', 'namespace' => 'employee', 'middleware' => ['auth', 'worker']], function (){
	Route::get('/home',    						'MaintenanceController@index')->name('employeehome'); 
	Route::post('/taskdetail', 					'TaskController@taskdetail')->name('employeetaskdetail'); 
	//Worker Management
	Route::get('/employees', 					'WorkersController@index')->name('employeeworkers');
	Route::get('/employees/create', 			'WorkersController@create')->name('employeeworkerscreate');
	Route::post('/employees/create', 			'WorkersController@create'); 
	Route::get('/employees/update/{id}', 		'WorkersController@update')->name('employeeworkersupdate');
	Route::post('/employees/update/{id}',   	'WorkersController@update'); 
	Route::get('/employees/delete/{id}',    	'WorkersController@delete')->name('employeeworkersdelete'); 
	Route::post('/employees/detail',   			'WorkersController@detail')->name('employeeemployeedetail'); 
	//Client Management
	Route::get('/clients', 						'ClientsController@index')->name('employeeclients');
	Route::get('/clients/create', 				'ClientsController@create')->name('employeeclientscreate');
	Route::post('/clients/create', 				'ClientsController@create'); 
	Route::get('/clients/update/{id}', 			'ClientsController@update')->name('employeeclientsupdate');
	Route::post('/clients/update/{id}', 		'ClientsController@update');
	Route::get('/clients/delete/{id}', 			'ClientsController@delete')->name('employeeclientsdelete');
	Route::post('/clients/backup/{id}', 		'ClientsController@backup')->name('employeeclientsbackup');
	Route::post('/clients/detail',   			'ClientsController@detail')->name('employeeclientdetail');  
	//Maintenance Management
	Route::get('/maintenances', 				'MaintenanceController@index')->name('employeemaintenances');
	Route::get('/maintenances/update/{id}', 	'MaintenanceController@update')->name('employeemaintenancesupdate');
	Route::post('/maintenances/update/{id}', 	'MaintenanceController@update');
	Route::post('/maintenances/detail', 	    'MaintenanceController@detail')->name('employeemaintenancesdetail');  
	Route::post('/maintenances/posttable', 		'MaintenanceController@posttable')->name('employeemaintenancesposttable');  
	// Service Management
	Route::get('/services', 					'ServiceController@index')->name('employeeservices');
	Route::get('/services/update/{id}', 		'ServiceController@update')->name('employeeservicesupdate');
	Route::post('/services/update/{id}', 		'ServiceController@update');
	Route::post('/services/detail', 			'ServiceController@detail')->name('employeeservicesdetail');
	Route::post('/services/uploadimage',   		'ServiceController@uploadimage')->name('employeeservicesuploadimage'); 
	//Additional Job Management      
	Route::get('/additionals', 					'AdditionalController@index')->name('employeeadditionals');
	Route::get('/additionals/create', 			'AdditionalController@create')->name('employeeadditionalscreate');
	Route::post('/additionals/create', 			'AdditionalController@create'); 
	Route::get('/additionals/delete/{id}', 		'AdditionalController@delete')->name('employeeadditionalsdelete');
	Route::post('/additionals/detail', 			'AdditionalController@detail')->name('employeeadditionalsdetail');  
});
 