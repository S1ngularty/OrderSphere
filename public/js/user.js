 function rowConstructor (email,status,role,id){
    let tr=$("<tr>")
    tr.append($("<td>").text(email))
    tr.append($("<td>").text(role))
    tr.append($("<td>").text(status))
    tr.append($("<td>").html("<button class='userEdit btn btn-primary' data-action='edit'><i class='fa fa-edit'></i></button>"+
        "<button class='userDestroy btn btn-danger' data-action='destroy'><i class='fa fa-trash'></i></button>"
    )).attr("data-id",id) 
    return tr
}

function requestConstructor(method,url,action){
    let formData= new FormData($("#cform")[0])
    for(let pair of formData.entries()){
            console.log(`${pair[0]}=>${pair[1]}`)
        }
    $.ajax({
        method:method,
        url:url,
        data:formData,
        processData:false,
        contentType:false,
        dataType:"json",
        headers:{
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(responseData) {
            let toPassData=responseData
            if(action=="Deleting") return
           $("tbody").prepend(rowConstructor(toPassData.email,toPassData.status,toPassData.role,toPassData.user_id)).fadeIn("slow")
            actionPrompt(action,true)
            
        },
        error:()=>actionPrompt(action,false)
    })

    function actionPrompt(action,result){
        result ? bootbox.alert(`${action} user is Successful`) :bootbox.alert(`${action} of user is failed, please retry again`)
        $("#customerModal").modal("hide")
        $("#cform").trigger("reset")
    }
    
}

 function dataLookup(id,callback){
   return new Promise((resolve,reject)=>{
     $.ajax({
        method:"GET",
        url:`/admin/user/edit/${id}`,
        dataType:"json",
        success:function (data){
            resolve(data)
        },
        error: ()=> {
            bootbox.alert("failed to find the user")
            reject();
        }
    })
   })
 
}

$(document).ready(function(){
    $.ajax({
        method:"GET",
        url:"/admin/users",
        dataType:"json",
        success: function(data){
            $.each(data.user,function(key,value){
                $("tbody").append(rowConstructor(value.email,value.status,value.role,value.user_id))
            })
        },
        error:(data)=> bootbox.alert("Ajax failed to load the records")
    })
   
    
    $(document).off("click").on("click",".userEdit, .userDestroy, .addUser",async function(e){
        let el=$(this)
        let action=el.data("action")
        let tr=el.closest("tr").data("id")
        console.log(tr)
        if(action=="edit"){
            let data= await dataLookup(tr)
            console.log(data)
            $("#cform").trigger("reset")
            $("#customerModal").modal("show")
            $("#cform").append(`<input type='hidden' value=${tr}>`)
            $("#email").val(data.email)
            $("#pass").val(data.password)

            $("#customerSubmit").off("click").click(function(e){
            e.preventDefault()
            let url=`/admin/user/update/${tr}`
            requestConstructor("POST",url,"Updating")
            el.closest("tr").remove()
        })
    
        }else if(action=="add"){
            $("#cform").trigger("reset")
            $("#customerModal").modal("show")
            console.log("adding")
            $("#customerSubmit").off("click").click(function(e){
            e.preventDefault()
            let url=`/admin/user/store`
            $("#customerModal").modal("hide")
            requestConstructor("POST",url,"Adding")
            })
        }else if(action=="destroy"){
            bootbox.confirm({
                message:"are you sure u want to delete the user?",
                buttons:{
                    confirm:{
                        label:"Yes",
                        className:"btn-danger"
                    },
                    cancel:{
                        label:"No",
                        className:"btn-success"
                    }
                },
                callback:function(result){
                    let url=`/admin/user/delete/${tr}`
                    if(result) requestConstructor("DELETE",url,"Deleting")
                    el.closest("tr").fadeOut(3000,function(){
                        this.remove()
                    })
                }
            })
        }
    })
})