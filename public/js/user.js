$(document).ready(function(){
    $.ajax({
        type:"GET",
        url:"/admin/users",
        dataType:"json",
        success: function (data){
           console.log(data);
        },
        error : function () {
            alert("error");
        }
    })
})