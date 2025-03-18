<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\MachineJobController;
use App\Http\Controllers\API\FertilizerController;
use App\Http\Controllers\API\WorkerPaymentController;
use App\Http\Controllers\API\StoreDetailsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// ✅ Land Routes
Route::get('/ShowLand{id}', 'API\LandController@show'); // عرض أرض معينة
Route::get('/AllLands', 'API\LandController@index'); // عرض جميع الأراضي
Route::post('/AddLand', 'API\LandController@store'); // إضافة أرض جديدة
Route::post('/UpdateLand{id}', 'API\LandController@update'); // تعديل بيانات أرض
Route::post('/DeleteLand{id}', 'API\LandController@destroy'); // حذف أرض معينة

Route::get('/ShowBlogs{id}', 'API\BlogController@show'); // عرض مقالة واحدة
Route::get('/AllBlogs', 'API\BlogController@index'); // عرض جميع المقالات
Route::post('/AddBlog', 'API\BlogController@store'); // إضافة مقالة جديدة
Route::post('/UpdateBlog{id}', 'API\BlogController@update'); // تحديث مقالة
Route::get('/deleteBlog{id}', 'API\BlogController@destroy'); // حذف مقالة

Route::get('/ShowGalarys{id}', 'API\GalaryController@show'); // عرض مقالة واحدة
Route::get('/AllGalarys', 'API\GalaryController@index'); // عرض جميع المقالات
Route::post('/AddGalary', 'API\GalaryController@store'); // إضافة مقالة جديدة
Route::post('/UpdateGalary{id}', 'API\GalaryController@update'); // تحديث مقالة
Route::get('/deleteGalary{id}', 'API\GalaryController@destroy'); // حذف مقالة




Route::get('/Workers', 'API\WorkerController@index');
Route::get('/showWorker{id}', 'API\WorkerController@show');
Route::get('/deletWorker{id}', 'API\WorkerController@delet');




// Expen Routes
Route::get('workers{workerId}/expens{expenId}/delete', 'API\WorkerController@deleteExpen');
Route::put('workers{workerId}/expens{expenId}/update','API\WorkerController@updateExpen');
Route::get('workers{workerId}/expens/deleteAllExpens','API\WorkerController@deleteAllExpens');
Route::post('/workersExpens{id}/addExpen', 'API\WorkerController@addExpen');

// Worker Routes
Route::get('workers{workerId}/destory','API\WorkerController@delete');
Route::get('/ShowWorkers{worker}', 'API\WorkerController@show');
Route::post('/saveWorkers', 'API\WorkerController@update');
Route::post('/workers/store', 'API\WorkerController@store'); // صفحة تخزين  عامل
Route::get('/workers', 'API\WorkerController@index'); // صفحة عرض جميع العمال
// Worker Routes



// ✅ جلب جميع المصاريف
Route::get('expen-companies', 'API\ExpenCompanyController@index');
// ✅ إضافة مصروف جديد
Route::post('expen-companies', 'API\ExpenCompanyController@store');

// ✅ جلب بيانات مصروف معين
Route::get('expen-companies/{id}', 'API\ExpenCompanyController@show');

// ✅ تحديث بيانات مصروف
Route::put('expen-companies/{id}', 'API\ExpenCompanyController@update');

// ✅ حذف مصروف معين
Route::delete('expen-companies/{id}', 'API\ExpenCompanyController@destroy');

// ✅ حذف جميع المصاريف
Route::delete('expen-companies', 'API\ExpenCompanyController@destroyAll');


Route::get('/ShowCrop{landId}/Crop{cropId}', 'API\CropController@show'); // عرض محصول معين
Route::get('/AllCrops', 'API\CropController@index'); // عرض جميع المحاصيل
Route::post('/AddCrop', 'API\CropController@store'); // إضافة محصول جديد
Route::post('/UpdateCrop{landId}{cropId}', 'API\CropController@update'); // تعديل محصول
Route::post('/DeleteCrop{landId}/Crop{cropId}', 'API\CropController@destroy'); // حذف محصول
Route::post('/DeleteAllCrops{landId}', 'API\CropController@deleteAllCrops'); // حذف جميع المحاصيل للأرض


// ✅ Worker Subervisors API Routes
Route::get('worker-subervisors', 'API\WorkerSubervisorController@index');
Route::post('Store-subervisors', 'API\WorkerSubervisorController@store');
Route::get('show-subervisors/{id}', 'API\WorkerSubervisorController@show');
Route::put('update-subervisors/{id}', 'API\WorkerSubervisorController@update');
Route::delete('delete-subervisors/{id}', 'API\WorkerSubervisorController@destroy');


// ✅ Machine Job Routes
Route::get('/machine-jobs', [MachineJobController::class, 'index']);
Route::post('/store-Machine-jobs', [MachineJobController::class, 'store']);
Route::get('/show-Machine-jobs/{id}', [MachineJobController::class, 'show']);
Route::put('/update-Machine-jobs/{id}', [MachineJobController::class, 'update']);
Route::delete('/delete-Machine-jobs/{id}', [MachineJobController::class, 'destroy']);


// ✅ Fertilizer Routes
Route::get('/fertilizers', [FertilizerController::class, 'index']);
Route::post('/fertilizers', [FertilizerController::class, 'store']);
Route::get('/fertilizers/{id}', [FertilizerController::class, 'show']);
Route::put('/fertilizers/{id}', [FertilizerController::class, 'update']);
Route::delete('/fertilizers/{id}', [FertilizerController::class, 'destroy']);

// ✅ Worker Group Routes
Route::get('worker-groups', 'API\WorkerGroupController@index');
Route::post('worker-groups/add', 'API\WorkerGroupController@addWorkerGroup');
Route::get('worker-groups/{id}', 'API\WorkerGroupController@showWorkerGroup');
Route::put('worker-groups/update/{id}', 'API\WorkerGroupController@updateWorkerGroup');
Route::delete('worker-groups/delete/{id}', 'API\WorkerGroupController@deleteWorkerGroup');
Route::delete('worker-groups/crop/{CropId}', 'API\WorkerGroupController@deleteAllWorkerGroup');
Route::get('worker-groups/subervisor/{id}', 'API\WorkerGroupController@displaySubervisor');



// ✅ Worker Payment Routes
Route::get('/worker-payments/{workervisour}', [WorkerPaymentController::class, 'index']);
Route::post('/worker-payments/{workervisour}', [WorkerPaymentController::class, 'store']);
Route::get('/worker-payments/{workervisour}/{payment}', [WorkerPaymentController::class, 'show']);
Route::put('/worker-payments/{workervisour}/{payment}', [WorkerPaymentController::class, 'update']);
Route::delete('/worker-payments/{workervisour}/{payment}', [WorkerPaymentController::class, 'destroy']);
Route::delete('/worker-payments/{workervisour}', [WorkerPaymentController::class, 'destroyAll']);

// ✅ Store Details Routes
Route::post('/stores/{store}/details', [StoreDetailsController::class, 'store']);
Route::put('/stores/{store}/details/{detail}', [StoreDetailsController::class, 'update']);
Route::delete('/stores/{store}/details/{detail}', [StoreDetailsController::class, 'destroy']);
Route::delete('/stores/{store}/details', [StoreDetailsController::class, 'destroyAll']);
