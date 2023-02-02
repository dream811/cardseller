<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    if(!Auth::check())
        return redirect('login');
    else if( Auth::check() && Auth::user()->isAdmin() == 1)
        return view('admin.user.list');
    else if( Auth::check() && Auth::user()->isPartner() == 1)
        return view('partner.user.list');
    else
        return redirect('/home');
});
// Route::group(['middleware' => ['guest']], function () {
//     Route::get('/', function () {
//         if()
//             return redirect('login');
//     });
// });
//Route::get('/',                                     [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');
Route::get('/resizeImage',                          [App\Http\Controllers\ImageController::class, 'resizeImage']);
Route::post('/resizeImagePost',                     [App\Http\Controllers\ImageController::class, 'resizeImagePost'])->name('resizeImagePost');
Route::post('/uploadImage',                         [App\Http\Controllers\ImageController::class, 'uploadImage'])->name('uploadImage');
Route::post('/uploadImages',                        [App\Http\Controllers\ImageController::class, 'uploadImages'])->name('uploadImages');
Route::post('/deleteImage',                         [App\Http\Controllers\ImageController::class, 'deleteImage'])->name('deleteImage');
Route::get('/bank_info',                            [App\Http\Controllers\User\UtilController::class, 'bank_info'])->name('bank_info');
Route::get('/generate',                             [App\Http\Controllers\User\UtilController::class, 'generate'])->name('generate');

Route::middleware('user')->name('user.')->group(
    function () {
        Route::get('/home',                         [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');
        /////////////////////////////** CREDIT **//////////////////////////////////
        Route::get('/credit',                       [App\Http\Controllers\User\CreditController::class, 'index'])->name('credit');
        Route::post('/credit/{type}',               [App\Http\Controllers\User\CreditController::class, 'save'])->name('credit.save');
        /////////////////////////////** CARD **//////////////////////////////////
        Route::get('/card',                         [App\Http\Controllers\User\CardController::class, 'index'])->name('card');
        Route::post('/card/{id}',                   [App\Http\Controllers\User\CardController::class, 'save'])->name('card.save');
        Route::get('/search_state/{id}',            [App\Http\Controllers\User\CardController::class, 'search_state'])->name('card.search_state');
        Route::get('/search_city/{id}',             [App\Http\Controllers\User\CardController::class, 'search_city'])->name('card.search_city');
        
        /////////////////////////////** MY CARD **///////////////////////////////
        Route::get('/my_card',                      [App\Http\Controllers\User\MyCardController::class, 'index'])->name('my_card');
        Route::post('/my_card/{id}',                [App\Http\Controllers\User\MyCardController::class, 'save'])->name('my_card.save');
        /////////////////////////////** GUIDE **//////////////////////////////////
        Route::get('/mypage',                       [App\Http\Controllers\User\UserController::class, 'mypage'])->name('mypage');
        Route::post('/check_password',              [App\Http\Controllers\User\UserController::class, 'check_password'])->name('check_password');
        Route::post('/change_password',             [App\Http\Controllers\User\UserController::class, 'change_password'])->name('change_password');
        Route::get('/user_info',                    [App\Http\Controllers\User\UserController::class, 'user_info'])->name('user_info');

        /////////////////////////////** CONTACT **//////////////////////////////////
        //NEWS
        Route::get('/notice',                       [App\Http\Controllers\User\NoticeController::class, 'index'])->name('notice');
        Route::get('/notice/{id}',                  [App\Http\Controllers\User\NoticeController::class, 'show'])->name('notice.edit');
        Route::post('/notice/{id}',                 [App\Http\Controllers\User\NoticeController::class, 'save'])->name('notice.save');
        Route::delete('/notice/{id}',               [App\Http\Controllers\User\NoticeController::class, 'delete'])->name('notice.delete');
        //QNA
        Route::get('/qna',                          [App\Http\Controllers\User\QNAController::class, 'index'])->name('qna');
        Route::get('/qna/{id}',                     [App\Http\Controllers\User\QNAController::class, 'show'])->name('qna.edit');
        Route::post('/qna/{id}',                    [App\Http\Controllers\User\QNAController::class, 'save'])->name('qna.save');
        Route::delete('/qna/{id}',                  [App\Http\Controllers\User\QNAController::class, 'delete'])->name('qna.delete');
        //FAQ
        Route::get('/faq',                          [App\Http\Controllers\User\FAQController::class, 'index'])->name('faq');
        Route::get('/faq/{id}',                     [App\Http\Controllers\User\FAQController::class, 'show'])->name('faq.edit');
        Route::post('/faq/{id}',                    [App\Http\Controllers\User\FAQController::class, 'save'])->name('faq.save');
        Route::delete('/faq/{id}',                  [App\Http\Controllers\User\FAQController::class, 'delete'])->name('faq.delete');
       

        
        
        //Raltime Info
        Route::get('/realtime_info',                [App\Http\Controllers\Partner\HomeController::class, 'realtime_info'])->name('realtime_info');
    }
);
Auth::routes();


Route::middleware('admin')->prefix('admin')->name('admin.')->group(
    function () {
        Route::get('/home',                         [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
        Route::get('/realtime_info',                [App\Http\Controllers\Admin\HomeController::class, 'realtime_info'])->name('realtime_info');
        Route::get('/mypage',                       [App\Http\Controllers\Admin\HomeController::class, 'mypage'])->name('mypage');
        Route::post('/check_password',              [App\Http\Controllers\Admin\HomeController::class, 'check_password'])->name('check_password');
        Route::post('/change_password',             [App\Http\Controllers\Admin\HomeController::class, 'change_password'])->name('change_password');
        //User
        Route::get('user/list',                     [App\Http\Controllers\Admin\User\UserController::class, 'index'])->name('user.list');
        Route::get('user/edit/{userId}',            [App\Http\Controllers\Admin\User\UserController::class, 'edit'])->name('user.edit');
        Route::post('user/edit/{userId}',           [App\Http\Controllers\Admin\User\UserController::class, 'save'])->name('user.save');
        Route::delete('user/edit/{userId}',         [App\Http\Controllers\Admin\User\UserController::class, 'delete'])->name('user.delete');
        Route::post('user/state/{userId}',          [App\Http\Controllers\Admin\User\UserController::class, 'state'])->name('user.state');
        Route::post('user/check',                   [App\Http\Controllers\Admin\User\UserController::class, 'check'])->name('user.check');
        //Credit
        Route::get('credit/list',                   [App\Http\Controllers\Admin\Credit\CreditController::class, 'index'])->name('credit.list');
        Route::post('credit/state/{id}',            [App\Http\Controllers\Admin\Credit\CreditController::class, 'state'])->name('credit.state');
        Route::get('credit/edit/{id}',              [App\Http\Controllers\Admin\Credit\CreditController::class, 'edit'])->name('credit.edit');
        Route::post('credit/edit/{id}',             [App\Http\Controllers\Admin\Credit\CreditController::class, 'save'])->name('credit.save');
        Route::delete('credit/edit/{id}',           [App\Http\Controllers\Admin\Credit\CreditController::class, 'delete'])->name('credit.delete');
        //Country
        Route::get('card/country_list',             [App\Http\Controllers\Admin\Card\CountryController::class, 'index'])->name('country.list');
        Route::post('card/country_state/{id}',      [App\Http\Controllers\Admin\Card\CountryController::class, 'state'])->name('country.state');
        Route::get('card/country_edit/{id}',        [App\Http\Controllers\Admin\Card\CountryController::class, 'edit'])->name('country.edit');
        Route::post('card/country_edit/{id}',       [App\Http\Controllers\Admin\Card\CountryController::class, 'save'])->name('country.save');
        Route::delete('card/country_edit/{id}',     [App\Http\Controllers\Admin\Card\CountryController::class, 'delete'])->name('country.delete');
        Route::get('card/search_state/{id}',        [App\Http\Controllers\Admin\Card\CardController::class, 'search_state'])->name('card.search_state');
        Route::get('card/search_city/{id}',         [App\Http\Controllers\Admin\Card\CardController::class, 'search_city'])->name('card.search_city');
        
        //State
        Route::get('card/state_list',               [App\Http\Controllers\Admin\Card\StateController::class, 'index'])->name('state.list');
        Route::post('card/state_state/{id}',        [App\Http\Controllers\Admin\Card\StateController::class, 'state'])->name('state.state');
        Route::get('card/state_edit/{id}',          [App\Http\Controllers\Admin\Card\StateController::class, 'edit'])->name('state.edit');
        Route::post('card/state_edit/{id}',         [App\Http\Controllers\Admin\Card\StateController::class, 'save'])->name('state.save');
        Route::delete('card/state_edit/{id}',       [App\Http\Controllers\Admin\Card\StateController::class, 'delete'])->name('state.delete');
        //City
        Route::get('card/city_list',                [App\Http\Controllers\Admin\Card\CoinController::class, 'index'])->name('city.list');
        Route::post('card/city_state/{id}',         [App\Http\Controllers\Admin\Card\CoinController::class, 'state'])->name('city.state');
        Route::get('card/city_edit/{id}',           [App\Http\Controllers\Admin\Card\CoinController::class, 'edit'])->name('city.edit');
        Route::post('card/city_edit/{id}',          [App\Http\Controllers\Admin\Card\CoinController::class, 'save'])->name('city.save');
        Route::post('card/city_edit/{id}',          [App\Http\Controllers\Admin\Card\CoinController::class, 'save'])->name('city.save');
        Route::delete('card/city_edit/{id}',        [App\Http\Controllers\Admin\Card\CoinController::class, 'delete'])->name('city.delete');
        //Type
        Route::get('card/type_list',                [App\Http\Controllers\Admin\Card\CoinController::class, 'index'])->name('type.list');
        Route::post('card/type_state/{id}',         [App\Http\Controllers\Admin\Card\CoinController::class, 'state'])->name('type.state');
        Route::get('card/type_edit/{id}',           [App\Http\Controllers\Admin\Card\CoinController::class, 'edit'])->name('type.edit');
        Route::post('card/type_edit/{id}',          [App\Http\Controllers\Admin\Card\CoinController::class, 'save'])->name('type.save');
        Route::delete('card/type_edit/{id}',        [App\Http\Controllers\Admin\Card\CoinController::class, 'delete'])->name('type.delete');
        //Card
        Route::get('card/list',                     [App\Http\Controllers\Admin\Card\CardController::class, 'index'])->name('card.list');
        Route::post('card/state/{id}',              [App\Http\Controllers\Admin\Card\CardController::class, 'state'])->name('card.state');
        Route::get('card/edit/{id}',                [App\Http\Controllers\Admin\Card\CardController::class, 'edit'])->name('card.edit');
        Route::post('card/edit/{id}',               [App\Http\Controllers\Admin\Card\CardController::class, 'save'])->name('card.save');
        Route::get('card/search_state',             [App\Http\Controllers\Admin\Card\CardController::class, 'search_state'])->name('card.search_state');
        Route::get('card/search_city',             [App\Http\Controllers\Admin\Card\CardController::class, 'search_city'])->name('card.search_city');
        //sell
        Route::get('calculate/sale',                [App\Http\Controllers\Admin\Calculate\SaleController::class, 'index'])->name('calculate.sale_list');
        Route::get('calculate/sale_edit/{id}',      [App\Http\Controllers\Admin\Calculate\SaleController::class, 'edit'])->name('calculate.sale_edit');
        Route::post('calculate/sale_edit/{id}',     [App\Http\Controllers\Admin\Calculate\SaleController::class, 'save'])->name('calculate.sale_save');
        Route::delete('calculate/sale_edit/{id}',   [App\Http\Controllers\Admin\Calculate\SaleController::class, 'delete'])->name('calculate.sale_delete');
        Route::post('calculate/sale_edit/{id}',     [App\Http\Controllers\Admin\Calculate\SaleController::class, 'state'])->name('calculate.sale_state');
        //qna
        Route::get('contact/qna',                   [App\Http\Controllers\Admin\Contact\QNAController::class, 'index'])->name('qna.list');
        Route::get('contact/acc_qna',               [App\Http\Controllers\Admin\Contact\QNAController::class, 'acc_index'])->name('qna.acc_list');
        Route::get('contact/qna/{id}',              [App\Http\Controllers\Admin\Contact\QNAController::class, 'show'])->name('qna.edit');
        Route::post('contact/qna/{id}',             [App\Http\Controllers\Admin\Contact\QNAController::class, 'save'])->name('qna.save');
        Route::delete('contact/qna/{id}',           [App\Http\Controllers\Admin\Contact\QNAController::class, 'delete'])->name('qna.delete');
        //notice
        Route::get('contact/notice',                [App\Http\Controllers\Admin\Contact\NoticeController::class, 'index'])->name('notice.list');
        Route::get('contact/notice/{id}',           [App\Http\Controllers\Admin\Contact\NoticeController::class, 'show'])->name('notice.edit');
        Route::post('contact/notice/{id}',          [App\Http\Controllers\Admin\Contact\NoticeController::class, 'save'])->name('notice.save');
        Route::delete('contact/notice/{id}',        [App\Http\Controllers\Admin\Contact\NoticeController::class, 'delete'])->name('notice.delete');
        //message
        Route::get('contact/msg',                   [App\Http\Controllers\Admin\Contact\MSGController::class, 'index'])->name('msg.list');
        Route::get('contact/msg/{id}',              [App\Http\Controllers\Admin\Contact\MSGController::class, 'show'])->name('msg.edit');
        Route::post('contact/msg/{id}',             [App\Http\Controllers\Admin\Contact\MSGController::class, 'save'])->name('msg.save');
        Route::delete('contact/msg/{id}',           [App\Http\Controllers\Admin\Contact\MSGController::class, 'delete'])->name('msg.delete');
        //faq
        Route::get('contact/faq',                   [App\Http\Controllers\Admin\Contact\FAQController::class, 'index'])->name('faq.list');
        Route::get('contact/faq/{id}',              [App\Http\Controllers\Admin\Contact\FAQController::class, 'show'])->name('faq.edit');
        Route::post('contact/faq/{id}',             [App\Http\Controllers\Admin\Contact\FAQController::class, 'save'])->name('faq.save');
        Route::delete('contact/faq/{id}',           [App\Http\Controllers\Admin\Contact\FAQController::class, 'delete'])->name('faq.delete');

        //payment api seeting
        Route::get('setting/bank',                 [App\Http\Controllers\Admin\Setting\SettingController::class, 'bank'])->name('setting.bank');
        Route::post('setting/bank',                [App\Http\Controllers\Admin\Setting\SettingController::class, 'saveBank'])->name('setting.bank');
    }
);
