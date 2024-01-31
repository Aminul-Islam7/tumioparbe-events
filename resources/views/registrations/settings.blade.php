{{-- @php
config(['settings.ticketPrice' => 2500]);
@endphp --}}

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Settings') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

        <div id="settings">
          <form class="ticket-price-form" action="{{ route('update-ticketprice') }}" method="post">
            @csrf
            <label for="ticketPrice">Ticket Price:</label>
            <input type="number" name="ticketPrice" id="ticketPrice" value="{{ config('settings.ticketPrice') }}">
            <span>BDT</span>
            <button type="submit">Update</button>
          </form>

        </div>

      </div>
    </div>
  </div>
</x-app-layout>