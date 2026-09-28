<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Role User</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <x-flash-message />

            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-left text-gray-600">
                        <tr>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-t">
                                <td class="px-4 py-3">{{ $user->name }}</td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    <form action="{{ route('admin.users.role', $user) }}" method="POST" class="flex gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" class="rounded-md border-gray-300 py-1 text-sm">
                                            @foreach (['admin', 'editor', 'user'] as $role)
                                                <option value="{{ $role }}" @selected($user->role == $role)>{{ $role }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="rounded bg-gray-800 px-3 text-xs text-white">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
