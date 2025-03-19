@extends ('layouts.app')
@section('title',$task->title)
@section('content')
<div class="mb-4">
    <a href="{{route('tasks.index')}}" class="link"> ⬅︎ Voltar a Lista de Tarefas</a>
</div>

<p class="mb-4 text-slate-700">{{$task->description}}</p>

@if($task->long_description)
    <p class="mb-4 text-slate-700">{{$task->long_description}}</p>
@endif

<p class="mb-4 text-sm text-slate-500">Criado: {{$task->created_at->diffForHumans()}}  •  Atualizado: {{$task->updated_at->diffForHumans()}}</p>

<p  class="mb-4">
    @if($task->completed)
        <span class="font-medium text-green-500">Finalizada</span>

    @else
        <span class="font-medium text-red-500">Não Finalizada</span>
    @endif
</p>
<div class="flex gap-2">
    <a href="{{ route('tasks.edit', ['task'=> $task])}}"
    class="btn">Editar</a>
    <form method="POST" action="{{route('tasks.toggle-complete',['task'=>$task])}}">
        @csrf
        @method('PUT')
        <button type="submit" class="btn">
            {{$task->completed = 'Situação'}}
        </button>
    </form>
    <form action="{{ route('tasks.destroy', ['task'=> $task]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn">Excluir</button>
    </form>
</div>
@endsection