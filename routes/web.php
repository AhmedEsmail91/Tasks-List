<?php
use Illuminate\Http\Response;
use Illuminate\Http\Request; //to read thetitl data from the form fields
use App\Http\Requests\TaskRequest; //to read thetitl data from the form fields
use Illuminate\Support\Facades\Route;
use \App\Models\Task;
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

//Handling Not Found Pages
Route::fallback(function(){
    return 'Still Got Somewhere!!!';
});

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    $get_latest_record=Task::latest()->paginate(20);
    // $get_latest_record=Task::reorder('updated_at','desc')->paginate(20);
    return view('index',['tasks'=>$get_latest_record]);
})->name('tasks.index');

//showing a single task creating page
Route::view('/tasks/create', 'create')->name('tasks.create');


// fetch data from database instead  of using an array
Route::get('/tasks/{task}', function (Task $task){
    return view('show', [
        'task'=>$task
    ]);
})->name('tasks.show');


Route::get('/tasks/{task}/edit', function (Task $task){
    return view('edit', [
        'task'=>$task
    ]);
})->name('tasks.edit');


//return to the show page of the recently created task once it is created in the database
Route::post('/tasks', function (TaskRequest $request) {
    // this Task::create(['column'=>'value']) so once the $request->validated() --> returns an array so we can use it 
    $task=Task::create($request->validated());
    //in case of adding the data make variable in session array carries a spcific value
    return redirect()->route('tasks.show',['task'=>$task->id])->with('created','Task created successfully!');
})->name('tasks.store');





///////////////////////making the edit///////////////////////////
Route::put('/tasks/{task}', function (Task $task,TaskRequest $request) {
    $task->update($request->validated());
    //in case of adding the data make variable in session array carries a spcific value (in the following line of code)
    return redirect()->route('tasks.show',['task'=>$task->id])->with('updated','Task updated successfully!'); 
})->name('tasks.update');

Route::delete('/tasks/{task}',function(Task $task){
    $task->delete();
   //redirect back with message that the task has been deleted
    return redirect()->route('tasks.index')->with('deleted','The Task has been Deleted Successfully!');
})->name('tasks.destroy');




Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();
    
    return redirect()->back()->with('success','Task Updated Successfully');
})->name('tasks.toggle-complete');
