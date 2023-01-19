@extends('main_page')

@section('content')
<div class="grid col-span-full">
    <h2 class="mb-5 text-3xl">Просмотр задачи: {{ $task->name }} <a href="{{ route('tasks.edit', [$task]) }}">⚙</a></h2>
    <p>
        <span class="font-black">{{__('Name')}}: </span>
        {{ $task->name }}
    </p>
    <p>
        <span class="font-black">{{__('Status')}}: </span>
        {{ $task->status->name }}
    </p>
    <p>
        <span class="font-black">{{__('Description')}}: </span>
        {{ $task->description }}
    </p>
    <p>
        <span class="font-black">{{__('Labels')}}:</span>
    </p>
    <div>
        @foreach($task->labels as $label)
            <div class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full">
                {{ $label->name }}
            </div>
        @endforeach
    </div>
</div>

@endsection
