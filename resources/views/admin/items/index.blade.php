@extends('layouts.app')
<?php 
?>
@section('content')
<div class="card-body">
    {{$dataTable->table()}}
</div>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
