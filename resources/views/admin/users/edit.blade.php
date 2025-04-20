@include('layouts.app')

<style>
    .body{
        margin: 0%;
        padding: 0%;
        display:flex;
        justify-content: center;
    }
    .content{
        box-shadow: 0 0 10px 1px rgb(111, 110, 110);
        border-radius: 5px;
        margin: 30px;
        width: 1100px;
        height: 600px;
    }

    form{
        max-width: 100% auto;
        padding: 30px 20px;
        display: flex;
        flex-direction:row;
        gap: 20px;
        justify-content: space-evenly;


    }

    .group{
        display: flex;
        flex-direction:column;
        gap: 20px;
        justify-content: start;
        width: 400px;
     
    }

     .pfp{
        height: 300px;
        width: 300px;
        box-shadow: 0 0 5px 0.5px rgb(215, 214, 214);
        border-radius: 10px;
    }

    .form-group fieldset{
        position: relative;
        padding: 12px 10px 6px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background-color: white;
        transition: border 0.3s ease;
        
    }

    .form-group input,
    .form-group select{
        border: none;
        outline: none;
        background: transparent;
        width: 100%;
        font-size: 1rem;

    
    }

    .form-group legend{
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

    .form-group fieldset:focus-within{
        box-shadow: 0 0 0.5px 1px #007bff;
    }

    .btn{
        width: 90%;
        margin:30px 0px 10px 50px;
    }
</style>
@if($errors->any())
<?php 
// dd($errors)
?>
    <div class="error error-danger" style="color: red; padding: 10px; margin-bottom: 15px; border: 1px solid red; border-radius: 5px; margin:20px 0px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="body">
    <div class="content">
        <form action="{{route('user.update',$account->user_id)}}" method="POST" id="userForm" enctype="multipart/form-data">
            @csrf
            <div class="group">
                <img src="{{asset('storage/user_images/'.$info->pfp)}}" alt="" class="pfp"><br>
            <div class="form-group">
                <label for="" class="form-label">Profile Picture</label>
                    <input type="file" name="pfp" accept="image*" >
                    <input type="hidden" value="{{$info->pfp}}" name="current_pfp">
            </div>
        </div>
        <div class="group">
            <div class="form-group">
                <fieldset>
                    <input type="text" name="fname" value="{{$info->fname}}" >
                    <legend>First Name</legend>
                </fieldset>
            </div>
            <div class="form-group">
                <fieldset>
                    <input type="text" name="lname" value="{{$info->lname}}" >
                    <legend>Last Name</legend>
                </fieldset>
            </div>
            <div class="form-group">
                <fieldset>
                    <input type="number" name="age" min="18" max="180" step="1" value="{{$info->age}}" >
                    <legend>Age *</legend>
                </fieldset>
            </div>
            <div class="form-group">
                <fieldset>
                    <select name="gender" id="" class="form-select">
                        <option value="male" {{($info->gender ==='male'? 'selected' : '')}}>Male</option>
                        <option value="female" {{($info->gender ==='male'? 'selected' : '')}}>Female</option>
                    </select>
                    <legend>Gender</legend>
                </fieldset>
            </div>
            <div class="form-group">
                <fieldset>
                    <input type="text" name="address" value="{{$info->address}}" >
                    <legend>Address</legend>
                </fieldset>
            </div>
            <div class="form-group">
                <fieldset>
                    <input type="text" name="contacts" value="{{$info->contact}}">
                    <legend>Contact Number</legend>
                </fieldset>
            </div>
        </div>
        <div class="group">
           <div class="form-group">
            <fieldset>
                <input type="email" name="email" value="{{$account->email}}" >
                <legend>Email *</legend>
            </fieldset>
           </div>
           <div class="form-group">
            <fieldset>
                <select name="role" id="">
                    <option value="admin" {{($account->role==='admin'? 'selected' : '')}} >Admin</option>
                    <option value="user" {{($account->role==='user'? 'selected' : '')}} >User</option>
                </select>
                <legend>Role</legend>
            </fieldset>
           </div>
           <div class="form-group">
            <fieldset>
                <select name="status" id="">
                    <option value="active" {{($account->status==='active'? 'selected' : '')}} >Active</option>
                    <option value="inactive" {{($account->status==='inactive'? 'selected' : '')}} >Inactive</option>
                </select>
                <legend>Status</legend>
            </fieldset>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" >Change password</button>
            </div>
           </div>
        </div>
        </form>
        <button type="submit" form="userForm" class="btn btn-primary">Apply Changes</button>
    </div>
</div>