<x-layout>
	<div class="container mt-20">
			<div class="d-flex justify-content-between align-items-center py-10">
					<a href="{{ route('home') }}">
						<h2 class="header">Laravel</h2>
					</a>
					<a href="/products/create" class="btn btn-success">Create new product</a>
			</div>
			<div class="container-fluid">
					<form action="{{ route('search.results') }}" method="GET" class="d-flex mb-3 mt-3 p-12">
							<input type="text" name="query" required class="form-control me-2" value="{{ request('query') }}" placeholder="Search your product" role="search">
							<div class="">
									<button type="submit" class="btn btn-secondary">Search</button>
							</div>
					</form>
			</div>
			{{-- Datatables --}}
			<div class="mt-10">
					@if ($products->isEmpty())
							<div class="d-flex justify-content-between align-items-center">
									<p>No products in our database. Create new one.</p>
							</div>
					@endif
					<table class="table table-bordered">
							<thead>
									<tr>
											<th>No.</th>
											<th>Name</th>
											<th>Price (RM)</th>
											<th>Details</th>
											<th>Publish</th>
											<th>Action</th>
									</tr>
							</thead>
							<tbody>
									@foreach ($products as $product)
									<tr>
											<th scope="row">{{ $product->id }}</th>
											<td>{{ $product->name }}</td>
											<td>{{ $product->price }}</td>
											<td>{{ $product->details }}</td>
											<td>{{ $product->publish ? 'Yes' : 'No' }}</td>
											<td>
													<a href="/products/{{ $product->id }}" class="btn btn-info">Show</a>
													<a href="/products/{{ $product->id }}/edit" class="btn btn-primary">Edit</a>
													<button class="btn btn-danger" form="delete-form-{{ $product->id }}">Delete</button>
											</td>
									</tr>
									<form action="/products/{{ $product->id }}" method="POST" class="hidden" id="delete-form-{{ $product->id }}">
											@csrf
											@method('DELETE')
									</form>
									@endforeach
							</tbody>
					</table>
					{{ $products->appends(['query'=>request('query')])->onEachSide(5)->links() }}
			</div>
	</div>
</x-layout>