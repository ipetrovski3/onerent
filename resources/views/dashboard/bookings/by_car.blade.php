@extends('adminlte::page')

@section('title', 'Cars')

@section('content_header')
    <h1>Bookings</h1>
@stop

@section('content')
    <div class="rescalendar" id="example"></div>
@endsection

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script>
        const eventData = [
            {
                id: 1,
                name: 'item1',
                startDate: '2022-07-05',
                endDate: '2022-07-16',
                customClass: 'customclass'
            },
            {
                id: 1,
                name: 'item1',
                startDate: '2022-07-16',
                endDate: '2022-07-22',
                customClass: 'customclassred'
            },
        ]

        $('#example').rescalendar({
            id: 'example',
            refDate: moment().format('YYYY-MM-DD'),

            data: eventData,
            dataKeyValues: ['item1', 'item2', 'item3']
        });
    </script>
@stop
