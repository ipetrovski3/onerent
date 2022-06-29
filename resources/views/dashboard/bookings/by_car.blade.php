@extends('adminlte::page')

@section('title', 'Cars')

@section('content_header')
    <h1>Bookings</h1>
@stop

@section('content')
    <style>
        div.scrollmenu {
            background-color: white;
            overflow: auto;
            white-space: nowrap;
        }

        div.scrollmenu a {
            display: inline-block;
            color: black;
            text-align: center;
            padding: 2px;
            text-decoration: none;
        }

        div.scrollmenu a:hover {
            background-color: #777;
        }

             /* Tooltip container */
         .tooltip {
             position: relative;
             display: inline-block;
             border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
         }

        /* Tooltip text */
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;

            /* Position the tooltip text - see examples below! */
            position: absolute;
            z-index: 1;
        }

        /* Show the tooltip text when you mouse over the tooltip container */
        .tooltip:hover .tooltiptext {
            visibility: visible;
        }
    </style>
    <div class="scrollmenu">
    <table class="table" style="text-align: center">
        {{-- @php
        $start = \Carbon\Carbon::now()->startOfWeek();
        $end = \Carbon\Carbon::now()->endOfWeek();
        $startDate = \Carbon\Carbon::createFromFormat('Y-m-d','2019-10-01');
        $endDate = \Carbon\Carbon::createFromFormat('Y-m-d','2019-10-30');
        // $check = \Carbon\Carbon::now()->between($startDate,$endDate);
        $check = \Carbon\Carbon::now();

        if ($check->between($start, $end)) {
          echo 'OK';
        }
        echo $end;
    @endphp --}}

        <a href="#">
            <---Previous</a>
        <--- @php $month=\Carbon\Carbon::now(); echo $month->format('F');
        @endphp
        --->
        <a href="#">Next---></a>

        <thead>
        <tr>
            <th><span>Cars</span></th>
            <th><span>Plate</span></th>
            @php
                // $month = \Carbon\Carbon::now();
                $start = \Carbon\Carbon::now();
                // $start = \Carbon\Carbon::parse($month)->startOfMonth();
                $end = \Carbon\Carbon::now()->add(1,'month');

            @endphp
            @while ($start->lte($end))
                @php
                    $dates = $start->copy();
                    $start->addDay();
                    echo "<th><span>";
                            echo substr(\Carbon\Carbon::parse($dates)->dayName, 0, 1);
                            echo "</span></th>";
                @endphp
                <th><span></span></th>
                {{-- <td class="mc" valign="top"><span id="p0">{{\Carbon\Carbon::parse($dates)->format('d') }}</span></td> --}}
            @endwhile
        </tr>
        </thead>
        <tbody>
{{--        {{ dd($cars) }}--}}
        @foreach ($cars as $car)
            <tr>
                <td>{{ $car->brand_and_model() }}</td>
                <td>{{ $car->plate }}</td>
                @php
                    $month = \Carbon\Carbon::now();
                    $start = \Carbon\Carbon::now();
                    // $start = \Carbon\Carbon::parse($month)->startOfMonth();
                    $end = \Carbon\Carbon::now()->add(1,'month');
                @endphp
                @while ($start->lte($end))
                    @php
                        $dates = $start->copy();
                        $start->addDay();

                    @endphp

                    <td>
                        <a href="#" class="btn" onclick="openModal()">
                            @php
                            $car_booked_start = \Carbon\Carbon::parse($car->bookings->from_date)->format('Y-m-d');
                            $car_booked_end = \Carbon\Carbon::parse($car->bookings->to_date)->format('Y-m-d');
                            $date = \Carbon\Carbon::parse($dates)->format('Y-m-d');
                            @endphp
                            @if($car_booked_start <= $date && $car_booked_end >= $date)
                                <span  id="p0" title="{{ $car }}" class="text-success">{{\Carbon\Carbon::parse($dates)->format('d') }}</span>
                            @else
                                <span id="p0" class="">{{\Carbon\Carbon::parse($dates)->format('d') }}</span>
                            @endif
                        </a>
                    </td>
                    <td>
                        <span id="p0"></span>
                    </td>
                @endwhile
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
