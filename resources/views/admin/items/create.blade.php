@extends('layouts.app')
@section('content')
@if(session('failed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('failed') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body p-4">
            <h4 class="mb-4">Add New Item</h4>
            <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Item Name</label>
                        <input type="text" name="item_name" class="form-control" placeholder="Item Name">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Item Price</label>
                        <input type="number" name="item_price" class="form-control" placeholder="₱0.00">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="qty" class="form-control" min="1" step="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select">
                            @foreach ($collection as $item)
                                <option value="{{ $item->category_id }}">{{ $item->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Item Description</label>
                        <textarea name="item_desc" class="form-control" rows="4" placeholder="Describe the item..."></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Item Images <small class="text-muted">(Optional)</small></label>
                        <input type="file" name="file[]" class="form-control" multiple>
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4">Submit Item</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
