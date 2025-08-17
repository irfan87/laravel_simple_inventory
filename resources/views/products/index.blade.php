<x-layout>
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 dark:text-gray-100">
			<div class="max-w-4xl mx-auto mb-8 px-6">
					<form action="{{ route('products.search') }}" method="GET" class="w-full" id="searchForm">
							<div class="relative" x-data="autocomplete()" x-cloak>
								<input type="text" 
								       name="query" 
								       id="searchInput"
								       x-model="query"
								       @input.debounce.300ms="search()"
								       @keydown.arrow-down.prevent="focusNext()"
								       @keydown.arrow-up.prevent="focusPrev()"
								       @keydown.enter.prevent="selectResult()"
								       class="w-full pl-4 pr-12 py-3 border border-gray-200 dark:border-gray-600 rounded-full focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600 placeholder-gray-400 dark:placeholder-gray-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition-colors"
								       placeholder="Search inventory..."
								       autocomplete="off">
								<div class="absolute z-50 w-full mt-2 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden"
								     x-show="results.length > 0">
									<template x-for="(result, index) in results" :key="result.url">
										<a :href="result.url" 
										   class="block px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
										   :class="{ 'bg-gray-100 dark:bg-gray-700': index === focusedIndex }">
											<div class="font-medium" x-text="result.name"></div>
											<div class="text-gray-500 dark:text-gray-400 text-xs" x-text="result.details"></div>
										</a>
									</template>
								</div>
									class="w-full pl-4 pr-12 py-3 border border-gray-200 dark:border-gray-600 rounded-full focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600 placeholder-gray-400 dark:placeholder-gray-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition-colors"
									value="{{ request('query') }}"
									placeholder="Search inventory..."
									autocomplete="off"
									x-son:input.debounce.300ms="fetchResults"
									>
                                    {{-- <ul 
                                        class="absolute bg-white border rounded mt-1 w-full shadow-lg" 
                                        x-show="results.length > 0"
                                        x-cloak
                                    >
                                        <template x-for="item in results" :key="item.id">
                                            <li class="px-3 py-2 hover:bg-gray-100" x-text="item.name"></li>
                                        </template>
                                    </ul> --}}
                                    <div x-data="search" x-cloak>
                                        <template x-for="result in results" :key="result.url">
                                            <a :href="result.url" class="block p-2 hover:bg-gray-100">
                                                <div x-text="result.name"></div>
                                                <small x-text="result.details"></small>
                                            </a>
                                        </template>
                                    </div>
								<div class="absolute z-10 w-full mt-2 bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden"
									x-show="isOpen && results.length > 0"
									x-transition:enter="transition ease-out duration-200"
									x-transition:enter-start="opacity-0 scale-95"
									x-transition:enter-end="opacity-100 scale-100">
									<template x-for="result in results" :key="result.url">
										<a :href="result.url"
											class="block px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
											<div class="font-medium" x-text="result.name"></div>
											<div class="text-gray-500 dark:text-gray-400" x-text="result.details"></div>
										</a>
									</template>
								</div>
								<button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary-600 dark:hover:text-primary-400" @click="isOpen = false">
									<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
								</button>
							</div>
					</form>
			</div>
			{{-- Datatables --}}
			<div class="mt-10">
					@if ($products->isEmpty())
							<div class="text-center p-6 bg-gray-50 rounded-lg dark:bg-gray-800">
								<p class="text-gray-600 dark:text-gray-300">No inventory items found. <a href="/products/create" class="text-primary-600 hover:text-primary-700 dark:text-primary-400 font-medium">Add your first item</a></p>
							</div>
					@endif
					<div class="px-6">
					<div class="overflow-x-auto rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 w-full">
					<table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
							<thead class="bg-gray-50 dark:bg-gray-800">
									<tr class="bg-gray-50 dark:bg-gray-800">
											<th class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">ID</th>
											<th class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
											<th class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Price</th>
											<th class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Details</th>
											<th class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Status</th>
											<th class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Actions</th>
									</tr>
							</thead>
							<tbody>
									@foreach ($products as $product)
									<tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors duration-200">
											<td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $product->id }}</td>
											<td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900 font-medium">{{ $product->name }}</td>
											<td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">RM {{ number_format($product->price, 2) }}</td>
											<td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ Str::limit($product->details, 40) }}</td>
											<td class="px-6 py-4 whitespace-nowrap text-center">
												<span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $product->publish ? 'bg-green-100 dark:bg-green-800/30 text-green-800 dark:text-green-200' : 'bg-red-100 dark:bg-red-800/30 text-red-800 dark:text-red-200' }}">
													{{ $product->publish ? 'Published' : 'Draft' }}
												</span>
											</td>
											<td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
												<div class="flex justify-center items-center gap-2">
													<a href="/products/{{ $product->id }}" class="p-1.5 text-gray-400 hover:text-primary-600 dark:hover:text-primary-400">
														<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"></path></svg>
													</a>
													<a href="/products/{{ $product->id }}/edit" class="p-1.5 text-gray-400 hover:text-primary-600 dark:hover:text-primary-400">
														<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
													</a>
													<button form="delete-form-{{ $product->id }}" class="p-1.5 text-gray-400 hover:text-red-600 dark:hover:text-red-400">
														<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
													</button>
												</div>
											</td>
									</tr>
									<form action="/products/{{ $product->id }}" method="POST" class="hidden" id="delete-form-{{ $product->id }}">
											@csrf
											@method('DELETE')
									</form>
									@endforeach
							</tbody>
					</table>
					</div>
					<div class="mt-6 flex justify-center">
						{{ $products->appends(['query'=>request('query')])->onEachSide(5)->links('pagination::tailwind') }}
					</div>
			</div>
	</div>

	@push('scripts')
	<script>
		document.addEventListener('alpine:init', () => {
			Alpine.data('autocomplete', () => ({
				query: '',
				results: [],
				focusedIndex: -1,
				
				async search() {
					if(this.query.length < 2) {
						this.results = [];
						return;
					}
					
					try {
						const response = await fetch(`{{ route('products.search') }}?query=${encodeURIComponent(this.query)}`);
						const data = await response.json();
						this.results = data.results;
						this.focusedIndex = -1;
					} catch (error) {
						console.error('Search failed:', error);
					}
				},
				
				focusNext() {
					if(this.focusedIndex < this.results.length - 1) {
						this.focusedIndex++;
					}
				},
				
				focusPrev() {
					if(this.focusedIndex > 0) {
						this.focusedIndex--;
					}
				},
				
				selectResult() {
					if(this.results[this.focusedIndex]) {
						window.location.href = this.results[this.focusedIndex].url;
					}
				}
			}));
		});
	</script>
	<style>
		[x-cloak] { display: none !important; }
	</style>
	@endpush
</x-layout>
