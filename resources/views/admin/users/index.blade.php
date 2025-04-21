@extends('layouts.app')
<?php
// dd($dataTable)
?>
@section('content')
<div class="content">
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <h2 class="mb-4">User List</h2>
    <br>
    <hr>
    <div class="card-body">
        {{$dataTable->table()}}
    </div>
</div>
@endsection


@push('scripts')
    {{ $dataTable->scripts() }}
@endpush