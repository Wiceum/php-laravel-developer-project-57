@extends('main_page')

@section('content')
<div class="grid col-span-full">
    <h1 class="mb-5" style="font-size: 3rem">Статусы</h1>
    @auth()
        <div>
            <a href="{{ route('task_statuses.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Создать статус
            </a>
        </div>
    @endauth
    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Дата создания</th>
                @auth()
                    <th>Действия</th>
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
                        <a data-confirm="Вы уверены?"
                            href="{{ route('task_statuses.destroy', ['task_status' => $status]) }}"
                           class="text-red-600 hover:text-red-900"> Удалить </a>
                        <a href="{{ route('task_statuses.edit', ['task_status' => $status]) }}"
                            class="text-blue-600 hover:text-gray-900"> Изменить </a>
                    </td>
                @endauth
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
