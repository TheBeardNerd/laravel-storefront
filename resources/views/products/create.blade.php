<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Add a Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('product.store') }}" class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                @csrf

                <div class="p-6 bg-white border-b border-gray-200 sm:px-20">
                    <div class="mb-4">
                        <input type="text" name="name" id="name" placeholder="Name" class="w-full">
                    </div>

                    <div class="mb-4">
                        <input type="text" name="price" id="price" placeholder="Price" class="w-full">
                    </div>

                    <div>
                        <textarea name="description" id="description" rows="6" placeholder="Description" class="w-full mb-4"></textarea>
                    </div>

                    <button type="submit" class="px-5 py-2 text-sm text-white bg-indigo-600 rounded-md">Submit</button>
                    </div>
            </form>
        </div>
    </div>

</x-app-layout>
