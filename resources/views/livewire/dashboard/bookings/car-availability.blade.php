<div>
{{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet"> --}}
<div class="container mx-auto p-4">
    {{-- <style>
        .slash-line {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            width: 1px;
            background-color: #ccc; /* Adjust color as needed */
        }
  
        .date-cell {
            width: 40px; /* Adjust width as needed */
            text-align: center;
            padding: 5px; /* Adjust padding as needed */
        }
    
        .bg-diagonal-line-from {
            position: relative;
            background: linear-gradient(135deg, #34d399 50%, #f87171 50%);
        }

        .bg-diagonal-line-to {
            position: relative;
            background: linear-gradient(-45deg, #34d399 50%, #f87171 50%);
        }
    </style> --}}
    <h1 class="text-2xl font-bold mb-4">Cars Availability</h1>
    <div class="flex justify-between mb-4">
        <button wire:click="previousMonth" class="bg-gray-300 hover:bg-gray-400 px-3 py-1 rounded">
            Previous Month
        </button>
        <button wire:click="nextMonth" class="bg-gray-300 hover:bg-gray-400 px-3 py-1 rounded">
            Next Month
        </button>
        <div>
            <label for="selectMonth">Select Month:</label>
            <select wire:model="selectedMonth" id="selectMonth" class="bg-gray-100 border rounded p-1">
                @for ($month = 1; $month <= 12; $month++)
                    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                @endfor
            </select>
            <label for="selectYear">Select Year:</label>
            <select wire:model="selectedYear" id="selectYear" class="bg-gray-100 border rounded p-1">
                @for ($year = date('Y') - 5; $year <= date('Y') + 5; $year++)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>
            <button wire:click="updateSelectedMonth" class="bg-gray-300 hover:bg-gray-400 px-3 py-1 rounded">
                Go
            </button>            
        </div>
    </div>

    <h1 class="text-center font-bold">{{ $months[$selectedMonth] }} {{ $selectedYear }}</h1>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-300">
                <th class="p-2">Car Model</th>
                @for ($day = 1; $day <= $daysInMonth; $day++)
                    <th class="p-2 date-cell">{{ $day }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr class="border-b">
                    <td class="p-2">{{ $car['model'] }}</td>
                    @foreach ($car['availability'] as $availability)
                    <td class="calendar-cell relative
                        {{ $availability === 'green' ? 'bg-green-400' : '' }}
                        {{ $availability === 'from' ? 'bg-diagonal-line-from' : '' }}
                        {{ $availability === 'to' ? 'bg-diagonal-line-to' : '' }}
                        {{ $availability === 'red' ? 'bg-red-400' : '' }}">
                        <div class="slash-line"></div>
                    </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</div>
