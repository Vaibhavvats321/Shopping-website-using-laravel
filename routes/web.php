<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;


// Admin Side Routes
Route::get('/admin',[AdminController::class,'index']);
Route::get('/adminProducts',[AdminController::class,'products']);
Route::post('/AddNewProduct',[AdminController::class,'AddNewProduct']);
Route::post('/UpdateProduct',[AdminController::class,'UpdateProduct']);
Route::get('/DeleteProduct/{id}',[AdminController::class,'DeleteProduct']);
Route::get('/changeUserStatus/{status}/{id}',[AdminController::class,'changeUserStatus']);
Route::get('/changeOrderStatus/{status}/{id}',[AdminController::class,'changeOrderStatus']);
Route::get('/adminProfile',[AdminController::class,'adminProfile']);
Route::get('/ourCustomers',[AdminController::class,'ourCustomers']);
Route::get('/ourOrders',[AdminController::class,'ourOrders']);



// Client Side Routes
Route::get('/',[MainController::class,'index']);
Route::get('/cart',[MainController::class,'cart']);
Route::get('/about',[MainController::class,'about']);
Route::get('/shop',[MainController::class,'shop']);
Route::get('/single/{id}',[MainController::class,'singleProduct']);
Route::get('/checkout',[MainController::class,'checkout']);
Route::get('/profile',[MainController::class,'profile']);
Route::get('/register',[MainController::class,'register']);
Route::get('/login',[MainController::class,'login']);
Route::get('/logout',[MainController::class,'logout']);
Route::get('/checkOut',[MainController::class,'checkOut']);
Route::post('/registerUser',[MainController::class,'registerUser']);
Route::post('/loginUser',[MainController::class,'loginUser']);
Route::post('/updateUser',[MainController::class,'updateUser']);
Route::post('/addToCart',[MainController::class,'addToCart']);
Route::post('/updateCart',[MainController::class,'updateCart']);
Route::get('/myOrders',[MainController::class,'myOrders']);
Route::get('/testMail',[MainController::class,'testMail']);
Route::get('/deleteCartItem/{id}',[MainController::class,'deleteCartItem']);



Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});
