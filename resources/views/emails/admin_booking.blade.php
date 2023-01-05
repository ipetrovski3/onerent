<p>You have recieved new reservation</p>


    <p>{{ $client->full_name() }}</p>
    <p>{{ $client->phone }}</p>
    <p>{{ $client->email }}</p>
    <p>{{ $client->country->name }}</p>
    <p>{{ $client->address }}</p>
    <p>{{ $client->personal_id}}</p>
    <hr>

    <p>{{ Carbon\Carbon::parse($booking->from_date)->format('d.m.Y') . "-" . $booking->pick_up_time . ' - ' . \Carbon\Carbon::parse($booking->to_date) }}</p>
    <p>{{ $booking->car->brand_and_model() . ' - ' . $booking->car->plate }}</p>

