@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<?php
    $statuses = \App\Models\TaskStatus::get();
    $users = \App\Models\User::all();
?>

<div class="flex flex-col">
    <div class="mt-2">
        {{ Form::label('name', 'Название') }}
    </div>

    <div class="mt-2">
        {{ Form::text('name') }}
    </div>

    <div class="mt-2">
        {{ Form::label('description', 'Содержание') }}
    </div>
    {{ Form::textarea('description') }}

    <div class="mt-2">
        {{ Form::label('status_id', 'Статус') }}
    </div>

    <select name="status_id" class="mb-5">
        @foreach($statuses as $status)
            <option value="{{ $status->id }}">
                {{ $status->id }} - {{ $status->name }}
            </option>
        @endforeach
    </select>

    <div class="mt-2">
        {{ Form::label('assigned_to_id', 'Исполнитель') }}
    </div>

    <select name="assigned_to_id" class="mb-5">
        <option value="">------</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">
                {{ $user->id }} - {{ $user->name }}
            </option>
        @endforeach
    </select>

    <div class="mt-2">
        {{ Form::label('labels', 'Метки') }}
    </div>

    <select name="labels[]" multiple class="mb-5 select is-multiple">
        <option value="">-------</option>
        @foreach($labels as $label)
            <option value="{{ $label->id }}">{{ $label->id }} - {{ $label->name }}</option>
        @endforeach
    </select>
</div>
