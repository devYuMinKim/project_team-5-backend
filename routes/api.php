<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TeammatesController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LocalSemesterController;
use App\Http\Controllers\LocalSemesterCommentsController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

// Register User
Route::post('/register', [UserController::class, 'register']);
// Login User
Route::post('/login', [UserController::class, 'login']);
// Logout User
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);  // the auth:sanctum middleware is added to the /logout route to ensure that the user is authenticated before being able to log out.


// Get Entire List of Restaurants
Route::get('/restaurants', [RestaurantController::class, 'index']);
// Get Specific Restaurant
Route::get('/restaurants/{id}', [RestaurantController::class, 'getStoreById']);
Route::post('/restaurants', [RestaurantController::class, 'store']);
Route::put('/restaurants/{id}', [RestaurantController::class, 'update']);
Route::delete('/restaurants/{id}', [RestaurantController::class, 'destroy']);

// Add Review
Route::post('/review', [ReviewController::class, 'addReview']);
// Delete Review
Route::delete('/review/{id}', [ReviewController::class, 'deleteReview']);
// Get Review(for edit)
Route::get('/review/{id}', [ReviewController::class, 'getReviewById']);
// Edit Review
Route::put('/review', [ReviewController::class, 'editReview']);

// Teammates
Route::get('/teammates', [TeammateController::class, 'index']);
Route::get('/teammates/{id}', [TeammateController::class, 'show']);
Route::post('/teammates', [TeammateController::class, 'store']);
Route::put('/teammates/{id}', [TeammateController::class, 'update']);
Route::delete('/teammates/{id}', [TeammateController::class, 'destroy']);

// Community
Route::get('/community/posts/{id}', [CommunityController::class, 'show'])->name('community.posts.show');
Route::middleware(['auth'])->group(function() {
  Route::resource('community', CommunityController::class);
});

// Comment
Route::resource('comment', CommentController::class);
// Route::group(['middleware' => 'auth'], function () {
//   Route::post('/community/{community}/comment', 'CommentController@store')->name('comment.store');
//   Route::put('/comment/{comment}', 'CommentController@update')->name('comment.update');
//   Route::delete('/comment/{comment}', 'CommentController@destroy')->name('comment.destroy');
// });

Route::get('/comment/{comment}', 'CommentController@show')->name('comment.show');

// Get LocalSemester Article  
Route::get('/localsemester', [LocalSemesterController::class, 'getArticle']);
// Edit LocalSemester Article
Route::put('/localsemester', [LocalSemesterController::class, 'editArticle']);

// Get LocalSemester Comments  
Route::get('/localsemestercomments', [LocalSemesterCommentsController::class, 'getComments']);
// post LocalSemester Comment
Route::post('/localsemestercomments', [LocalSemesterCommentsController::class, 'addComment']);
// edit LocalSemester Comment
Route::put('/localsemestercomments', [LocalSemesterCommentsController::class, 'editComment']);
// delete LocalSemester Comment
Route::delete('/localsemestercomments/{id}', [LocalSemesterCommentsController::class, 'deleteComment']);