@extends('layouts.template')

@section('content')
<style>
    .content {
        margin: 10px;
        padding: 0;
    }

    form {
        position: relative;
        max-width: 500px;
        margin: 0 auto;
    }

    .form-group {
        position: relative;
        margin-bottom: 30px;
    }

    .form-group fieldset {
        position: relative;
        padding: 12px 10px 6px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background-color: white;
        transition: border 0.3s ease;
    }

    .form-group input,
    .form-group select {
        border: none;
        outline: none;
        background: transparent;
        width: 100%;
        font-size: 1rem;
        padding: 0.5rem 0 0;
    }

    .form-group legend {
        font-size: 0.9rem;
        color: #666;
        padding: 0 0.5rem;
        position: absolute;
        top: 14px;
        left: 10px;
        background: white;
        transition: all 0.2s ease;
        pointer-events: none;
    }

    .form-group input:focus + legend,
    .form-group input:not(:placeholder-shown) + legend,
    .form-group select:focus + legend,
    .form-group select:valid + legend {
        top: -10px;
        font-size: 0.75rem;
        color: #007bff;
        font-weight: 500;
    }

</style>

<div class="content">
    <form action="" method="POST" enctype="multipart/form-data" class="form-control">
        @csrf

        @php
            $fields = [
                'fname' => 'First Name',
                'lname' => 'Last Name',
                'age' => 'Age',
                'address' => 'Address',
                'contact' => 'Contact Number',
                'email' => 'Email',
                'password' => 'Password',
                'confirm_password' => 'Confirm Password',
            ];
        @endphp

        @foreach ($fields as $name => $label)
        <div class="form-group">
            <fieldset>
                <input type="{{ $name == 'email' ? 'email' : ($name == 'password' || $name == 'confirm_password' ? 'password' : 'text') }}" 
                       name="{{ $name }}" 
                       placeholder=" " 
                       required />
                <legend>{{ $label }}</legend>
            </fieldset>
        </div>
        @endforeach

        <div class="form-group">
            <fieldset>
                <select name="gender" required>
                    <option value="" disabled selected hidden></option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <legend>Gender</legend>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset>
                <input type="file" name="pfp" accept="image/*">
                <legend>Profile Picture (Optional)</legend>
            </fieldset>
        </div>
    </form>
</div>
@endsection
