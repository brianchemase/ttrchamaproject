<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\ContributionsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admins'], function() {

    Route::get('/', [AdministrationController::class, 'home'])->name('dashone');
    Route::get('/MemberRegister', [AdministrationController::class, 'memberregister'])->name('membersRegister');

    Route::get('/StoreMemberData', [AdministrationController::class, 'StoreMemberData'])->name('StoreMemberData');

    Route::get('/ViewMemberRegister', [AdministrationController::class, 'viewmemberregister'])->name('viewmembersRegister');


    //contributions
    Route::get('/MonthlyContributions', [ContributionsController::class, 'contributions'])->name('Monthlycontributions');



    Route::get('/forms', [AdministrationController::class, 'form'])->name('dashoneform');
    Route::get('/Table', [AdministrationController::class, 'table'])->name('dashonetable');
    Route::get('/blank', [AdministrationController::class, 'home'])->name('dashoneblank');
    Route::get('/formtable', [AdministrationController::class, 'formtable'])->name('dashoneformtable');
});