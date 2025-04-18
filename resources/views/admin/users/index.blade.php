@extends('layouts.app')
<?php
// dd($dataTable)
?>
@section('content')
<div class="content">
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