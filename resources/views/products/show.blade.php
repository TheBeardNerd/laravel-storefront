<x-app-layout>
    <x-slot name="header">
        <h2>
            <a href="{{ route('products.all') }}" class="text-indigo-600 underline hover:text-indigo-500">Products</a> / <span>{{ $product->name }}</span>
        </h2>
    </x-slot>

    <section class="overflow-hidden text-gray-600 body-font">
        <div class="container px-5 py-12 mx-auto">
            <div class="mx-auto lg:w-4/5">
                <div class="flex flex-wrap mb-12">
                    <img alt="ecommerce" class="object-cover object-center w-full h-64 rounded lg:w-1/2 lg:h-auto" src="https://dummyimage.com/400x400">

                    <div class="w-full mt-6 lg:w-1/2 lg:pl-10 lg:py-6 lg:mt-0">
                        <p class="mb-1 text-sm tracking-widest text-gray-500 uppercase title-font">{{ $product->brand }}</p>
                        <h2 class="mb-2 text-3xl font-medium text-gray-900 title-font">{{ $product->name }}</h2>
                        <p class="mb-4 leading-relaxed">{{ $product->description }}</p>
                        <p class="mb-0 text-2xl font-medium text-gray-900 title-font">${{ $product->price }}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-app-layout>
