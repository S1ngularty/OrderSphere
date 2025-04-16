@include('layouts.app')

<style>
    .body{
        margin: 0%;
        padding: 0%;
        display:flex;
        justify-content: center;
        flex-direction: 
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
</style>

<div class="body">
    <div class="content">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="group">
                <img src="" alt="" class="pfp"><br>
            <div class="form-group">
                    <input type="file" name="pfp" accept="image*" >
                    <legend>Profile Picture(Optional)</legend>
            </div>
        </div>
        <div class="group">
            <div class="form-group">
                <fieldset>
                    <input type="text" name="fname" >
                    <legend>First Name</legend>
                </fieldset>
            </div>
            <div class="form-group">
                <fieldset>
                    <input type="text" name="lname" >
                    <legend>Last Name</legend>
                </fieldset>
            </div>
            <div class="form-group">
                <fieldset>
                    <input type="number" name="age" min="18" max="180" step="1" >
                    <legend>Age *</legend>
                </fieldset>
            </div>
            <div class="form-group">
                <fieldset>
                    <select name="gender" id="" class="form-select">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <legend>Gender</legend>
                </fieldset>
            </div>
            <div class="form-group">
                <fieldset>
                    <input type="text" name="address" >
                    <legend>Address</legend>
                </fieldset>
            </div>
            <div class="form-group">
                <fieldset>
                    <input type="text" name="contacts" >
                    <legend>Contact Number</legend>
                </fieldset>
            </div>
        </div>
        <div class="group">
           <div class="form-group">
            <fieldset>
                <input type="email" name="email" >
                <legend>Email *</legend>
            </fieldset>
           </div>
           <div class="form-group">
            <fieldset>
                <input type="password" name="password" >
                <legend>Password</legend>
            </fieldset>
           </div>
           <div class="form-group">
            <fieldset>
                <input type="password" name="confirm_password" >
                <legend>Confirm Password</legend>
            </fieldset>
           </div>
        </div>
        </form>
    </div>
</div>