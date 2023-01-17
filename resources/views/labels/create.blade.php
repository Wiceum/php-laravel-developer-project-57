@extends('main_page')

@section('content')
    <div class="grid col col-span-full">
        <h1 class="mb-5" style="font-size: 3rem">{{__('Create a label')}}</h1>
        {{ Form::model($label, ['route' =>  'labels.store', 'method' => 'POST'])}}
            @include('labels.form')
            <div class="mt-2">
                <x-button>{{__('Create')}}</x-button>
            </div>
        {{ Form::close() }}
    </div>
@endsection
