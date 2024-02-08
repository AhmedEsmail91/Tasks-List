
@extends('layouts.app')
@section('nav-main','Main Page')
@section('title',$task->title) {{-- in case of just replacing he data you don't have to set endsection just put it in the same calling of section as a second argument --}}
    
{{-- @endsection --}}

@section('content')
<div class="mb-4">
    <a href="{{route('tasks.index')}}"
    class="link">← Go back to the task list!</a>
</div>
<div>
    <p class="mb-4 text-slate-700">{{$task->description}}</p>
    <p class="mb-4 text-slate-700">{{$task->long_description ?? ''}}</p>
    <p class="mb-4 text-sm-500">Created {{$task->created_at->diffForHumans()}} • Updated {{$task->updated_at->diffForHumans()}}</p>
    <p class="mb-4">
        @if ($task->completed)
            <span class="font-medium text-green-500">Task Completed</span>
        @else
            <span class="font-medium text-red-500">Not Completed</span>
        @endif
    </p>
    <div class="flex gap-1">
        
            <a href="{{route('tasks.edit',['task'=>$task])}}"
                class="btn edit">
                Edit</a>
        
            <form action="{{route('tasks.toggle-complete',['task'=>$task])}}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn">Mark As {{$task->completed?'not completed':'completed'}}</button>
            </form>
        
            <form action="{{route('tasks.destroy',['task'=>$task])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn danger">Delete</button>
            </form>
        
    </div>
</div>

@endsection