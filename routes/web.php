<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\HtmlSnippetController;

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

Route::get('/', function() {
    return view('visitor');
});

Route::get('/admin', function() {
    return view('admin');
})->name('admin');

Route::resource('links', LinkController::class)->except([
    'create', 'show', 'edit'
]);

Route::resource('html_snippets', HtmlSnippetController::class)->except([
    'create', 'show', 'edit'
]);

Route::get('pdfs/{pdf}/download', [PdfController::class, 'download'])->name('pdfs.download');

Route::resource('pdfs', PdfController::class)->except([
    'create', 'show', 'edit'
]);
