<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Demo Eager Loading (N+1 Problem)</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="mb-4 text-gray-700">
                Ambil 20 order lalu tampilkan nama pembeli + jumlah item. Bandingkan jumlah query yang dijalankan.
            </p>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="rounded-lg bg-white p-4 shadow-sm">
                    <h3 class="font-semibold text-red-600">Tanpa Eager Loading: {{ count($queryLazy) }} query</h3>
                    <pre class="mt-2 rounded bg-gray-50 p-2 text-xs">Order::take(20)->get();</pre>
                    <ol class="mt-3 max-h-80 list-decimal overflow-y-auto pl-5 text-xs text-gray-600">
                        @foreach ($queryLazy as $q)
                            <li class="break-all">{{ $q['query'] }}</li>
                        @endforeach
                    </ol>
                </div>

                <div class="rounded-lg bg-white p-4 shadow-sm">
                    <h3 class="font-semibold text-green-600">Dengan Eager Loading: {{ count($queryEager) }} query</h3>
                    <pre class="mt-2 rounded bg-gray-50 p-2 text-xs">Order::with(['user', 'items.product'])->take(20)->get();</pre>
                    <ol class="mt-3 list-decimal pl-5 text-xs text-gray-600">
                        @foreach ($queryEager as $q)
                            <li class="break-all">{{ $q['query'] }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>

            <div class="mt-6 rounded-lg bg-white p-4 shadow-sm overflow-x-auto">
                <h3 class="mb-3 font-semibold">Hasil Data</h3>
                <table class="min-w-full text-sm">
                    <thead class="text-left text-gray-600">
                        <tr>
                            <th class="py-2 pr-4">No. Order</th>
                            <th class="py-2 pr-4">Pembeli</th>
                            <th class="py-2 pr-4">Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-t align-top">
                                <td class="py-2 pr-4">{{ $order->order_number }}</td>
                                <td class="py-2 pr-4">{{ $order->user->name }}</td>
                                <td class="py-2 pr-4">
                                    @foreach ($order->items as $item)
                                        {{ $item->product->name }} (x{{ $item->quantity }})<br>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
