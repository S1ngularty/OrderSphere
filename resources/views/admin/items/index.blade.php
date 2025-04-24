@extends('layouts.app')
<?php 
?>
@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('failed'))
    <div class="alert alert-danger alert-dissmissable fade show" role="alert">
        {{session('failed')}}
        <button class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
@endif
<div class="card-body">
    {{$dataTable->table()}}
</div>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
