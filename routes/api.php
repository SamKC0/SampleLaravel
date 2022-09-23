<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Project;
use App\Models\Task;
use App\Models\Member;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('projectsList', function() {
    return Project::with('Task.Member')->get();
});

Route::get('projects', function(Request $request) {

    $name = request('name');

    $projects = Project::with('Task.Member')
    ->where('projects.project_name', '=', $name)
    ->get();

    return $projects;
});

Route::get('user', function() {

    $userDetails = Project::with('Task.Member')
    ->whereHas('Task.member', function($query) {
        $query->where('member_name', request('user'));
   })->get();
    return $userDetails;

});
