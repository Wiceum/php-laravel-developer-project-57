@extends('main_page')

@section('content')
    <div class="grid col-span-full">
        <h1 class="text-3xl mb-5">Метки</h1>

        <div class="w-full flex items-center">
            @auth()
                        <x-link-as-button href="{{ route('labels.create') }}">{{__('Create label')}}</x-link-as-button>
            @endauth
        </div>

        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Description')}}</th>
                <th>{{ __('Creation date') }}</th>
            @auth()
                    <th>{{__('Actions')}}</th>
                @endauth
            </tr>
            </thead>
            <tbody>
            @foreach($labels as $label)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $label->id }}</td>
                    <td>{{ $label->name }}</td>
                    <td>{{ $label->description }}</td>
                    <td>{{ $label->created_at }}</td>
                    @auth()
                        <td>
                            <a href="{{ route('labels.edit', ['label' => $label]) }}"
                               class="text-blue-600"
                            >
                                {{__('Change')}}
                            </a>

                            <a href="{{route('labels.destroy', [$label])}}"
                               data-confirm="Вы уверены?"
                               data-method="delete"
                               rel="nofollow"
                               class="text-red-600">
                                {{__('Delete')}}
                            </a>
                        </td>
                    @endauth
                </tr>
            @endforeach
            </tbody>
        </table>

        <div>
            <nav></nav>
        </div>
    </div>
@endsection
