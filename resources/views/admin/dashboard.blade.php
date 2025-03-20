<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>

        <style>

            #customer-transactions {
                background-color: red;
            }

            th,
            td {
                border: 1px solid black;
            }
        </style>
    </x-slot>

    <button id="customer-transactions-btn">Manage Customer Transactions</button>

    <div id="customer-transactions">
        <table>
            <thead>
                <tr>
                    <th>User ID:</th>
                    <th>Transaction date:</th>
                    <th>Total amount:</th>
                    <th>Transaction status:</th>
                    <th>Reference ID:</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->user_id}}</td>
                    <td>{{ $transaction->transaction_date}}</td>
                    <td>{{ $transaction->total_amount}}</td>
                    <td>{{ $transaction->transaction_status}}</td>
                    <td>{{ $transaction->reference_id}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="{{ asset('js/admin-dashboard.js') }}"></script>
</x-app-layout>


