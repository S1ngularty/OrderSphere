$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "/admin/users",
        dataType: "json",
        success: function(data) {
            console.log(data);

            // Create the table and apply Bootstrap classes
            let table = $("<table>").addClass("table table-striped table-bordered table-hover table-sm");

            // Add table header
            let thead = $("<thead>");
            let headerRow = $("<tr>");
            headerRow.append("<th>User ID</th>");
            headerRow.append("<th>Email</th>");
            headerRow.append("<th>Status</th>");
            headerRow.append("<th>Role</th>");
            thead.append(headerRow);
            table.append(thead);

            // Add table body
            let tbody = $("<tbody>");
            $.each(data, function(index, value) {
                let tr = $("<tr>");
                tr.append($("<td>").text(value.user_id));
                tr.append($("<td>").text(value.email));
                tr.append($("<td>").text(value.status));
                tr.append($("<td>").text(value.role));
                tr.append($("<td>").html(`<a href='${value.user_id}' class='btn btn-primary'><i class='fa fa-edit'></i></a>`))
                tbody.append(tr);
            });
            table.append(tbody);

            // Add spacing around the table
            $("<div class='m-4'>").append(table).appendTo("body");
        },
        error: function() {
            alert("Error loading user data.");
        }
    });

    $("#customerSubmit").click(function(e){
        e.preventDefault();
        let formData= new FormData($("#cform")[0]);
        console.log(formData);
        for(let pair of formData.entries()){
            console.log(`${pair[0]}=>${pair[1]}`)
        }

        $.ajax({
            url:"/admin/user/store",
            method:"POST",
            processData:false,
            contentType:false,
            data:formData,
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:"json",
            success: function(data){
                console.log(data.envelope.user)
                let tr=$("<tr>");
                tr.append($("<td>").text("#"))
                tr.append($("<td>").text(data.envelope.user.email))
                tr.append($("<td>").text(data.envelope.user.status))
                tr.append($("<td>").text(data.envelope.user.role))
                tr.append($("<td>").html(`<a href='z' class='btn btn-primary'><i class='fa fa-edit'></i></a>`))
                $("tbody").prepend(tr).fadeIn('slow')
            },
            error: function(error){
                console.log(error)
            }
    })

});

});
