{{ Form::open(['url' => [route('tasks.index')], 'method' => 'GET']) }}
    <div class="flex w-full">

        <div>
            <select class="rounded border-gray-300" name="filter[status_id]">
                <option value="" selected>{{__('Status')}}</option>
                @foreach(\App\Models\TaskStatus::all() as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <select class="ml-2 rounded border-gray-300" name="filter[created_by_id]">
                <option value="" selected>{{__('Author')}}</option>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <select class="ml-2 rounded border-gray-300" name="filter[assigned_to_id]">
                <option value="" selected>{{__('Executor')}}</option>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="ml-2">
            <x-button>{{__('Apply')}}</x-button>
        </div>

    </div>
{{ Form::close() }}
