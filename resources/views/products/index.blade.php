<x-app-layout>
    <x-slot name="header">
        <div class="flex items-baseline justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Products') }}
            </h2>

            <a href="{{ route('products.create') }}" class="px-5 py-2 text-sm text-white no-underline bg-indigo-600 rounded-md">Add a product</a>
        </div>
    </x-slot>

    <section class="text-gray-600 body-font">
        <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-wrap -m-4">
                @forelse ($products as $product)
                    <div class="w-full p-4 lg:w-1/4 md:w-1/2">
                        <a href="{{ $product->path() }}" class="relative block h-48 overflow-hidden rounded">
                            <img alt="ecommerce" class="block object-cover object-center w-full h-full" src="https://dummyimage.com/420x260">
                        </a>
                        <div class="mt-4">
                            <h3 class="mb-1 text-xs tracking-widest text-gray-500 title-font">CATEGORY</h3>
                            <h2 class="text-lg font-medium title-font">
                                <a href="{{ $product->path() }}" class="text-gray-900 no-underline transition-colors hover:text-gray-600">{{ $product->name }}</a>
                            </h2>
                            <p class="mt-1">${{ $product->price }}</p>
                        </div>
                    </div>
                @empty
                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200 sm:px-20">
                                <p>No products at this time.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
