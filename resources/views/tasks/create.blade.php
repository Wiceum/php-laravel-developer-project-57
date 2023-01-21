@extends('main_page')

@section('content')
    <div class="grid col-span-full">
        <h1 class="text-3xl mb-5">{{__('Create task')}}</h1>

        {{ Form::model($task, ['route' => 'tasks.store']) }}
            {{ Form::hidden('created_by_id', Auth::id()) }}
            @include('tasks.form')
            <x-button>{{__('Create')}}</x-button>
        {{ Form::close() }}
    </div>
@endsection

