<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/getDataTable', 'dohWsdlController@getDataTable');
Route::get('/genInfoClassification', 'dohWsdlController@genInfoClassification');
Route::get('/genInfoQualityManagement/{code}', 'dohWsdlController@genInfoQualityManagement');
Route::get('/genInfoBedCapacity', 'dohWsdlController@genInfoBedCapacity');
Route::get('/hospOptSummaryOfPatients', 'dohWsdlController@hospOptSummaryOfPatients');
Route::get('/hospOptDischargesSpecialty', 'dohWsdlController@hospOptDischargesSpecialty');
Route::get('/hospOptDischargesMorbidity', 'dohWsdlController@hospOptDischargesMorbidity');
Route::get('/hospOptDischargesNumberDeliveries', 'dohWsdlController@hospOptDischargesNumberDeliveries');
Route::get('/hospOptDischargesOPV/{code}', 'dohWsdlController@hospOptDischargesOPV');
Route::get('/hospOptDischargesOPD', 'dohWsdlController@hospOptDischargesOPD');
Route::get('/hospOptDischargesER', 'dohWsdlController@hospOptDischargesER');
Route::get('/hospOptDischargesEV/{code}', 'dohWsdlController@hospOptDischargesEV');
Route::get('/hospitalOperationsDeaths/{code}', 'dohWsdlController@hospitalOperationsDeaths');
Route::get('/hospitalOperationsMortalityDeaths', 'dohWsdlController@hospitalOperationsMortalityDeaths');
Route::get('/hospitalOperationsHAI/{code}', 'dohWsdlController@hospitalOperationsHAI');
Route::get('/hospitalOperationsMajorOpt/{code}', 'dohWsdlController@hospitalOperationsMajorOpt');
Route::get('/hospitalOperationsMinorOpt/{code}', 'dohWsdlController@hospitalOperationsMinorOpt');
Route::get('/staffingPattern/{code}', 'dohWsdlController@staffingPattern');
Route::get('/staffingPatternOthers/{code}', 'dohWsdlController@staffingPatternOthers');
Route::get('/expenses/{code}', 'dohWsdlController@expenses');
Route::get('/revenues/{code}', 'dohWsdlController@revenues');
Route::get('/submittedReports/{code}', 'dohWsdlController@submittedReports');
Route::get('/createNEHEHRSVaccount', 'dohWsdlController@createNEHEHRSVaccount');
