<x-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 dark:text-gray-100 py-10">
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-3xl font-bold">Add New Product</h1>
        <a href="{{ route('products.index') }}" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors duration-200">
            Back to List
        </a>
    </div>
    <form action="{{ route('products.store') }}" method="POST" class="max-w-2xl mx-auto">
		@csrf
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:text-gray-100"
                   required>
            @error('name')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price (RM)</label>
            <input type="number" step="0.01" id="price" name="price" value="{{ old('price') }}"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:text-gray-100"
                   required>
            @error('price')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="details" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Details</label>
            <textarea id="details" name="details" rows="4"
                      class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:text-gray-100"
                      required>{{ old('details') }}</textarea>
            @error('details')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Publish Status</label>
            <div class="flex gap-4">
                <div class="flex items-center">
                    <input type="radio" id="publish_yes" name="publish" value="1"
                           class="h-4 w-4 text-primary-600 border-gray-300 dark:border-gray-600 focus:ring-primary-600"
                           {{ old('publish', 0) == 1 ? 'checked' : '' }}>
                    <label for="publish_yes" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Yes</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="publish_no" name="publish" value="0"
                           class="h-4 w-4 text-primary-600 border-gray-300 dark:border-gray-600 focus:ring-primary-600"
                           {{ old('publish', 0) == 0 ? 'checked' : '' }}>
                    <label for="publish_no" class="ml-2 text-sm text-gray-700 dark:text-gray-300">No</label>
                </div>
            </div>
        </div>

        <button type="submit" class="w-full px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors duration-200">
            Create Product
        </button>
	</form>
</x-layout>
