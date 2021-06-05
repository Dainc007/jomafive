<?php

use App\Models\Article;
use App\Models\Admin\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\SiteController::class, 'index']);

Route::get('/import_excel', [App\Http\Controllers\ImportExcelController::class, 'index']);
Route::post('import_excel/import/{competitionID}', [App\Http\Controllers\ImportExcelController::class, 'import']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/articles')->group(function () {
     //wszystkie artykuły
     Route::get('/', [App\Http\Controllers\ArticleController::class, 'index'])
          ->name('articles.index');

     Route::get('/business/{level}', [App\Http\Controllers\ArticleController::class, 'business'])
          ->name('articles.business');

     Route::get('/weekend/{level}', [App\Http\Controllers\ArticleController::class, 'weekend'])
          ->name('articles.weekend');

     Route::get('/kid/{class}', [App\Http\Controllers\ArticleController::class, 'kid'])
          ->name('articles.kid');

     //dodanie artykułu
     Route::get(
          '/add',
          [App\Http\Controllers\ArticleController::class, 'add']
     )->name('articles.add');

     //miejsce, w ktorym zapisujemy artykuł
     Route::post(
          '/store',
          [App\Http\Controllers\ArticleController::class, 'store']
     )->name('articles.store');

     //wyswietlenie artykułu
     Route::get(
          '/{article}',
          [App\Http\Controllers\ArticleController::class, 'show']
     )->name('articles.show');

     //edycja konkretnego artykułu
     Route::get(
          '/{article}/edit',
          [App\Http\Controllers\ArticleController::class, 'edit']
     )->name('articles.edit');

     //aktualizacja 
     Route::put(
          '/{article}',
          [App\Http\Controllers\ArticleController::class, 'update']
     )->name('articles.update');

     //usuwanie artykułu
     Route::delete(
          '/{article}',
          [App\Http\Controllers\ArticleController::class, 'delete']
     )->name('articles.delete');
});

Route::prefix('/gallery')->group(function () {
     //wszystkie artykuły
     Route::get('/', [App\Http\Controllers\GalleryController::class, 'index'])
          ->name('gallery.index');

     //dodanie artykułu
     Route::post(
          '/store',
          [App\Http\Controllers\GalleryController::class, 'store']
     )->name('gallery.store');

     Route::get(
          '/show',
          [App\Http\Controllers\GalleryController::class, 'show']
     )->name('gallery.show');
});

Route::prefix('/teams')->group(function () {

     Route::get('/', [App\Http\Controllers\Admin\TeamController::class, 'index'])
          ->name('teams.index');

     Route::get('/add', [App\Http\Controllers\Admin\TeamController::class, 'add'])
          ->name('teams.add');

     Route::post('/store', [App\Http\Controllers\Admin\TeamController::class, 'store'])
          ->name('teams.store');

     Route::get('/show', [App\Http\Controllers\Admin\TeamController::class, 'show'])
          ->name('teams.show');

     Route::put(
          '/junior/{id}',
          [App\Http\Controllers\Admin\TeamController::class, 'update']
     )->name('teams.update');
});

Route::prefix('/player')->group(function () {
     Route::get('/show/{id}', [App\Http\Controllers\Admin\PlayerController::class, 'players'])
          ->name('teams.player');

     Route::get('/transferList', [App\Http\Controllers\Admin\PlayerController::class, 'transferList'])
          ->name('teams.transferList');

     Route::post('/transferList/add', [App\Http\Controllers\Admin\PlayerController::class, 'add'])
          ->name('player.transferList');
});



Route::get('/manager/show/{id}', [App\Http\Controllers\Admin\PlayerController::class, 'managers'])
     ->name('teams.manager');



Route::prefix('/leagueTables')->group(function () {

     Route::get('/', [App\Http\Controllers\Admin\LeagueTableController::class, 'index'])
          ->name('leagueTables.index');

     Route::get('/add', [App\Http\Controllers\Admin\LeagueTableController::class, 'add'])
          ->name('leagueTables.add');

     Route::get('/show', [App\Http\Controllers\Admin\LeagueTableController::class, 'show'])
          ->name('leagueTables.show');
});

Route::prefix('/competitions')->group(function () {

     Route::get('/', [App\Http\Controllers\Admin\CompetitionController::class, 'index'])
          ->name('competitions.index');

     Route::get('/add', [App\Http\Controllers\Admin\CompetitionController::class, 'add'])
          ->name('competitions.add');

     Route::get('/show/{id}', [App\Http\Controllers\Admin\CompetitionController::class, 'show'])
          ->name('competitions.show');

     Route::get('/junior/show/{id}', [App\Http\Controllers\Admin\CompetitionController::class, 'juniorShow'])
          ->name('competitions.juniorShow');

     Route::post('/store', [App\Http\Controllers\Admin\CompetitionController::class, 'store'])
          ->name('competitions.store');
});

Route::prefix('/fixtures')->group(function () {

     Route::get('/', [App\Http\Controllers\Admin\FixturesController::class, 'index'])
          ->name('fixtures.index');

     Route::get('/add', [App\Http\Controllers\Admin\FixturesController::class, 'add'])
          ->name('fixtures.add');

     Route::get('/show', [App\Http\Controllers\Admin\FixturesController::class, 'show'])
          ->name('fixtures.show');

     Route::post('/store', [App\Http\Controllers\Admin\FixturesController::class, 'store'])
          ->name('fixtures.store');

     Route::get('/game/{competitionID}/{gameID}', [App\Http\Controllers\Admin\FixturesController::class, 'gameShow'])
          ->name('fixtures.gameShow');
});

Route::prefix('/stats')->group(function () {

     Route::get('/', [App\Http\Controllers\Admin\PlayerStatsController::class, 'index'])
          ->name('stats.index');

     Route::get('/add/{id}', [App\Http\Controllers\Admin\PlayerStatsController::class, 'add'])
          ->name('stats.add');

     Route::post('/store', [App\Http\Controllers\Admin\PlayerStatsController::class, 'store'])
          ->name('stats.store');

     Route::get('/show', [App\Http\Controllers\Admin\PlayerStatsController::class, 'show'])
          ->name('stats.show');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
