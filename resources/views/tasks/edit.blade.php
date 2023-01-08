@extends('main_page')

@section('content')
    <div class="grid col-span-full">
        <h1 class="text-3xl mb-5">Изменение задачи</h1>

        {{ Form::model($task, ['route' => ['tasks.update', $task], 'method' => 'PATCH']) }}
            @include('tasks.form')
            <x-button>Обновить</x-button>
        {{ Form::close() }}
    </div>
@endsection
