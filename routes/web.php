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

Route::get('/MonthlyReminder', [ContributionsController::class, 'ContributionsReminder'])->name('ContributionsReminder');


Route::group(['prefix' => 'admins'], function() {

    Route::get('/', [AdministrationController::class, 'home'])->name('dashone');
    Route::get('/MemberRegister', [AdministrationController::class, 'memberregister'])->name('membersRegister');

    Route::post('/StoreMemberData', [AdministrationController::class, 'StoreMemberData'])->name('StoreMemberData');

    Route::get('/ViewMemberRegister', [AdministrationController::class, 'viewmemberregister'])->name('viewmembersRegister');


    //contributions
    Route::get('/MonthlyContributions', [ContributionsController::class, 'contributions'])->name('Monthlycontributions');
    Route::get('/Memberfindsearch', [ContributionsController::class, 'search_entry'])->name('findmembersearch');//searching data


    Route::post('/submit-contribution', [ContributionsController::class, 'submitContribution'])->name('submit-contribution');//save contributions


    //statement
    Route::POST('/Statement', [ContributionsController::class, 'statement'])->name('mystatement');

    Route::get('/ViewContributingMembers', [ContributionsController::class, 'viewcontributingMembers'])->name('viewcontributingMembers');
    Route::GET('/client/statement/{memberno}', [ContributionsController::class, 'tablestatement'])->name('singlememberstatement');

    Route::get('/GenerateStatement', [ContributionsController::class, 'Memberstatement'])->name('memberstatement');

    



    Route::get('/forms', [AdministrationController::class, 'form'])->name('dashoneform');
    Route::get('/Table', [AdministrationController::class, 'table'])->name('dashonetable');
    Route::get('/blank', [AdministrationController::class, 'home'])->name('dashoneblank');
    Route::get('/formtable', [AdministrationController::class, 'formtable'])->name('dashoneformtable');
});


Auth::routes();
// Route User
Route::middleware(['auth','user-role:user'])->group(function()
{
    Route::get("/home",[HomeController::class, 'userHome'])->name("home");
});
// Route Editor
Route::middleware(['auth','user-role:editor'])->group(function()
{
    Route::get("/editor/home",[HomeController::class, 'editorHome'])->name("editor.home");
});
// Route Admin
Route::middleware(['auth','user-role:admin'])->group(function()
{
    Route::get("/admin/home",[HomeController::class, 'adminHome'])->name("admin.home");
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
