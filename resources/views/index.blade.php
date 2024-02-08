{{-- 
<h1>The List of Tasks</h1>
<div>
    @if (count($tasks))
        <div>There Are Tasks!</div>
        @foreach ($tasks as $task)
            <div>
                @foreach ($task as $item)
                    <p>{{$item}}</p>
                @endforeach
            </div>
        @endforeach
    @else
        <div>No tasks yet.</div>
    @endif
</div> --}}

{{-- of simply use forelse --}}
@extends('layouts.app')
@section('title','Tasks List')


@section('content')

<nav class="mb-4">
    <a href="{{route('tasks.create')}}" class="link">Add Task</a>

</nav>
<ul class="list-disc list-outside ">
{{--in @class(['adding class name', setting  class in case => if the condition is true or false]) --}}
    @forelse ($tasks as $task)
        <div>
            
            <li><a href="{{route('tasks.show',['task'=>$task->id])}}" @class(['font-bold', 'line-through' => $task->completed])>
                {{ $task->title}}
            </a></li>
        </div>
    @empty
        <div>No tasks yet.</div>   {{-- this will be shown if the collection is empty --}}
    @endforelse
    
    @if ($tasks->count())
        <nav class="mt-4">
            {{$tasks->links()}}
        </nav>
    @endif
@endsection