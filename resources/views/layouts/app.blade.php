<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- CDN Content Delivery Netwok --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    {{-- blade-formatter-disable --}}
    <style type="text/tailwindcss">
        .btn{
            @apply rounded-xl px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/10 hover:bg-green-100 text-slate-500/90
        }
        .danger{
            @apply hover:bg-red-100
        }
        .edit{
            @apply hover:bg-blue-100
        }
        .link{
            @apply font-medium text-gray-700 underline decoration-pink-500
        }
        label{
            @apply block uppercase text-slate-700 mb-2
        }
        input,
        textarea{
            @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none 
        } 
        .error{
            @apply text-red-500 text-sm
        }
    </style>
    {{-- blade-formatter-disable --}}
    <title>Laravel 10 Task List App</title>
    @yield('styles')
</head>

<body class="container mx-auto mt-10 mb-10 max-w-lg">

    {{-- <a href="{{route('tasks.index')}}">@yield('nav-main')</a> --}}

    <h1 class="text-4xl mb-4 font-bold text-sky-500/100">@yield('title')</h1>
    

    
    <div x-data="{ flash: true }">
        {{-- {flash massages--> disappear once refresh the page} incase of finding the variable success this means that the data in saved in the data base
            in this case display its value Note-->(we can access the indexes of the session with the method [has] while the session here is an object)
            and can access the value of each variable using the index of it inside the brackets--}}
        @if (session()->has('created')) 
            <div x-show="flash"
            class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700"
            role="alert">
                <strong class="font-bold">Success!</strong>
                <div>{{session('created')}}</div>
                {{-- Cross sign to close --}}
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" @click="flash = false" {{-- adding click in case on press on make flash value become false --}}
                        stroke="currentColor" class="h-6 w-6 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>
            
        @endif
        @yield('content')
    </div>
</body>
</html>