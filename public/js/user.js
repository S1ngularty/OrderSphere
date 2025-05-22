$(document).ready(function(){
    $.ajax({
        type:"GET",
        url:"/admin/users",
        dataType:"json",
        success: function (data){
           console.log(data);
           let table=$("body").append("<table></table>");        
           $.each(data,function(key,value){
            let tr= $("<tr>");
            tr.append($("<td>").html(value.user_id))
            tr.append($("<td>").html(value.email))
            tr.append($("<td>").html(value.status))
            tr.append($("<td>").html(value.role))
            table.append(tr);
           }) 
        },
        error : function () {
            alert("error");
        }
    })
})