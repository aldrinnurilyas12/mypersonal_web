<?php

use App\Http\Controllers\ProfileController;
use aPP\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// ROUTE WEB MAIN PAGES ----------------------


Route::get('/', [App\Http\Controllers\HomepageController::class, 'index']);
Route::apiResource('aldrinnurilyas', App\Http\Controllers\HomepageController::class);
Route::get('/about', [App\Http\Controllers\HomepageController::class, 'about'])->name('about');
Route::get('/myprojects', [App\Http\Controllers\ProjectsController::class, 'showproject'])->name('myprojects');
Route::get('displayproject/{project_code}', [App\Http\Controllers\ProjectsController::class, 'displayproject'])->name('displayproject');
Route::get('myworking', [App\Http\Controllers\WorkingExperience::class, 'mywork'])->name('myworking');
Route::get('/posts', [App\Http\Controllers\DailyPostController::class, 'showpost'])->name('posts');
Route::get('mypodcast', [App\Http\Controllers\PodcastController::class, 'showpodcast'])->name('mypodcast');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::apiResource('dashboard_admin', App\Http\Controllers\DashboardMain::class);

    Route::apiResource('dailyposts', App\Http\Controllers\DailyPostController::class);
    Route::get('/postcreate', [App\Http\Controllers\DailyPostController::class, 'create'])->name('dailypost_create');
    Route::get('postupdate/{id}', [App\Http\Controllers\DailyPostController::class, 'edit'])->name('postupdate');
    Route::delete('deleteposts/{id}', [App\Http\Controllers\DailyPostController::class, 'destroy'])->name('deleteposts');
    Route::put('editposts/{id}', [App\Http\Controllers\DailyPostController::class, 'update'])->name('editposts');

    Route::apiResource('projects', App\Http\Controllers\ProjectsController::class);
    Route::get('/projects_create', [App\Http\Controllers\ProjectsController::class, 'create'])->name('projects_create');
    Route::get('projects_edit/{id}', [App\Http\Controllers\ProjectsController::class, 'edit_layout'])->name('projects_edit');
    Route::put('projects_update/{id}', [App\Http\Controllers\ProjectsController::class, 'update'])->name('projects_update');
    Route::delete('projects_delete/{id}', [App\Http\Controllers\ProjectsController::class, 'destroy'])->name('projects_delete');

    Route::apiResource('workingexperiences', App\Http\Controllers\WorkingExperience::class);
    Route::get('/workcreate', [App\Http\Controllers\WorkingExperience::class, 'create'])->name('workcreate');
    Route::get('workedit/{id}', [App\Http\Controllers\WorkingExperience::class, 'edit_layout'])->name('workedit');
    Route::put('work_update/{id}', [App\Http\Controllers\WorkingExperience::class, 'update'])->name('work_update');
    Route::delete('work_delete/{id}', [App\Http\Controllers\WorkingExperience::class, 'destroy'])->name('work_delete');


    Route::apiResource('profilepictures', App\Http\Controllers\ProfilePictureController::class);
    Route::put('profile_update/{id}', [App\Http\Controllers\ProfilePictureController::class, 'update'])->name('profile_update');
    Route::get('profile_edit/{id}', [App\Http\Controllers\ProfilePictureController::class, 'update_layouts'])->name('profile_edit');
    Route::delete('profile_delete/{id}', [App\Http\Controllers\ProfilePictureController::class, 'destroy'])->name('profile_delete');

    Route::apiResource('podcast', App\Http\Controllers\PodcastController::class);
    Route::put('podcast_update/{id}', [App\Http\Controllers\PodcastController::class, 'update'])->name('podcast_update');
    Route::delete('podcast_delete/{id}', [App\Http\Controllers\PodcastController::class, 'destroy'])->name('podcast_delete');
});

require __DIR__ . '/auth.php';




