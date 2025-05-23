$(document).ready(function() {

    $.ajax({
        type: "GET",
        url: "/admin/users",
        dataType: "json",
        success: function(data) {
            console.log(data);

            let table = $("<table>").addClass("table table-striped table-bordered table-hover table-sm");

            let thead = $("<thead>");
            let headerRow = $("<tr>");
            headerRow.append("<th>User ID</th>");
            headerRow.append("<th>Email</th>");
            headerRow.append("<th>Status</th>");
            headerRow.append("<th>Role</th>");
            thead.append(headerRow);
            table.append(thead);

            let tbody = $("<tbody>");
            $.each(data, function(index, value) {
                let tr = $("<tr>");
                tr.append($("<td>").text(value.user_id));
                tr.append($("<td>").text(value.email));
                tr.append($("<td>").text(value.status));
                tr.append($("<td>").text(value.role));
                tr.append($("<td>").html(`<button  class='customerEdit btn btn-primary'><i class='fa fa-edit'></i></button>
                    <button  class='customerDestroy btn btn-danger'><i class='fa fa-trash'></i></button>`)).attr("data-id",value.user_id)
                tbody.append(tr);
            });
            table.append(tbody);

            $("<div class='m-4'>").append(table).appendTo("body");
        },
        error: function() {
            alert("Error loading user data.");
        }
    });




    // $("#customerSubmit").click(function(e){
    //     e.preventDefault()
    //     let formData= new FormData($("#cform")[0]);
    //     console.log(formData);
    //     for(let pair of formData.entries()){
    //         console.log(`${pair[0]}=>${pair[1]}`)
    //     }

    //     $.ajax({
    //         url:"/buttondmin/user/store",
    //         method:"POST",
    //         processData:false,
    //         contentType:false,
    //         data:formData,
    //         headers:{
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         dataType:"json",
    //         success: function(data){
    //             console.log(data.envelope.user)
    //             let tr=$("<tr>");
    //             tr.append($("<td>").text("#"))
    //             tr.append($("<td>").text(data.envelope.user.email))
    //             tr.append($("<td>").text(data.envelope.user.status))
    //             tr.append($("<td>").text(data.envelope.user.role))
    //             tr.append($("<td>").html(`<button class='btn btn-primary'><i class='fa fa-edit'></i></button>`))
    //             $("tbody").prepend(tr).fadeIn('slow')
    //         },
    //         error: function(error){
    //             console.log(error)
    //         }
    // })

    // });

$(document).on('click','.customerEdit',function(e){
    $("#cform").trigger("reset")
    let id=$(this).closest("tr").attr("data-id")
    $.ajax({
        method:"GET",
        url:`/admin/user/edit/${id}`,
        processData:false,
        contentType:false,
        success: function (data){
            console.log(data)
            $("#email").val(data.email)
            $("#pass").val(data.password)

            $("#customerModal").modal("show")
            $("#customerSubmit").click(function(e){
                e.preventDefault()
                let formData=new FormData($("#cform")[0])
                console.log(formData)
                for(let pair of formData.entries()){
                    console.log(`${pair[0]}=>${pair[1]}`)
                }

                $.ajax({
                    url:`/admin/user/update/${id}`,
                    method:"POST",
                    processData:false,
                    contentType:false,
                    dataType:"json",
                    data:formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        $("#customerModal").modal("hide");
                        console.log("yesss")
                    }
                })
            })
        },
        error: function (error){
            console.log(error);
        }
    })

    
})


});//end of the first code block
