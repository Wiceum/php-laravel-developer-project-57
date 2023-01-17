@extends('main_page')

@section('content')
    <div class="grid col-span-full">
        <h1 class="text-3xl mb-5">Изменение метки</h1>

        {{ Form::model($label, ['route' => ['labels.update', $label], 'method' => 'PATCH']) }}
            @include('labels.form')
            <x-button>Обновить</x-button>
        {{ Form::close() }}
    </div>
@endsection
