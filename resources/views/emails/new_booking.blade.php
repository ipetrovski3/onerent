<p>{{ $message_one }}</p>
<p>{{ $message_two }}</p>

@if(isset($client))
    <p>{{ $client->full_name() }}</p>
    <p>{{ $client->phone }}</p>
    <p>{{ Carbon\Carbon::parse($booking->from_date)->format('d.m.Y') . "-" . $booking->pick_up_time . ' - ' . \Carbon\Carbon::parse($booking->to_date) }}</p>
    <p>{{ $booking->car->brand_and_model() . ' - ' . $booking->car->plate }}</p>
@endif
