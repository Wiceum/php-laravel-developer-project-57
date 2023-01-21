<div class="flex flex-col">
   {{ Form::label('name', __('Name')) }}
   <div class="mt-2 mb-4">
       {{ Form::text('name') }}
   </div>

   @error('name')
   <p class="text-rose-600">{{ __($message) }}</p>
   @enderror
</div>

