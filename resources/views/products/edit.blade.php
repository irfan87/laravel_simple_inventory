<x-layout>
	<div class="d-flex justify-content-between align-items-center py-10">
		<h1 class="heaeder">Edit Product</h1>
		<a href="{{ route('home') }}" class="btn btn-primary">Back</a>
	</div>
	<form action="/products/{{ $product->id }}" method="POST">
		@csrf
		@method('PATCH')

		<div class="mb-3">
			<label for="name" class="form-label">Name:</label>
			<input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
			@error('name')
				<div class="text-danger">{{ $message }}</div>
			@enderror
		</div>
		<div class="mb-3">
			<label for="price" class="form-label">Price (RM):</label>
			<input type="number" step=".01" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
			@error('price')
				<div class="text-danger">{{ $message }}</div>
			@enderror
		</div>
		<div class="mb-3">
			<label for="details" class="form-label">Details:</label>
			{{-- <input type="text" class="form-control" id="details"> --}}
			<textarea class="form-control" name="details" id="details" cols="30" rows="10" required>{{ $product->details }}</textarea>
			@error('details')
				<div class="text-danger">{{ $message }}</div>
			@enderror
		</div>
		<div class="mb-3 form-check">
			<input type="radio" class="form-check-input" id="publish" name="publish" value="1" {{ old('publish', $product->publish) == 1 ? 'checked' : '' }}>
			<label class="form-check-label" for="publish">Yes</label>
		</div>
		<div class="mb-3 form-check">
			<input type="radio" class="form-check-input" id="publish" name="publish" value="0" {{ old('publish', $product->publish) == 0 ? 'checked' : '' }}>
			<label class="form-check-label" for="publish">No</label>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</x-layout>