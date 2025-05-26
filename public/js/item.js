$(document).ready(function () {
    $("#itable").DataTable({
       ajax:{
         url:"/test",
        dataSrc:"",
       },
        buttons:[
            "pdf",
            "excel",
            {
                label:"add Item",
                className:"btn-primary",
                action: ()=>{
                    $("#itemModal").modal("show")
                    $("#iform").trigger("reset")
                }
            }
        ],
        columns:[
            {data:"item_id"},
            {data:"item_name"},
            {data:"description"},
            {
                data:"category",
                render:function(data,type,row){
                    console.log(data)
                    console.log(row)
                    return data.length > 0 ? data[0].category_name : " Item has no category yet"
                }
            },
            {
                data:null,
                render:function(data,type,row){
                    return `<button data-id=${data.item_id} class='btnEdit btn btn-primary'><i class='fa fa-edit'></i></button>
                    <button data-id=${data.item_id} class='btnDestroy btn btn-danger'><i class='fa fa-trash'></i></button>`
                }
            }
        ]
    })
});