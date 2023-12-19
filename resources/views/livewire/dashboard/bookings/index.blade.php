<div x-data="{ showModal: false }" x-cloak>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Car</th>
                <th scope="col">Dates</th>
                <th scope="col">Pick</th>
                <th scope="col">Pick Location</th>
                <th scope="col">Drop</th>
                <th scope="col">Drop Location</th>
                <th scope="col">Client</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $booking->car ? $booking->car->brand_and_model() : '/'  }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->from_date)->format('d.m.Y') . ' - ' . \Carbon\Carbon::parse($booking->to_date)->format('d.m.Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->time_of_pick_up)->format('H:i') }}</td>
                    <td>{{ $booking->pick_up->name  }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->time_of_drop_off)->format('H:i') }}</td>
                    <td>{{ $booking->drop_off->name  }}</td>
                    <td>{{ $booking->client ? $booking->client->full_name() : '/'  }}</td>
                    <td class="text-success">{{ $booking->statuses[$booking->status] }}</td>
                    <td>
                        <button wire:click="getBookingId({{ $booking->id }})" @click="showModal = true" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $bookings->links() }}

    <div x-show="showModal" class="fixed inset-0 z-10 overflow-y-auto">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBookingModalLabel">Delete Booking</h5>
                    <button type="button" class="close" @click="showModal = false" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-lg font-bold mb-4">Are you sure you want to delete this booking?</p>
                </div>
                <div class="modal-footer">
                    <button wire:click="deleteBooking" @click="showModal = false" class="btn btn-danger">Yes, delete</button>
                    <button @click="showModal = false" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
