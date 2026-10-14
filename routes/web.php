<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AlbumFrontendController;
use App\Http\Controllers\Frontend\ArtistFrontendController;
use App\Http\Controllers\Frontend\MusicFrontendController;
use App\Http\Controllers\Frontend\VideoFrontendController;
use App\Http\Controllers\Frontend\FavoriteController;
use App\Http\Controllers\Frontend\ReviewFrontendController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\UserAuthController;
use App\Http\Controllers\Frontend\UserProfileController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('frontend.search');

Route::get('/music', [MusicFrontendController::class, 'index'])->name('frontend.music');
Route::get('/music/{id}', [MusicFrontendController::class, 'show'])->name('frontend.music.show');

Route::get('/artists', [ArtistFrontendController::class, 'index'])->name('frontend.artists');
Route::get('/artists/{id}', [ArtistFrontendController::class, 'show'])->name('frontend.artists.show');

Route::get('/albums', [AlbumFrontendController::class, 'index'])->name('frontend.albums');
Route::get('/albums/{id}', [AlbumFrontendController::class, 'show'])->name('frontend.albums.show');

Route::get('/videos', [VideoFrontendController::class, 'index'])->name('frontend.videos');
Route::get('/videos/{id}', [VideoFrontendController::class, 'show'])->name('frontend.videos.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('frontend.favorites');
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('user.favorites.store');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('user.favorites.destroy');

    Route::post('/reviews', [ReviewFrontendController::class, 'store'])->name('user.reviews.store');
    Route::delete('/reviews/{id}', [ReviewFrontendController::class, 'destroy'])->name('user.reviews.destroy');

    Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::post('/profile/avatar', [UserProfileController::class, 'updateAvatar'])->name('user.profile.avatar');
    Route::delete('/profile/avatar', [UserProfileController::class, 'removeAvatar'])->name('user.profile.avatar.remove');
    Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])->name('user.profile.password');
});

Route::get('/user/login', [UserAuthController::class, 'showLogin'])->name('user.login');
Route::post('/user/login', [UserAuthController::class, 'login'])->name('user.login.post');
Route::get('/user/register', [UserAuthController::class, 'showRegister'])->name('user.register');
Route::post('/user/register', [UserAuthController::class, 'register'])->name('user.register.post');
Route::post('/user/logout', [UserAuthController::class, 'logout'])->name('user.logout');

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('artists', ArtistController::class);
    Route::resource('albums', AlbumController::class);
    Route::resource('music', MusicController::class);
    Route::resource('videos', VideoController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('languages', LanguageController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('users', UserController::class)->except(['create', 'store']);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/logo', [SettingController::class, 'updateLogo'])->name('settings.logo.update');
    Route::delete('/settings/logo', [SettingController::class, 'removeLogo'])->name('settings.logo.remove');
});

Route::get('/login', fn () => redirect()->route('user.login'))->name('login');