<section  class="fixed left-0 top-0 z-[1055] h-full w-full overflow-y-auto overflow-x-hidden outline-none">
    <div class="fixed z-50 inset-0 ease-out duration-400">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center text-black sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-700 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
            <div class="fixed top-20 left-96 right-96 z-[1055] h-full w-auto overflow-y-auto overflow-x-hidden outline-none"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center transition-all duration-300 ease-in-out sm:mx-auto sm:mt-7 sm:min-h-[calc(100%-3.5rem)] ml-[3%] md:ml-auto max-w-[94%] md:max-w-[680px] transform-none opacity-100">

                    <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
                        <button
                            wire:click="closeModal"
                            type="button"
                            class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none absolute right-4 top-4 z-10"
                            >
                        </button>
                        <!--Modal body-->
                        <div class="relative p-4 sm:p-10 text-center">
                            <p class="mb-4 font-bold text-xl md:text-2xl leading-snug text-neutral-800">Create Booking</p>
                            {{-- <div class="w-full pt-6 md:pt-10"> --}}
                            <span class="error text-red-400">{{ $booked }}</span>
                            <form wire:submit.prevent="saveBook" class="flex flex-row flex-wrap items-center -mx-2">
                                <div class="px-2 py-1 w-1/2 md:w-1/2">
                                    <label for="date_of_birth" class="px-1 text-base md:text-lg text-neutral-800 font-medium mb-1.5">From date</label>
                                    <div class="relative">
                                        <input
                                            readonly
                                            wire:model="from_date"
                                            name="from_date"
                                            id="from_date"
                                            autocomplete="off"
                                            x-data
                                            x-init="flatpickr($refs.input, { 
                                                enableTime: true, 
                                                disableMobile: true, 
                                                dateFormat: 'd.m.Y H:i', 
                                                time_24hr: true,
                                                minDate: 'today'
                                            });"
                                            class="cursor-pointer text-center w-full min-h-[48px] rounded-md px-3 py-1.5 border border-solid border-gray-200 focus:border-green-600 transition-all !outline-none !ring-0 pl-[42px]"
                                            x-ref="input"
                                            type="text"
                                            placeholder="{{ \Carbon\Carbon::today()->addDay()->format('d.m.Y - H:i') }}"
                                        />
                                    </div>
                                    @error('from_date') <span class="error text-red-400">{{ $message }}</span> @enderror
                                </div>
                                <div class="px-2 py-1 w-1/2 md:w-1/2">
                                    <label for="to_date" class="px-1 text-base md:text-lg text-neutral-800 font-medium mb-1.5">To date</label>
                                    <div class="relative">
                                        <input
                                            readonly
                                            wire:model="to_date"
                                            name="to_date"
                                            id="to_date"
                                            autocomplete="off"
                                            x-data
                                            x-init="flatpickr($refs.input, { 
                                                enableTime: true, 
                                                disableMobile: true, 
                                                dateFormat: 'd.m.Y H:i', 
                                                time_24hr: true,
                                                minDate: 'today'
                                            });"
                                            class="cursor-pointer text-center w-full min-h-[48px] rounded-md px-3 py-1.5 border border-solid border-gray-200 focus:border-green-600 transition-all !outline-none !ring-0 pl-[42px]"
                                            x-ref="input"
                                            type="text"
                                            placeholder="{{ \Carbon\Carbon::tomorrow()->addDay()->format('d.m.Y - H:i') }}"
                                        />
                                    </div>
                                    @error('to_date') <span class="error text-red-400">{{ $message }}</span> @enderror
                                </div>
                                <div class="px-2 py-1 w-1/2 md:w-1/2">
                                    <label for="location" class="px-1 text-base md:text-lg text-neutral-800 font-medium mb-1.5">Pick up location</label>
                                    <select wire:model.defer="pick_up" name="location" id="location" class="w-full min-h-[48px] rounded-md px-3 py-1.5 border border-solid border-gray-200 focus:border-green-600 transition-all !outline-none !ring-0">
                                        <option selected value="">Pick up Location</option>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pick_up') <span class="error text-red-400">{{ $message }}</span> @enderror                                                         
                                </div>
                                <div class="px-2 py-1 w-1/2 md:w-1/2">
                                    <label for="location" class="px-1 text-base md:text-lg text-neutral-800 font-medium mb-1.5">Drop off location</label>
                                    <select wire:model.defer="drop_off" name="location" id="location" class="w-full min-h-[48px] rounded-md px-3 py-1.5 border border-solid border-gray-200 focus:border-green-600 transition-all !outline-none !ring-0">
                                        <option selected value="">Drop off Location</option>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('drop_off') <span class="error text-red-400">{{ $message }}</span> @enderror                                                                
                                </div>
                                @php
                                    $days = Carbon\Carbon::parse($from_date)->diffInDays($to_date);
                                    $total_price = $days * $selected_car->ppd;
                                @endphp
                                <div class="inline-flex px-2 py-1 w-full md:w-full">
                                    <p class="px-1 text-base md:text-lg text-neutral-800 font-medium font-bold mr-4">{{ $selected_car->brand()->name }} {{ $selected_car->model->name }}</p>
                                    <p class="px-1 text-base md:text-lg text-neutral-800 font-medium font-bold">Total Cost: {{ $total_price }}</p>
                                </div>
                                <div class="px-2 py-1 w-1/2">
                                    <label for="name" class="px-1 text-base md:text-lg text-neutral-800 font-medium mb-1.5">Name</label>
                                    <input wire:model.defer="name" name="name" id="name" class="w-full h-[150px] rounded-md px-3 py-1.5 border border-solid border-gray-200 focus:border-green-600 transition-all !outline-none !ring-0" />
                                    @error('name') <span class="error text-red-400">{{ $message }}</span> @enderror
                                </div>
                                <div class="px-2 py-1 w-full">
                                    <label for="description" class="px-1 text-base md:text-lg text-neutral-800 font-medium mb-1.5">Description</label>
                                    <input wire:model.defer="description" name="description" id="description" class="w-full h-[150px] rounded-md px-3 py-1.5 border border-solid border-gray-200 focus:border-green-600 transition-all !outline-none !ring-0" />
                                    @error('description') <span class="error text-red-400">{{ $message }}</span> @enderror
                                </div>
                                <div class="relative w-full px-4 md:px-5 py-1  border-t border-t-solid border-t-gray-100">
                                    <div class="flex flex-row flex-wrap items-center -mx-2">
                                        <div class="px-2 py-1 w-1/3">
                                            <button
                                                wire:click="deleteBooking"
                                                class="cursor-pointer block text-center border border-red-600 rounded-md min-h-[46px] h-auto py-1 p-1.5 w-full max-w-full text-white bg-red-600 text-base md:text-lg leading-tight hover:bg-red-700 hover:border-red-600 transition ease-in-out duration-200 font-bold">
                                                Delete
                                            </button>
                                        </div>
                                        <div class="px-2 py-1 w-1/3">
                                            <button
                                                {{-- wire:click="bookCar" --}}
                                                type="submit"
                                                class="cursor-pointer block text-center border border-blue-600 rounded-md min-h-[46px] h-auto py-1 p-1.5 w-full max-w-full text-white bg-blue-600 text-base md:text-lg leading-tight hover:bg-blue-700 hover:border-blue-600 transition ease-in-out duration-200 font-bold">
                                                Book
                                            </button>
                                        </div>
                                        <div class="px-2 py-1 w-1/3">
                                            <a wire:click="closeModal" type="button" class="cursor-pointer block text-center border border-blue-600 rounded-md min-h-[46px] h-auto py-1 p-1.5 w-full max-w-full border-solid text-base md:text-lg text-blue-600 bg-transparent  hover:bg-blue-600 hover:text-blue-500 transition ease-in-out duration-200 font-bold">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
