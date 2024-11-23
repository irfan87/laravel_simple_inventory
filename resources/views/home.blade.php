<x-layout>
    <div class="container mt-20">
        <div class="d-flex justify-content-between align-items-center py-10">
            <h2 class="header">Laravel</h2>
            <a href="#" class="btn btn-success">Create new product</a>
        </div>
        {{-- Datatables --}}
        <div class="mt-10">
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
                    @foreach ($items as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->details }}</td>
                        <td>{{ $item->publish ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="#" class="btn btn-info">Show</a>
                            <a href="#" class="btn btn-primary">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>