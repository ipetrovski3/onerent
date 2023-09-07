<div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Car</th>
            <th scope="col">Dates</th>
            <th scope="col">Pick</th>
            <th scope="col">Pick Location</th>
            <th scope="col">Drop Location</th>
            <th scope="col">Client</th>
            <th scope="col">Status</th>

        </tr>
        </thead>
        <tbody>
        @foreach($bookings as $booking)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $booking->car ? $booking->car->brand_and_model() : '/'  }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->from_date)->format('d.m.Y') . ' - ' . \Carbon\Carbon::parse($booking->to_date)->format('d.m.Y') }}</td>
                <td>{{ \Carbon\Carbon::parse(strtotime($booking->time_of_pick_up))->format('h:m') }}</td>
                <td>{{ $booking->pick_up->name  }}</td>
                <td>{{ $booking->drop_off->name  }}</td>
                <td>{{ $booking->client ? $booking->client->full_name() : '/'  }}</td>
                <td class="text-success">{{ $booking->statuses[$booking->status] }} </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    
    {{ $bookings->links() }}
</div>
