<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HourStackController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CredentialController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    Route::get('/jobs', [JobController::class, 'index'])->name('admin.jobs');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('admin.jobs.create');
    Route::post('/jobs', [JobController::class, 'store']);
    Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('admin.jobs.edit');
    Route::patch('/jobs/{id}', [JobController::class, 'update'])->name('admin.jobs.update');
    Route::delete('/jobs/{id}', [JobController::class, 'destroy']);
    Route::post('/jobs/search', [JobController::class, 'search'])->name('admin.jobs.search');
    Route::patch('/jobs/{id}/toggle', [JobController::class, 'toggle']);
    Route::get('/jobs/{id}/order', [JobController::class, 'order'])->name('admin.jobs.order');
    Route::get('/jobs/{param}/filter', [JobController::class, 'filter'])->name('admin.jobs.filter');

    Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('admin.customers.create');
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('admin.customers.edit');
    Route::patch('/customers/{id}', [CustomerController::class, 'update'])->name('admin.customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);
    Route::post('/customers/search', [CustomerController::class, 'search'])->name('admin.customers.search');

    Route::get('/activities', [ActivityController::class, 'index'])->name('admin.activities');
    Route::get('/activities/create', [ActivityController::class, 'create'])->name('admin.activities.create');
    Route::post('/activities', [ActivityController::class, 'store']);
    Route::get('/activities/{id}/edit', [ActivityController::class, 'edit'])->name('admin.activities.edit');
    Route::patch('/activities/{id}', [ActivityController::class, 'update'])->name('admin.activities.update');
    Route::delete('/activities/{id}', [ActivityController::class, 'destroy']);
    Route::get('/activities/{hsid}/filter', [ActivityController::class, 'filter'])->name('admin.activities.filter');
    Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('admin.activities.show');
    Route::get('/activities/store_and_new', [ActivityController::class, 'storeAndNew'])->name('admin.activities.store_and_new');

    Route::get('/projects', [ProjectController::class, 'index'])->name('admin.projects');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::patch('/projects/{id}', [ProjectController::class, 'update'])->name('admin.projects.update');

    Route::get('/hourstacks', [HourStackController::class, 'index'])->name('admin.hourstacks');
    Route::get('/hourstacks/create', [HourStackController::class, 'create'])->name('admin.hourstacks.create');
    Route::post('/hourstacks', [HourStackController::class, 'store']);
    Route::get('/hourstacks/{id}/edit', [HourStackController::class, 'edit'])->name('admin.hourstacks.edit');
    Route::patch('/hourstacks/{id}', [HourStackController::class, 'update'])->name('admin.hourstacks.update');

    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts');
    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::patch('/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('admin.posts.show');

    Route::get('/credentials', [CredentialController::class, 'index'])->name('admin.credentials');
    Route::get('/credentials/create', [CredentialController::class, 'create'])->name('admin.credentials.create');
    Route::post('/credentials', [CredentialController::class, 'store']);
    Route::get('/credentials/{id}', [CredentialController::class, 'show']);
    Route::get('/credentials/{id}/edit', [CredentialController::class, 'edit'])->name('admin.credentials.edit');
    Route::patch('/credentials/{id}', [CredentialController::class, 'update'])->name('admin.credentials.update');
    Route::post('/credentials/filter', [CredentialController::class, 'filter'])->name('admin.credentials.filter');
});
