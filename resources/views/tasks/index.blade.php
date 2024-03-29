@extends('main_page')

@section('content')
    <div class="grid col-span-full">
    <h1 class="text-3xl mb-5">{{__('Tasks')}}</h1>

    <div class="w-full flex items-center">

            <div>
                <x-filter></x-filter>
            </div>

            @auth()
            <div class="ml-auto">
                <x-link-as-button href="{{ route('tasks.create') }}">{{__('Create task')}}</x-link-as-button>
            </div>
            @endauth

    </div>


    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>{{__('Status')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Author')}}</th>
                <th>{{ __('Executor') }}</th>
                <th>{{ __('Creation date') }}</th>
                @auth()
                    <th>{{__('Actions')}}</th>
                @endauth
            </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr class="border-b border-dashed text-left">
                <td>{{ $task->id }}</td>
                <td>{{ $task->status->name }}</td>
                <td><a
                        class="text-blue-600 hover:bg-blue-900"
                        href="{{ route('tasks.show', ['task' => $task]) }}">
                        {{ $task->name }}
                    </a>
                </td>
                <td>{{ $task->author->name }}</td>
                <td>{{ $task->executor ? $task->executor->name : '' }}</td>
                <td>{{ $task->created_at->format('d.m.Y') }}</td>
                @auth()
                <td>
                    <a href="{{ route('tasks.edit', ['task' => $task]) }}"
                       class="text-blue-600"
                        >
                        {{__('Change')}}
                    </a>
                    @can('delete-tasks', $task)
                        <a href="{{ route('tasks.destroy', [$task]) }}"
                            data-confirm="Вы уверены?"
                            data-method="delete"
                            rel="nofollow"
                            class="text-red-600">
                            {{__('Delete')}}
                        </a>
                    @endcan
                </td>
                @endauth
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $tasks->links() }}
    </div>
    </div>
@endsection
