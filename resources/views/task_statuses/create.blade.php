@extends('main_page')

@section('content')
    <div class="grid col col-span-full">
        <h1 class="mb-5" style="font-size: 3rem">{{__('Create status')}}</h1>
        {{ Form::model($task_status, ['route' =>  'task_statuses.store', 'method' => 'POST'])}}
            @include('task_statuses.form')
            <x-button>{{__('Create')}}</x-button>
        {{ Form::close() }}
    </div>
@endsection
