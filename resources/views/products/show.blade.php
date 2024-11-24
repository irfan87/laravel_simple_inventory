<x-layout>
	<div class="d-flex justify-content-between align-items-center py-10">
		<h1 class="heaeder">Show Product</h1>
		<a href="{{ route('home') }}" class="btn btn-primary">Back</a>
	</div>
	<p>
		<strong>Name:</strong>
		{{ $product->name }}
	</p>
	<p>
		<strong>Price:</strong>
		RM {{ $product->price }}
	</p>
	<p>
		<strong>Details:</strong>
		{{ $product->details }}
	</p>
	<p>
		<strong>Publish:</strong>
		{{ $product->publish ? "Yes" : "No" }}
	</p>
</x-layout>