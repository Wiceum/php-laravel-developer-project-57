@extends('main_page')

@section('content')
<div class="grid col-span-full">
    <h1 class="mb-5" style="font-size: 3rem">{{__('Statuses')}}</h1>
    @auth()
        <div>
            <a href="{{ route('task_statuses.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                {{ __('Create status') }}
            </a>
        </div>
    @endauth
    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Creation date')}}</th>
                @auth()
                    <th>{{__('Actions')}}</th>
                @endauth
            </tr>
        </thead>
        <tbody>
        @foreach($statuses as $status)
            <tr class="border-b border-dashed text-left">
                <td>
                    {{ $status->id }}
                </td>
                <td>
                    {{ $status->name }}
                </td>
                <td>
                    {{ $status->created_at->format('d.m.Y') }}
                </td>
                @auth()
                    <td>
                        <a href="{{ route('task_statuses.destroy', ['task_status' => $status]) }}"
                           data-confirm="Вы уверены?"
                           data-method="delete"
                           rel="nofollow"
                           class="text-red-600 hover:text-red-900"> {{__('Delete')}} </a>
                        <a href="{{ route('task_statuses.edit', ['task_status' => $status]) }}"
                            class="text-blue-600 hover:text-gray-900"> {{__('Change')}} </a>
                    </td>
                @endauth
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
