@extends('layouts.template')
@extends('layouts.base')
<?php
// dd($dataTable)
?>
@section('content')
<div class="content">
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