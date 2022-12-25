@extends('main_page')

@section('content')
    <div class="grid col col-span-full">
        <h1 class="mb-5" style="font-size: 3rem">Создать статус</h1>

        {{ Form::model($task_status,
                    ['route' =>  'task_statuses.store',
                    'method' => 'POST',
                    'class' => 'w-50',
                    ])
        }}
        {{ Form::token() }}
           <div class="flex flex-col">
               {{ Form::label('name', 'Имя') }}
               <div class="mt-2">
                   {{ Form::text('name') }}
               </div>

               @error('name')
               <p class="text-rose-600">{{ __($message) }}</p>
               @enderror
                <div class="mt-2">
                    <button type="submit"
                            class= "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-2 rounded"
                            >
                            {{ $slot }}
                    </button>
                </div>
           </div>
        {{ Form::close() }}
    </div>
@endsection
