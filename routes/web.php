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

Auth::routes();

Route::get('/home', 'biltyController@show_home')->name('home');

Route::post('/login_check', [
    'uses'=> 'biltyController@login_check'
])->name('home');
Route::get('/logout', [
    'uses'=> 'biltyController@logout'
])->name('home');

Route::get('/create_bilty', [
    'uses'=> 'biltyController@builty_form'
])->name('home');

Route::post('/create_company_submit', [
    'uses'=> 'companyController@create'
])->name('home');
Route::post('/create_employee_submit', [
    'uses'=> 'employeeController@create'
])->name('home');
Route::post('/create_account_submit', [
    'uses'=> 'accountController@create'
])->name('home');
Route::post('/create_voucher_submit', [
    'uses'=> 'VoucherController@create'
])->name('home');
Route::post('/create_broker_submit', [
    'uses'=> 'brokerController@create'
])->name('home');
Route::post('/create_bilty_submit', [
    'uses'=> 'biltyController@create'
])->name('home');
Route::post('/search_bilty_company', [
    'uses'=> 'biltyController@search_company'
])->name('home');
Route::post('/search_bilty_month', [
    'uses'=> 'biltyController@search_month'
])->name('bilty_month');
Route::post('/search', [
    'uses'=> 'biltyController@search'
])->name('search');
Route::post('/search_ledger', [
    'uses'=> 'ledgerController@search'
])->name('search_ledger');
Route::post('/search_invoice', [
    'uses'=> 'invoiceController@search'
])->name('search_invoice');
Route::post('/search_bilty_broker', [
    'uses'=> 'biltyController@search_broker'
])->name('search_invoice');
Route::post('/search_bilty_company_reached', [
    'uses'=> 'biltyController@search_company_reached'
])->name('search_bilty_company_reached');
Route::post('/search_bilty_broker_reached', [
    'uses'=> 'biltyController@search_broker_reached'
])->name('search_bilty_broker_reached');
Route::get('/list_bilty', [
    'uses'=> 'biltyController@show'
])->name('list_bilty');
Route::get('/list_message', [
    'uses'=> 'contactController@show'
])->name('home');
Route::get('/list_voucher{id}', [
    'uses'=> 'VoucherController@show'
])->name('list_voucher');
Route::get('/list_ledger', [
    'uses'=> 'ledgerController@show'
])->name('ledger');
Route::get('/list_ledger_companies', [
    'uses'=> 'ledgerController@show_companies'
])->name('ledger_companies');
Route::get('/list_ledger_brokers', [
    'uses'=> 'ledgerController@show_brokers'
])->name('ledger_brokers');
Route::get('/home_chart_data', [
    'uses'=> 'ledgerController@pr_chart'
])->name('home');
Route::get('/list_ledger_employees', [
    'uses'=> 'ledgerController@show_employees'
])->name('ledger_employees');
Route::get('/list_invoices', [
    'uses'=> 'invoiceController@show'
])->name('list_invoices');
Route::get('/list_account', [
    'uses'=> 'accountController@show'
])->name('list_account');
Route::get('/list_employee', [
    'uses'=> 'employeeController@show'
])->name('list_employee');
Route::get('/list_invoices_received', [
    'uses'=> 'invoiceController@show_received'
])->name('invoices_received');
Route::get('/list_invoices_pending', [
    'uses'=> 'invoiceController@show_pending'
])->name('invoices_pending');
Route::get('/list_bilty_reached', [
    'uses'=> 'biltyController@show_reached'
])->name('bilty_reached');
Route::get('/list_bilty_unreached', [
    'uses'=> 'biltyController@show_unreached'
])->name('bilty_unreached');
Route::get('/list_bilty_invoiced', [
    'uses'=> 'biltyController@show_invoiced'
])->name('bilty_invoiced');
Route::get('/update_bilty{id}', [
    'uses'=> 'biltyController@update_form'
])->name('update_bilty');
Route::get('/view_bilty{id}', [
    'uses'=> 'biltyController@view'
])->name('view_bilty');
Route::get('/print_bilty{id}', [
    'uses'=> 'biltyController@print_bilty'
])->name('home');
Route::get('/print_voucher{id}', [
    'uses'=> 'VoucherController@print_voucher'
])->name('home');
Route::get('/update_company{id}', [
    'uses'=> 'companyController@update_form'
])->name('update_company');
Route::get('/update_employee{id}', [
    'uses'=> 'employeeController@update_form'
])->name('update_employee');
Route::get('/update_account{id}', [
    'uses'=> 'accountController@update_form'
])->name('update_account');
Route::get('/update_broker{id}', [
    'uses'=> 'brokerController@update_form'
])->name('update_broker');
Route::post('/update_bilty_submit', [
    'uses'=> 'biltyController@update'
])->name('update_bilty');
Route::post('/update_company_submit', [
    'uses'=> 'companyController@update'
])->name('update_company');
Route::post('/update_employee_submit', [
    'uses'=> 'employeeController@update'
])->name('update_employee');
Route::post('/update_account_submit', [
    'uses'=> 'accountController@update'
])->name('update_account');
Route::post('/update_broker_submit', [
    'uses'=> 'brokerController@update'
])->name('update_broker');
Route::get('/view_invoice{id}', [
    'uses'=> 'invoiceController@view'
])->name('view_invoice');
Route::get('/view_voucher{id}', [
    'uses'=> 'voucherController@view'
])->name('view_voucher');
Route::get('/print_invoice{id}', [
    'uses'=> 'invoiceController@print'
])->name('home');
Route::get('/delete_bilty{id}', [
    'uses'=> 'biltyController@delete'
])->name('home');

Route::get('/delete_company{id}', [
    'uses'=> 'companyController@delete'
])->name('home');
Route::get('/delete_broker{id}', [
    'uses'=> 'brokerController@delete'
])->name('delete_broker');
Route::get('/customer_bill{bilties}', [
    'uses'=> 'biltyController@customerbill'
])->name('customer_bill');
Route::post('/bilty_reached', [
    'uses'=> 'biltyController@reached'
])->name('bilty_reached');
Route::get('/return', [
    'uses'=> 'biltyController@ret'
])->name('return');
Route::post('/payment_received', [
    'uses'=> 'invoiceController@received'
])->name('payment_received');
Route::post('/bilty_invoice', [
    'uses'=> 'biltyController@selected_for_invoice'
])->name('home');
Route::post('/print_bill', [
    'uses'=> 'biltyController@print_bill'
])->name('print_bill');
Route::post('/print_ledger', [
    'uses'=> 'ledgerController@print_ledger'
])->name('print_ledger');

Route::get('/list_companies', [
    'uses'=> 'companyController@show'
])->name('companies');
Route::get('/list_brokers', [
    'uses'=> 'brokerController@show'
])->name('brokers');
Route::get('/create_company_form', function () {
    return view('create_company');
});
Route::get('/charts', function () {
    return view('charts');
});
Route::get('/create_voucher{id}', [
    'uses'=> 'VoucherController@show_form'
])->name('create_voucher');
Route::get('/main', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/services', function () {
    return view('services');
});
Route::post('/create_contact', [
    'uses'=> 'contactController@create'
])->name('create_contact');

