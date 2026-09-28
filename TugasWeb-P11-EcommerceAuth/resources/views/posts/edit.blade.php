<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Artikel</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('posts.update', $post) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('posts._form')

                    <div class="mt-6 flex items-center gap-4">
                        <x-primary-button>Update</x-primary-button>
                        <a href="{{ route('posts.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
