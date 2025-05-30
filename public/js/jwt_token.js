
$(document).ready(function () {
    $("form").on("submit",function(e){
        e.preventDefault()
        const formData= new FormData($(this)[0])
        for(let pair of formData.entries()){
            console.log(`${pair[0]}=>${pair[1]}`)
        }

        $.ajax({
            method:"POST",
            url:"http://127.0.0.1:8000/api/jwtlogin/submit",
            contentType:false,
            dataType:"json",
            processData:false,
            data:formData,
            success: function (data){
                console.log(data)
                localStorage.setItem("token",data.token)
            },
            error: function(){
                console.log("failed  to log in your account")
            }
        })
    })
});