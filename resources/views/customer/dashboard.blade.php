<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>

    <ul>
        <li><button><a href="{{ route('customer.transaction.create') }}">Make a transaction</a></button></li>
    </ul>

</x-app-layout>