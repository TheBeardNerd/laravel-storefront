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
                        <input type="text" name="brand" id="brand" placeholder="Brand" class="w-full">
                    </div>

                    <div class="mb-4">
                        <input type="text" name="name" id="name" placeholder="Name" class="w-full">
                    </div>

                    <div class="mb-4">
                        <input type="text" name="price" id="price" placeholder="Price" class="w-full">
                    </div>

                    <div>
                        <textarea name="description" id="description" rows="6" placeholder="Description" class="w-full mb-4"></textarea>
                    </div>

                    <div class="text-center sm:text-left">
                        <button type="submit" class="w-full px-8 py-4 mb-4 text-white bg-indigo-600 rounded-md sm:px-6 sm:py-2 sm:w-auto sm:mb-0 sm:mr-4">Save Product</button>
                        <a href="/products" class="text-gray-700 underline transition-colors hover:text-gray-500">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
