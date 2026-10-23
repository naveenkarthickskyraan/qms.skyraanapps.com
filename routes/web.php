<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\QuizImportController;

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

Route::get('/', [App\Http\Controllers\AdminController::class, 'login_check'])->name('admin.login_check');

Route::get('/api',[App\Http\Controllers\Api\ApiController::class,'check']);


Route::get('auth/login', function () {
    return view('auth.login');
});

Route::get('add-to-log', 'App\Http\Controllers\HomeController@myTestAddToLog');

Route::post('admin/quiz_direction_value', [App\Http\Controllers\QuizController::class, 'directionValue'])->name('quiz.direction.value');

Route::group(['prefix' => 'admin'], function()
{
	Route::group(['middleware' => 'admin.guest'], function()
    {
		Route::view('/login','admin.login')->name('admin.login');
		Route::post('/login',[App\Http\Controllers\AdminController::class, 'authenticate'])->name('admin.auth');
	});

	Route::group(['middleware' => 'admin.auth'], function()
    {

        Route::get('/dashboard', [App\Http\Controllers\AdminController::class,'dashboard'])->name('admin/dashboard');

        Route::get('/admin_add_app', [App\Http\Controllers\AppController::class,'Add_list']);

        Route::get('/app_list',[AppController::class,'show'])->name('admin.dashboard');

        Route::post('/insert', [App\Http\Controllers\AppController::class,'store'])->name('admin.insert');

        Route::any('/edit_app/{id}',[App\Http\Controllers\AppController::class,'EditApp'])->name('admin.edit');

        Route::post('/delete_app/{id}',[App\Http\Controllers\AppController::class,'delete'])->name('admin.delete');

        Route::any('/edit_app_list/{id}',[App\Http\Controllers\AppController::class,'EditAppList'])->name('admin.update');

        Route::any('/mapped_app/{id}',[App\Http\Controllers\AppController::class,'edit'])->name('admin.mapping');

        Route::post('/update_map_cat/{id}',[App\Http\Controllers\MappedApp::class,'insert'])->name('admin.mapping_cat');

        Route::post('/app_status_update', [App\Http\Controllers\AppController::class, 'active'])->name('admin.app.status');

        //category

        Route::get('/category_list',[App\Http\Controllers\CategoryController::class,'show'])->name('category.list');

        Route::get('/add_category', [App\Http\Controllers\CategoryController::class,'Add_list']);

        Route::post('/category.insert', [App\Http\Controllers\CategoryController::class,'store']);

        Route::post('/edit_category_list/{id}',[App\Http\Controllers\CategoryController::class,'EditCatList']);

        Route::any('/edit_category/{id}',[App\Http\Controllers\CategoryController::class,'EditCategory']);

        Route::post('/delete_category/{id}',[App\Http\Controllers\CategoryController::class,'delete']);

        Route::post('/category_status_update', [App\Http\Controllers\CategoryController::class, 'active']);

        Route::get('/file-export/{category_id}', [App\Http\Controllers\CategoryController::class, 'fileExport'])->name('file-export');


        //profile update
        Route::get('/profile_update', function () {return view('admin.accounts.profile_update');});

        Route::any('/home','App\Http\Controllers\AdminController@profileUpdate')->name('profileupdate');

        Route::post('/uploadFile', 'App\Http\Controllers\CategoryController@uploadFile');



        //question

        Route::post('/image_upload', [App\Http\Controllers\AdminController::class, 'upload'])->name('upload');

        Route::post('/edit_prayers_list/{id}',[App\Http\Controllers\PrayerController::class,'EditQuestionList']);

        Route::any('/edit_prayers/{id}',[App\Http\Controllers\PrayerController::class,'EditQuestion']);

        Route::post('/delete_prayers/{id}',[App\Http\Controllers\PrayerController::class,'delete']);

        Route::post('/insert_prayers', [App\Http\Controllers\PrayerController::class,'store']);

        Route::get('/prayers_list',[App\Http\Controllers\PrayerController::class,'show'])->name('admin.question');

        Route::get('/add_prayers',[App\Http\Controllers\PrayerController::class,'add']);

        Route::post('/prayers_status_update', [App\Http\Controllers\PrayerController::class, 'active']);

        //Accounts list

        Route::get('/superadmin',[App\Http\Controllers\AdminController::class,'superadmin'])->name('superadmin');

        Route::get('/admin_add_sub_admin',[App\Http\Controllers\AdminController::class,'add']);

        Route::post('/admin_insert',[App\Http\Controllers\AdminController::class,'insert']);

        Route::any('/edit_admin/{id}',[App\Http\Controllers\AdminController::class,'edit']);

        Route::any('/edit_admin_list/{id}',[App\Http\Controllers\AdminController::class,'editlist']);

        Route::post('/user_status_update', [App\Http\Controllers\AdminController::class, 'active']);

        Route::post('/delete_admin/{id}',[App\Http\Controllers\AdminController::class,'delete']);

        Route::get('/logActivity', 'App\Http\Controllers\HomeController@logActivity');

        Route::post('/activitydelete',[App\Http\Controllers\AdminController::class,'activitydelete']);

        route::post('/manage/{id}',[App\Http\Controllers\AdminController::class,'manage']);

        //Nested SubCategory

        Route::get('/nested_category_list',[App\Http\Controllers\NestedCategoryController::class,'show'])->name('nested_category.list');

        Route::get('/add_nested_category', [App\Http\Controllers\NestedCategoryController::class,'Add_list']);

        Route::post('/nested_category.insert', [App\Http\Controllers\NestedCategoryController::class,'store']);

        Route::post('/edit_nested_category_list/{id}',[App\Http\Controllers\NestedCategoryController::class,'EditCatList']);

        Route::any('/edit_nested_category/{id}',[App\Http\Controllers\NestedCategoryController::class,'EditCategory']);

        Route::post('/delete_nested_category/{id}',[App\Http\Controllers\NestedCategoryController::class,'delete']);

        Route::post('/nested_category_status_update', [App\Http\Controllers\NestedCategoryController::class, 'active']);


        //Supporting Subcategory Routes

        Route::get('/subcategories', [SubcategoryController::class, 'index']);
        Route::post('/subcategories', [SubcategoryController::class, 'store']);
        Route::get('/subcategories/{id}', [SubcategoryController::class, 'show']);
        Route::put('/subcategories/{id}', [SubcategoryController::class, 'update']);
        Route::delete('/subcategories/{id}', [SubcategoryController::class, 'destroy']);


        //Quiz

        Route::get('/quiz_list',[App\Http\Controllers\QuizController::class,'show'])->name('quiz.list');

        Route::get('/add_quiz', [App\Http\Controllers\QuizController::class,'add']);

        Route::post('/quiz.insert', [App\Http\Controllers\QuizController::class,'store']);

        Route::post('/edit_quiz_list/{id}',[App\Http\Controllers\QuizController::class,'EditQuestionList']);

        Route::any('/edit_quiz/{id}',[App\Http\Controllers\QuizController::class,'EditQuestion']);

        Route::post('/delete_quiz/{id}',[App\Http\Controllers\QuizController::class,'delete']);

        Route::post('/quiz_status_update', [App\Http\Controllers\QuizController::class, 'active']);

        //Supporting of Batches added count
        Route::group(['prefix' => 'batches'], function() {
            Route::get('/', [BatchController::class, 'index']);
            Route::get('/batches_info', [BatchController::class, 'yajra'])->name('batch.list');
            Route::post('/', [BatchController::class, 'store']);
            Route::get('/{batch}', [BatchController::class, 'show']);
            Route::put('/{batch}', [BatchController::class, 'update']);
            Route::delete('/{batch}', [BatchController::class, 'destroy']);
            Route::get('/{batch}/categories', [BatchController::class, 'getCategoriesForBatch']);
        });

        Route::any('/edit_batch/{id}', [BatchController::class, 'edit']);
        Route::post('/delete_batch/{id}', [BatchController::class, 'delete']);
        Route::post('/batch_status_update', [BatchController::class, 'active']);
        Route::get('/add_batch', [BatchController::class, 'add']);

        Route::get('/import', function () {
            return view('admin.quiz.import');
        });

        Route::post('/quiz/import', [QuizImportController::class, 'import'])->name('quiz.import');

	}
);

    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
});
