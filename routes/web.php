<?php

use App\Http\Requests\TaskResquest;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function ()  {
    return view('index',[
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

Route::view('/tasks/create/','create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', 
    ['task' => $task
  ]);  

})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task) {
    return view('show', 
    ['task' => $task
  ]);  
})->name('tasks.show');
 

Route::post('/tasks', function (TaskResquest $request){
   $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Tarefa criada com sucesso!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskResquest $request){
    $task->update( $request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Tarefa editada com sucesso!');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task){
    $task->delete();
    return redirect()->route('tasks.index')
        ->with('success', 'Tarefa excluida com sucesso!');
})->name('tasks.destroy');

Route::put('/tasks/{task}/toogle-complete', function (Task $task){
   $task->toggleComplete();

    return redirect()->back()->with('success', 'Tarefa atualizada com sucesso');
})->name('tasks.toggle-complete');
Route::fallback(function(){
    return 'Não encontrada';
}); 