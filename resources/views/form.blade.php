@extends('layouts.app')

@section('title', isset($task) ? 'Editar Tarefa' : 'Adiocionar Tarefa')

@section('styles')
  
@endsection

@section( 'content')
    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]): route('tasks.store')}}">
        @csrf 
        @isset($task)
            @method('PUT')
        @endisset
        <div class="mb-4">
            <label for="title">
                Titulo
            </label>
            <input type="text" name="title" id="title" 
            @class(['border-red-500'=> $errors->has('title')])
            value="{{ $task->title ?? old('title')}}"/>
            @error('title')
                <p class="error"> {{$message}} </p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description">
                Descricao
            </label>
            <textarea name="description" id="description" 
            @class(['border-red-500'=> $errors->has('description')])
            rows="5">{{$task->description ?? old('description')}}</textarea>
            @error('description')
                <p class="error"> {{$message}} </p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="long_description">
                Descricao Longa
            </label>
            <textarea name="long_description" id="long_description" 
            @class(['border-red-500'=> $errors->has('long_description')])
            rows="10">{{$task->long_description ?? old('long_description')}}</textarea>
            @error('long_description')
                <p class="error"> {{$message}} </p>
            @enderror
        </div>

        <div class='flex items-center gap-2 '>
            <button type="submit" class="btn">
                @isset($task)
                    Editar Task
                @else 
                Adicionar Task
                @endisset
            </button>
            <a href="{{route('tasks.index')}}" class="link">Cancelar</a>
        </div>
    </form>
@endsection 