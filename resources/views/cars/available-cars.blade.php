@extends('layouts.app')

{{-- @section('content') --}}
    <!-- Button trigger modal -->

    {{-- @livewire('cars.available-cars', ['booking' => $booking, 'cars' => $cars, 'days' => $days]) --}}

@section('content')
    @livewire('bookings.book-car', ['booking' => $booking, 'cars' => $cars, 'days' => $days])
@endsection

{{-- @section('js')
    <script>
        $(document).on('click', '.book_car', function (e) {
            e.preventDefault()
            let summary = $(this).data('ppd')
            let car_model = $(this).data('car')
            let car_id = $(this).data('car_id')
            let days = "{{ $days }}"
            $('#car_model').text('Selected Vehicle: ' + car_model)
            $('#summary').text( 'Total Cost: ' + (parseInt(days) * parseInt(summary)) + '\u20AC')
            $('#car_id').val(car_id)
            $('#client_details').modal('show')
        })
    </script>
    <script>
        $(document).on('click', '#terms', function(){
            if($(this).is(':checked')){
                $('#confirm_reservation').attr('disabled', false)
            }else{
                $('#confirm_reservation').attr('disabled', true)
            }
        })
    </script> --}}
    {{-- <script>
        // disable submit button on form submit and loader mouse cursor
        $(document).on('submit', '#submit_form', function(){
            $('#confirm_reservation').attr('disabled', true)
            $('#confirm_reservation').text('Please wait...')
            $('#confirm_reservation').css('cursor', 'not-allowed')
        })
    </script> --}}
{{-- @endsection --}}
