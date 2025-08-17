document.addEventListener('alpine:init', () => {
    Alpine.data('searchAutocomplete', () => ({
        query: '',
        results: [],
        focusedIndex: -1,

        async search() {
            if (this.query.length < 2) {
                this.results = [];
                return;
            }
            
            try {
                const endpoint = this.$root.action;
                const response = await fetch(`${endpoint}?query=${encodeURIComponent(this.query)}`);
                const data = await response.json();
                this.results = data.results;
                this.focusedIndex = -1;
            } catch (error) {
                console.error('Search error:', error);
            }
        },

        focusNext() {
            this.focusedIndex = Math.min(this.focusedIndex + 1, this.results.length - 1);
        },

        focusPrev() {
            this.focusedIndex = Math.max(this.focusedIndex - 1, -1);
        },

        selectResult() {
            if (this.results[this.focusedIndex]) {
                window.location.href = this.results[this.focusedIndex].url;
            }
        }
    }));
});
