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

Route::get('/admin', function() {
    return view('admin');
});

Route::resource('links', LinkController::class)->except([
    'create', 'show', 'edit'
]);

Route::resource('html_snippets', HtmlSnippetController::class)->except([
    'create', 'show', 'edit'
]);

// Not getting data in put request need to debug
Route::post('pdfs/{pdf}', [PdfController::class, 'update']);

Route::resource('pdfs', PdfController::class)->except([
    'create', 'show', 'edit', 'update'
]);
