<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\AdvocatedContentController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Frontend\AdvocatedFrontendController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;

$advocatedSections = array_keys(config('advocated_content.sections', []));


Route::controller(AdvocatedFrontendController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about/our-story', 'about')->name('about.story');
    Route::get('/services', 'services')->name('services.index');
    Route::get('/services/{slug}', 'service')->name('services.show');
    Route::get('/blog', 'blogs')->name('blogs.index');
    Route::get('/blog/{slug}', 'blog')->name('blogs.show');
    Route::redirect('/blogs', '/blog');
    Route::get('/team', 'team')->name('team.index');
    Route::get('/team/{slug}', 'teamMember')->name('team.show');
    Route::get('/careers', 'careers')->name('careers.index');
    Route::get('/careers/{slug}', 'career')->name('careers.show');
    Route::post('/careers/{slug}/apply', 'applyCareer')->name('careers.apply');
    Route::get('/probono', 'proBono')->name('pro-bono.index');
    Route::get('/probono/{slug}', 'proBonoStory')->name('pro-bono.show');
    Route::redirect('/pro-bono', '/probono');
    Route::get('/video', 'videos')->name('videos.index');
    Route::get('/video/{slug}', 'video')->name('videos.show');
    Route::redirect('/videos', '/video');
    Route::get('/gallery', 'gallery')->name('gallery.index');
    Route::get('/contact', 'contact')->name('contact.index');
    Route::get('/consult-here', 'contact')->name('consult.index');
    Route::redirect('/contact-us', '/contact');
});


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});



/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
->prefix('admin')
->name('admin.')
->group(function () use ($advocatedSections) {

    Route::resource('roles', RoleController::class);

    Route::resource('permissions', PermissionController::class);

    Route::resource('users', UserController::class);

    Route::resource('gallery-images', GalleryImageController::class)
        ->except(['show']);

    Route::controller(AdvocatedContentController::class)
        ->prefix('advocated-content')
        ->name('advocated-content.')
        ->whereIn('section', $advocatedSections)
        ->group(function () {
            Route::get('{section}', 'index')->name('index');
            Route::get('{section}/create', 'create')->name('create');
            Route::post('{section}', 'store')->name('store');
            Route::get('{section}/{advocatedContent}/edit', 'edit')->name('edit');
            Route::get('{section}/{advocatedContent}', 'show')->name('show');
            Route::match(['put', 'patch'], '{section}/{advocatedContent}', 'update')->name('update');
            Route::delete('{section}/{advocatedContent}', 'destroy')->name('destroy');
        });

});



require __DIR__.'/auth.php';
