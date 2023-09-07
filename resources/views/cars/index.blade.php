@extends('layouts.app')

@section('content')
    @livewire('cars.index')
@endsection

@section('js')
<!-- Register the listeners -->
{{-- @push('scripts') --}}
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('formConfirmed', () => {
            $('#confirmModal').modal('hide');
            // TODO: Handle form confirmation success event
        });
    })
</script>
{{-- @endpush --}}
    
@endsection
