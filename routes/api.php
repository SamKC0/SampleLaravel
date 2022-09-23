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

    // $projects = DB::table('projects')
    // ->join('tasks', 'projects.id', '=', 'tasks.project_id')
    // ->join('member_task', 'tasks.id', '=', 'member_task.task_id')
    // ->join('members', 'members.id', '=', 'member_task.member_id')
    // ->where('projects.project_name', '=', $name)
    // ->get();

    $projects = Project::with('Task.Member')
    ->where('projects.project_name', '=', $name)
    ->get();

    return $projects;
});

Route::get('user', function() {

    $userName = request('user');


    // $userDetail = \DB::select('select * from tasks t inner join projects p 
    // on t.project_id = p.id ;');

    // $userDetail = DB::table('tasks')
    // ->join('projects', 'tasks.project_id', '=', 'projects.id')
    // ->join('members', 'tasks.member_id', '=', 'members.id')
    // ->where('members.member_name', '=', $userName)
    // ->get();
    // return $userDetail;


//     $userDetails = Task::with('member')
//     ->join('projects', 'tasks.project_id', '=', 'projects.id')
//     ->whereHas('member', function($query) {
//         $query->where('member_name', 'joe');
//    })->get();


    $userDetails = Project::with('Task.Member')
    ->whereHas('Task.member', function($query) {
        $query->where('member_name', request('user'));
   })->get();
    return $userDetails;

});
