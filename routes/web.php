<?php

use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Annotation\Route as AnnotationRoute;

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
        // -----------------------------web navbar route  -----------------------------
        Route::post('/contactSave', 'ContactController@save')->name('contactSave');
        Route::get('/contact', 'ContactController@contact')->name('contact');
        Route::get('/about', 'AboutController@index')->name('about');
        Route::get('/blogbage', 'BlogController@blog')->name('blog');
        Route::get('/Galarybage', 'GalaryController@Galary')->name('Galary');
        // -----------------------------web route  -----------------------------



        // -----------------------------Contact  operation-----------------------------
        Route::get('/allcontact', 'ContactController@index')->name('allcontact');
        Route::get('/deletContact{id}', 'ContactController@delete')->name('deletContact');
        Route::get('/showContact{id}', 'ContactController@show')->name('showContact');
        // -----------------------------Contact  operation-----------------------------


        // -----------------------------blog Card operation-----------------------------
        Route::get('/createblog', 'BlogController@create')->name('createblog');
        Route::get('/showblog{id}', 'BlogController@show')->name('showblog');
        Route::get('/allblog', 'BlogController@index')->name('allblog');
        Route::get('/deletblog{id}', 'BlogController@delete')->name('deletblog');
        Route::post('/storeblog', 'BlogController@store')->name('storeblog');
        Route::post('/updateblog', 'BlogController@save')->name('saveblog');
        Route::get('/editblog{id}', 'BlogController@edit')->name('updateblog');
        // -----------------------------blog Card operation-----------------------------


        // -----------------------------Galary Card operation-----------------------------
        Route::get('/createGalary', 'GalaryController@create')->name('createGalary');
        Route::get('/showGalary{id}', 'GalaryController@show')->name('showGalary');
        Route::get('/allGalary', 'GalaryController@index')->name('allGalary');
        Route::get('/deletGalary{id}', 'GalaryController@delete')->name('deletGalary');
        Route::post('/storeGalary', 'GalaryController@store')->name('storeGalary');
        Route::post('/updateGalary', 'GalaryController@update')->name('updateGalary');
        Route::get('/editGalary{id}', 'GalaryController@edit')->name('editGalary');
        // -----------------------------Galary Card operation-----------------------------


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// -----------------------------users operation-----------------------------
Route::get('/profile', 'UserController@profile')->name('profile');
Route::post('/saveUser', 'UserController@save')->name('saveUser');
Route::get('/createUser', 'UserController@create')->name('createUser');
Route::get('/editUser{id}', 'UserController@edit')->name('editUser');
Route::get('/showUser{id}', 'UserController@show')->name('showUser');
Route::get('/deletuser{id}', 'UserController@deletuser')->name('deletuser');
Route::get('/allUser', 'UserController@index')->name('allUser');
Route::post('/storeUser', 'StoreUserController@store')->name('storeUser');
// -----------------------------users operation-----------------------------




// ExpenCompany Route
Route::get('/ExpenCompanys.create', 'ExpenCompanyController@create')->name('ExpenCompanys.create'); // صفحة انشاء  مصاريف للشركة
Route::get('/ExpenCompanys.index', 'ExpenCompanyController@index')->name('ExpenCompanys.index');// صفحة تخزين  مصاريف للشركة
Route::post('/ExpenCompanys.store', 'ExpenCompanyController@store')->name('ExpenCompanys.store'); //  تعديل مصاريف للشركة
Route::get('/ExpenCompanysEdit{id}', 'ExpenCompanyController@edit')->name('ExpenCompanys.edit'); // صفحة عرض جميع مصاريف
Route::delete('/ExpenCompanysDelete{id}', 'ExpenCompanyController@destroy')->name('ExpenCompanys.delete'); // صفحة عرض جميع مصاريف
Route::post('/ExpenCompanysUpdate', 'ExpenCompanyController@update')->name('ExpenCompanys.update'); // صفحة عرض جميع مصاريف
// ExpenCompany Routes


// Store Details Routes//////////////////
Route::delete('Stores{StoreId}/StoreDetails{StoreDetailId}', 'StoreDetailsController@deleteStoreDetail')->name('stores.deleteStoreDetail');
Route::get('Stores{StoreId}/StoreDetails{StoreDetailId}/edit','StoreDetailsController@editStoreDetail')->name('stores.editStoreDetails');
Route::put('Stores{StoreId}/StoreDetails{StoreDetailId}','StoreDetailsController@updateStoreDetail')->name('stores.updateStoreDetail');
Route::delete('stores{storeId}/StoreDetails','StoreDetailsController@deleteAllStoreDetails')->name('stores.deleteAllStoreDetails');

// StoreDetails Routes//////////////////



// Store Routes//////////////////

Route::get('/stores.create', 'StoreController@create')->name('stores.create');
Route::get('/stores.index', 'StoreController@index')->name('stores.index');
Route::post('/stores.store', 'StoreController@store')->name('stores.store');
Route::post('/fertilizer/store-from-store', 'FertilizerController@storeFromStore')->name('fertilizer.storeFromStore');
Route::get('/StoresShow{id}', 'StoreController@show')->name('stores.show');
Route::get('/StoresEdit{id}', 'StoreController@edit')->name('stores.edit');
Route::get('/editQuantity{id}', 'StoreController@editQuantity')->name('stores.editQuantity');
Route::delete('/StoresDestroy{id}', 'StoreController@destroy')->name('stores.destroy');
Route::post('/StoresUpdate{id}', 'StoreController@update')->name('stores.update');
Route::post('/updateQuantity{id}', 'StoreController@updateQuantity')->name('stores.updateQuantity');

// Store Routes/////////////////


// CashBox Routes//////////////////

Route::get('/CashBoxs.create', 'CashBoxController@create')->name('CashBoxs.create');
Route::get('/CashBoxs.index', 'CashBoxController@index')->name('CashBoxs.index');
Route::post('/CashBoxs.store', 'CashBoxController@store')->name('CashBoxs.store');
Route::get('/CashBoxsEdit{id}', 'CashBoxController@edit')->name('CashBoxs.edit');
Route::delete('/CashBoxsDestroy{id}', 'CashBoxController@destroy')->name('CashBoxs.destroy');
Route::post('/CashBoxsUpdate{id}', 'CashBoxController@update')->name('CashBoxs.update');
// CashBox Routes/////////////////




// land Routes//////////////////

Route::get('/lands.create', 'LandController@create')->name('lands.create');
Route::get('/lands.index', 'LandController@index')->name('lands.index');
Route::post('/lands.store', 'LandController@store')->name('lands.store');
Route::get('/landsEdit{id}', 'LandController@edit')->name('lands.edit');
Route::get('/landsShow{id}', 'LandController@show')->name('lands.show');
Route::delete('/landsDestroy{id}', 'LandController@destroy')->name('lands.destroy');
Route::post('/landsUpdate{id}', 'LandController@update')->name('lands.update');

// land Routes/////////////////


// MachineJob Routes/////////////////
Route::get('MachineJobsAll','MachineJobController@index')->name('MachineJobs.index');
Route::get('createMachineJob','MachineJobController@create')->name('createMachineJob');
Route::post('/addMachineJob', 'MachineJobController@addMachineJob')->name('MachineJobStore');


Route::get('crops{CropId}/MachineJob{MachineJobId}/edit','MachineJobController@editMachineJob')->name('crops.editMachineJob');
Route::post('crops{CropId}/MachineJob{MachineJobId}','MachineJobController@updateMachineJob')->name('crops.updateMachineJob');


Route::delete('crops{CropId}/MachineJob{MachineJobId}', 'MachineJobController@deleteMachineJob')->name('crops.deleteMachineJob');
Route::delete('crops{CropId}/MachineJob','MachineJobController@deleteAllMachineJob')->name('crops.deleteAllMachineJob');
// MachineJob Routes/////////////////





// WorkerGroup Routes/////////////////

Route::get('/WorkerGroupSupervisor{id}','WorkerGroupController@displaysupervisor')->name('displaysupervisor');
Route::get('WorkerGroupsAll','WorkerGroupController@index')->name('WorkerGroups.index');
Route::get('createWorkerGroup','WorkerGroupController@create')->name('createWorkerGroup');
Route::post('/addWorkerGroupDetail', 'WorkerGroupController@addWorkerGroup')->name('WorkerGroupStore');


Route::post('crops{CropId}/editWorkerGroupsupervisor{WorkerGroupId}/edit','WorkerGroupController@editWorkerGroup')->name('crops.editWorkerGroupsupervisor');
Route::get('crops{CropId}/WorkerGroup{WorkerGroupId}/edit','WorkerGroupController@editWorkerGroup')->name('crops.editWorkerGroup');

Route::post('crops{CropId}/WorkerGroup{WorkerGroupId}','WorkerGroupController@updateWorkerGroup')->name('crops.updateWorkerGroup');


Route::delete('crops{CropId}/WorkerGroup{WorkerGroupId}', 'WorkerGroupController@deleteWorkerGroup')->name('crops.deleteWorkerGroup');
Route::delete('crops{CropId}/WorkerGroup','WorkerGroupController@deleteAllWorkerGroup')->name('crops.deleteAllWorkerGroup');

Route::delete('Workervisours{WorkervisourId}/payments{paymentId}', 'WorkerPaymentController@deletepayment')->name('Workervisours.deletepayment');
Route::get('Workervisours{WorkervisourId}/payments{paymentId}/edit','WorkerPaymentController@editpayment')->name('Workervisours.editpayment');
Route::put('Workervisours{WorkervisourId}/payments{paymentId}','WorkerPaymentController@updatepayment')->name('Workervisours.updatepayment');
Route::delete('Workervisours{WorkervisourId}/payments','WorkerPaymentController@deleteAllpayments')->name('Workervisours.deleteAllpayments');
Route::post('/Workervisourspayments{id}', 'WorkerPaymentController@addpayment')->name('Workervisours.addpayment');

// WorkerGroup Routes/////////////////





// fertilizer Routes/////////////////

Route::get('fertilizersAll','FertilizerController@index')->name('fertilizers.index');
Route::get('createFertilizer','FertilizerController@create')->name('createFertilizer');
Route::post('/addFertilizerDetail', 'FertilizerController@addFertilizer')->name('fertilizerStore');


Route::get('crops{CropId}/Fertilizer{FertilizerId}/edit','FertilizerController@editFertilizer')->name('crops.editFertilizer');
Route::post('crops{CropId}/Fertilizer{FertilizerId}','FertilizerController@updateFertilizer')->name('crops.updateFertilizer');


Route::delete('crops{CropId}/Fertilizer{FertilizerId}', 'FertilizerController@deleteFertilizer')->name('crops.deleteFertilizer');
Route::delete('crops{CropId}/Fertilizer','FertilizerController@deleteAllFertilizer')->name('crops.deleteAllFertilizer');
// fertilizer Routes/////////////////




// Crops Routes/////////////////
Route::post('/landcrops', 'CropController@addCrops')->name('lands.addCrops');
Route::get('/CropsCreate','CropController@createCrop')->name('lands.CreateCrop');
Route::delete('/lands{landId}/Crops{CropId}', 'CropController@deleteCrop')->name('lands.deleteCrop');
Route::get('/lands{landId}/Crops{CropId}/edit','CropController@editCrop')->name('lands.editCrop');
Route::post('/lands{landId}/Crops{CropId}','CropController@updateCrop')->name('lands.updateCrop');
Route::delete('/lands{landId}/Crops','CropController@deleteAllCrops')->name('lands.deleteAllCrops');
Route::get('/lands{landId}/Crops{CropId}','CropController@showCrop')->name('lands.showCrop');
Route::get('/allCrops','CropController@index')->name('crops.index');

// Crops Routes///////////////


// Worker Routes


// Worker expensafe worker  Routes
Route::delete('workers{workerId}/expenses{expenseId}', 'ExpenseDetailsController@deleteExpense')->name('workers.deleteExpense');
Route::get('workers{workerId}/expenses{expenseId}/edit','ExpenseDetailsController@editExpense')->name('workers.editExpense');
Route::put('workers{workerId}/expenses{expenseId}','ExpenseDetailsController@updateExpense')->name('workers.updateExpense');
Route::delete('workers{workerId}/expenses','ExpenseDetailsController@deleteAllExpenses')->name('workers.deleteAllExpenses');
Route::post('/workersExpenses{id}', 'ExpenseDetailsController@addExpense')->name('workers.addExpense');
//-------------------------------------------------------

Route::delete('workers{workerId}/destory','WorkerController@delete')->name('workers.destory');
Route::post('/attendes/getting', 'WorkerController@attendesGetting')->name('attend.getting');
Route::get('/attendes', 'WorkerController@attendes')->name('attendes');
Route::get('/ShowWorkers{worker}', 'WorkerController@show')->name('ShowWorker');
Route::post('/saveWorkers', 'WorkerController@update')->name('saveWorkers');
Route::get('/workers/create', [WorkerController::class, 'create'])->name('workers.create'); // صفحة انشاء  عامل
Route::post('/workers/store', [WorkerController::class, 'store'])->name('workers.store'); // صفحة تخزين  عامل
Route::get('/workers{worker}', [WorkerController::class, 'edit'])->name('workers.edit'); //  تعديل عامل
Route::get('/workers', [WorkerController::class, 'index'])->name('workers.index'); // صفحة عرض جميع العمال
// Worker Routes
Route::post('/attendance/store', 'AttendanceController@storeAttendance')->name('attend.getting');


Route::get('/attendance/data', 'AttendanceController@getAttendanceData')->name('attend');



// // Crop Routes
// Route::get('/crops{crop}/MachineJobs', [MachineJobDetailController::class, 'indexForCrop'])->name('crops.MachineJobs'); // عرض جميع الأسمدة في زرع معين
// Route::get('/crops{crop}/machine-jobs', [MachineJobController::class, 'indexForCrop'])->name('crops.machine_jobs'); // عرض شغل الآلات في زرع معين
// Route::get('/crops{crop}/workers', [WorkerController::class, 'indexForCrop'])->name('crops.workers'); // عرض العمال في زرع معين
// Route::get('/crops{crop}', [CropController::class, 'show'])->name('crops.show'); // صفحة تفصيلية لكل ما يتعلق بالزرع






Route::resource('workers', WorkerController::class);
Route::resource('machine-jobs', MachineJobController::class);

Route::resource('damageReports', DamageReportController::class);


// Machine Job Routes
Route::resource('machine-jobs', MachineJobController::class);


// Expense Detail Routes
Route::resource('expense-details', ExpenseDetailController::class);


// Product Detail Routes
Route::resource('product-details', ProductDetailController::class);

// DamageReport Report Routes
Route::resource('damageReport-reports', DamageReportReportController::class);
