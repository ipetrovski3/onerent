<div>
    <div class="flex justify-between mb-4">
        <button wire:click="previousMonth" class="bg-gray-300 hover:bg-gray-400 px-3 py-1 rounded">
            Previous Month
        </button>
        <div>
            <label for="selectMonth">Select Month:</label>
            <select wire:model.defer="selectedMonth" id="selectMonth" class="bg-gray-100 border rounded p-1">
                @for ($month = 1; $month <= 12; $month++)
                    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                @endfor
            </select>
            <label for="selectYear">Select Year:</label>
            <select wire:model.defer="selectedYear" id="selectYear" class="bg-gray-100 border rounded p-1">
                @for ($year = date('Y') - 5; $year <= date('Y') + 5; $year++)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>
            <button wire:click="updateSelectedMonth" class="bg-gray-300 hover:bg-gray-400 px-3 py-1 rounded">
                Go
            </button>            
        </div>
        <button wire:click="nextMonth" class="bg-gray-300 hover:bg-gray-400 px-3 py-1 rounded">
            Next Month
        </button>
    </div>

    <h1 class="text-center font-bold">{{ $months[$selectedMonth] }} {{ $selectedYear }}</h1>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-300">
                <th class="p-2">Car Model</th>
                @for ($day = 1; $day <= $daysInMonth; $day++)
                    <th class="p-2 date-cell">
                        {{ $day }} <br> {{ date('D', strtotime($selectedYear . '-' . $selectedMonth . '-' . $day)) }}
                    </th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr class="border-b">
                    <td class="p-2">{{ $car['model'] }}</td>
                    @foreach ($car['availability'] as $availability)
                    @if ($availability['availability'] === 'green')
                    <td wire:click="bookCar({{ $car['id'] }})" class="cursor-pointer calendar-cell relative
                    @else
                    <td wire:click="editBooking({{ $availability['bookingId'] }})" class="cursor-pointer calendar-cell relative
                    @endif
                        {{ $availability['availability'] === 'green' ? 'bg-green-400' : '' }}
                        {{ $availability['availability'] === 'from' ? 'bg-diagonal-line-from' : '' }}
                        {{ $availability['availability'] === 'to' ? 'bg-diagonal-line-to' : '' }}
                        {{ $availability['availability'] ==='change' ? 'bg-diagonal-line-change' : '' }}
                        {{ $availability['availability'] === 'red' ? 'bg-red-400' : '' }}">
                        <div class="slash-line"></div>
    
                        {{-- Check if there is a booking for this cell --}}
                        @if ($availability['availability'] !== 'green')
                            <div class="booking-info">
                                <div class="client-name">
                                    @if ($availability['clientName'] === $clientCheck && $availability['bookingId'] === $bookingIdCheck)
                                        @continue($clientCheck = $availability['clientName'])
                                    @else
                                        {{ $availability['clientName'] }}
                                    @endif
                                    @php
                                        $clientCheck = $availability['clientName'];
                                        $bookingIdCheck = $availability['bookingId'];
                                    @endphp
                                </div>
                            </div>
                        @endif
                    </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        <thead>
            <tr class="bg-gray-300">
                <th class="p-2"></th>
                @for ($day = 1; $day <= $daysInMonth; $day++)
                    <th class="p-2 date-cell">
                        {{ date('D', strtotime($selectedYear . '-' . $selectedMonth . '-' . $day)) }}
                    </th>
                @endfor
            </tr>
        </thead>
    </table>
    
    @if ($openBookModal)
        @include('livewire.dashboard.bookings.book-car-modal')
    @endif
</div>
