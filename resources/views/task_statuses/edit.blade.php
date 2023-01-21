@extends('main_page')

@section('content')
    <div class="grid col-span-full">
        <h1 class="text-3xl mb-5">{{__('Edit status')}}</h1>

        {{ Form::model($task_status, ['route' => ['task_statuses.update', $task_status], 'method' => 'PATCH']) }}
            @include('task_statuses.form')
            <x-button>{{__('Update')}}</x-button>
        {{ Form::close() }}
    </div>
@endsection
