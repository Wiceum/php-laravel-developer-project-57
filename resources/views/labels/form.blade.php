<div class="flex flex-col">
    {{ Form::label('name', __('Name')) }}

    <div class="mt-2 mb-4">
        {{ Form::text('name') }}
    </div>

    <div class="mt-2">
        {{ Form::label(__('Description')) }}
    </div>

    <div class="mt-2 mb-2">
        {{ Form::textarea('description') }}
    </div>

    @error('name')
    <p class="text-rose-600">{{ __($message) }}</p>
    @enderror
</div>
