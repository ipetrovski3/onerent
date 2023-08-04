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

<script src="{{asset('js/jquery.datetimepicker.full.js')}}"></script>
    <script>
        $(document).on('click', '.book_car', function (e) {
            e.preventDefault()
            let car_id = $(this).data('car_id')
            let summary = $(this).data('ppd')
            let car_model = $(this).data('car')
            let ppd = $(this).data('ppd')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('car_booked_days') }}",
                type: "POST",
                data: { car_id },
                success: function (data) {
                    let disabled_days = data
                    $('#from_date').datetimepicker({
                        disabledDates: disabled_days,
                        formatDate: 'Y-m-d'
                    });
                    $('#to_date').datetimepicker({
                        disabledDates: disabled_days,
                        formatDate: 'Y-m-d'
                    });

                    $('#car_model').text('Selected Vehicle: ' + car_model)
                    $('#summary').text(ppd)
                    $('#ppd').val(ppd)
                    $('#booking_id').val(booking_id)
                    $('#car_id').val(car_id)
                    $('#client_details').modal('show')
                }
            })
        })

        $(document).bind("change paste keyup", '.dates', function() {
            let from_date = new Date($('#from_date').val())
            let to_date = new Date($('#to_date').val())
            let ppd = $('#ppd').val()
            let days = (to_date.getTime() - from_date.getTime()) / (1000 * 3600 * 24)
            $('#summary').text( (parseInt(days) * parseInt(ppd)))
        })
    </script>
@endsection
