<x-app-layout>
    <x-slot name="header">
        <div class="flex items-baseline justify-between">
            <h2>
                <a href="{{ route('products.all') }}" class="text-indigo-600 underline hover:text-indigo-500">Products</a> / <span>{{ $product->name }}</span>
            </h2>

            <a href="{{ route('product.edit', $product) }}" class="px-5 py-2 text-sm text-white no-underline bg-indigo-600 rounded-md">Edit product</a>
        </div>
    </x-slot>

    <section class="overflow-hidden text-gray-600 body-font">
        <div class="container px-5 pt-12 pb-24 mx-auto">
            <div class="mx-auto lg:w-4/5">
                <section>
                    @if ($product->activity->count())
                        @include('products.activity.card')
                    @endif

                    <div class="flex flex-wrap mb-12">
                        <img alt="ecommerce" class="object-cover object-center w-full h-64 rounded lg:w-1/2 lg:h-auto" src="https://dummyimage.com/400x400">

                        <div class="w-full mt-6 lg:w-1/2 lg:pl-10 lg:py-6 lg:mt-0">
                            <p class="mb-1 text-sm tracking-widest text-gray-500 uppercase title-font">{{ $product->brand }}</p>
                            <h2 class="mb-2 text-3xl font-medium text-gray-900 title-font">{{ $product->name }}</h2>
                            <div class="flex items-center mb-6 leading-snug divide-x divide-gray-500">
                                <a href="#reviews" class="mr-4 text-gray-600 transition-colors hover:text-gray-400">{{ $product->reviews->count() }} Reviews</a>
                                <a href="#questions" class="pl-4 text-gray-600 transition-colors hover:text-gray-400">{{ $product->questions->count() }} Questions</a>
                            </div>
                            <p class="mb-4 leading-relaxed">{{ $product->description }}</p>
                            <p class="mb-0 text-2xl font-medium text-gray-900 title-font">${{ $product->price }}</p>
                        </div>
                    </div>
                </section>

                <section id="reviews" class="mb-12 scroll-mt-12">
                    <h3 class="mb-1 text-sm tracking-widest text-gray-500 uppercase title-font">Reviews</h3>
                    <hr class="mb-3">
                    @forelse ($product->reviews as $review)
                        <form method="POST" action="{{ $review->path() }}">
                            @method('PATCH')
                            @csrf

                            @if(!$loop->first)
                                <hr class="my-4">
                            @endif

                            <div class="flex items-baseline justify-between">
                                <div class="mr-4">
                                    <h4 class="text-xl font-medium text-gray-700 title-font">{{ $review->title }}</h4>
                                    <p class="mb-1">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <svg version="1.1" viewBox="0 0 20 20" width="16" height="16" xmlns="http://www.w3.org/2000/svg" class="inline-block {{ $i != 0 ? 'ml-1' : '' }}">
                                                <path d="m0.44766 8.9647 3.6165 3.2328c0.36299 0.32606 0.52313 0.83606 0.41103 1.321l-1.1076 4.8352c-0.26424 1.151 0.93681 2.0623 1.9057 1.4464l4.0622-2.5946c0.40835-0.26197 0.9208-0.26197 1.3292 0l4.0622 2.5946c0.96885 0.61869 2.1699-0.29262 1.9057-1.4464l-1.1076-4.8352c-0.1121-0.48492 0.048-0.99492 0.41102-1.321l3.6165-3.2328c0.86209-0.76918 0.40302-2.2434-0.72863-2.3382l-4.7455-0.39574c-0.47775-0.03902-0.89144-0.35393-1.0756-0.81656l-1.8256-4.5928c-0.43505-1.0952-1.919-1.0952-2.3541 0l-1.8256 4.5928c-0.18416 0.46262-0.59786 0.77754-1.0756 0.81656l-4.7455 0.39574c-1.1316 0.09475-1.5907 1.5662-0.72864 2.3382z" fill="#212121"/>
                                            </svg>
                                        @endfor
                                    </p>
                                    <p>{{ $review->body }}</p>
                                    <p>By {{ $review->author }}</p>
                                </div>

                                <input name="approved" type="checkbox" onchange="this.form.submit()" {{ $review->approved ? 'checked' : '' }}>
                            </div>
                        </form>
                    @empty
                        <p>There are no reviews.</p>
                    @endforelse
                </section>

                <section id="questions" class="scroll-mt-12">
                    <h3 class="mb-1 text-sm tracking-widest text-gray-500 uppercase title-font">Questions</h3>
                    <hr class="mb-3">
                    @forelse ($product->questions as $question)
                        <form method="POST" action="{{ $question->path() }}">
                            @method('PATCH')
                            @csrf

                            @if(!$loop->first)
                                <hr class="my-4">
                            @endif

                            <div class="flex items-baseline justify-between">
                                <div class="mr-4">
                                    <h4 class="text-xl font-medium text-gray-700 title-font">{{ $question->question }}</h4>
                                    <p>By {{ $question->author }}</p>
                                </div>

                                <input name="approved" type="checkbox" onchange="this.form.submit()" {{ $question->approved ? 'checked' : '' }}>
                            </div>

                            <div class="pl-6 mt-4 border-l-2 border-indigo-600">
                                @foreach ($question->answers as $answer)
                                    <p>{{ $answer->body }}</p>
                                    <small>{{ $answer->author }} — {{ $answer->created_at->diffForHumans() }}</small>
                                @endforeach
                            </div>
                        </form>
                    @empty
                        <p>There are no questions.</p>
                    @endforelse
                </section>
            </div>
        </div>
    </section>
</x-app-layout>
