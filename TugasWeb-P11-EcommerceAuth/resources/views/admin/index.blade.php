<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel Admin</h2>
            <div class="flex gap-3 text-sm">
                <a href="{{ route('admin.users') }}" class="text-indigo-600 hover:underline">Kelola User</a>
                <a href="{{ route('admin.eager') }}" class="text-indigo-600 hover:underline">Demo Eager Loading</a>
                <a href="{{ url('/filament') }}" class="text-indigo-600 hover:underline">Filament</a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
                <div class="rounded-lg bg-white p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Total User</p>
                    <p class="text-2xl font-bold">{{ $totalUser }}</p>
                </div>
                <div class="rounded-lg bg-white p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Total Produk</p>
                    <p class="text-2xl font-bold">{{ $totalProduk }}</p>
                </div>
                <div class="rounded-lg bg-white p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Total Order</p>
                    <p class="text-2xl font-bold">{{ $totalOrder }}</p>
                </div>
                <div class="rounded-lg bg-white p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Pendapatan (order selesai)</p>
                    <p class="text-2xl font-bold">Rp {{ number_format($pendapatan, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="mt-6 rounded-lg bg-white p-4 shadow-sm overflow-x-auto">
                <h3 class="mb-3 font-semibold">5 Order Terbaru</h3>
                <table class="min-w-full text-sm">
                    <thead class="text-left text-gray-600">
                        <tr>
                            <th class="py-2 pr-4">No. Order</th>
                            <th class="py-2 pr-4">Pembeli</th>
                            <th class="py-2 pr-4">Total</th>
                            <th class="py-2 pr-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderTerbaru as $order)
                            <tr class="border-t">
                                <td class="py-2 pr-4">{{ $order->order_number }}</td>
                                <td class="py-2 pr-4">{{ $order->user->name }}</td>
                                <td class="py-2 pr-4">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="py-2 pr-4">{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
