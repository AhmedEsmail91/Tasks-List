{{-- On otherhand the creation form we can use include to call this blade and reuse it using @include('form') and use
it in case of editing using @include too but also adding the valiables needed like the task variable in this example --}}

@extends('layouts.app')
@section('nav-main','Main Page')

{{--makeing a condition in case of using the form for the editing or creation --}}
@section('title',isset($task)? 'Edit Task':'Add Task') 

{{--
CSRF->cross-site request forgery: Cross-site request for (CSRF) is type of malicious exploit that allows a-party website toic a trusted user the target website.
relies on websites trusting requests made by authenticated users,
regardless of the source the request.
CSRF attacks can be carried out by tricking the source website into thinking its a legitimate request.
if i didn't put this directive in every single form i will get an error of value 419 error specificly.
--}}


@section('content')
{{-- {{$errors}} --}}
{{-- in case of submitting without filling the data fields we got the errors in preservered Error Variable and its value--}}

<form action="{{isset($task)?route('tasks.update',['task'=>$task->id]):route('tasks.store')}}" method="POST">
    @csrf
    {{-- if we are editing a task then we need to send a PUT or POST request --}}
    @if(isset($task))
        @method('PUT') {{--  for update  which is called data spoffing method--}}
    @endif
    <div class="mb-4">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" @class(['border-red-500' => $errors->has('title')])
        value="{{$task->title ?? old('title')}}"/>
        @error('title')
        <p class="error">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="description">Description</label>
        <textarea name="description" id="description" @class(['border-red-500' => $errors->has('description')]) rows="5">{{$task->description ??old('description')}}</textarea>
        @error('description')
        <p class="error ">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="long_description">Long Description</label>
        <textarea name="long_description" @class(['border-red-500' => $errors->has('long_description')]) id="long_description" rows="10">{{$task->long_description ??old('long_description')}}</textarea>
        @error('long_description')
        <p class="error ">{{$message}}</p>
        @enderror
    </div>
    <div class="flex gap-2 items-center">
        <a href="{{route('tasks.index')}}" class="link">Cancel</a>
        <button type="submit" class="btn">
            @isset($task)
            Update Task
            @else
            Add Task
            @endisset
        </button>
        
    </div>
</form>
@endsection