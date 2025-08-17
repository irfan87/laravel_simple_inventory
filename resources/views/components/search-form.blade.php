<form 
    {{ $attributes->merge(['method' => 'GET', 'class' => 'w-full']) }}
    x-data="searchAutocomplete"
    x-cloak
>
    <div class="relative">
        <input type="text" 
               name="query" 
               x-model="query"
               @input.debounce.300ms="search"
               @keydown.arrow-down.prevent="focusNext"
               @keydown.arrow-up.prevent="focusPrev"
               @keydown.enter.prevent="selectResult"
               class="w-full pl-4 pr-12 py-3 border rounded-lg focus:ring-2 focus:ring-primary-600 bg-white dark:bg-gray-700 transition-colors"
               placeholder="Search inventory..."
               autocomplete="off">
        
        <!-- Dropdown Results -->
        <div class="absolute z-50 w-full mt-2 bg-white dark:bg-gray-800 rounded-lg shadow-lg border" 
             x-show="results.length > 0">
            <template x-for="(result, index) in results" :key="result.url">
                <a :href="result.url" class="block px-4 py-3 text-sm hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="font-medium" x-text="result.name"></div>
                    <div class="text-gray-500 text-xs" x-text="result.details"></div>
                </a>
            </template>
        </div>
        
        <!-- Search Icon -->
        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </button>
    </div>
</form>
