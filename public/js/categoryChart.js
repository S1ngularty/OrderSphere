$(document).ready(function(){
    $.ajax({
        url:"/category/charts",
        datatype:"json",
        method:"GET",
        success:function(data){
            console.log(data)
            const canvas=$("#categoryChart")
            const myChart=new Chart(canvas,{
                type:'doughnut',
                data:{
                labels:data.label,
                datasets:[{
                    label:"count",
                    data:data.data,
                    backgroundColor:"#0000FF",
                }]},
                options:{
                    scales:{
                        y:{
                            beginAtZero:true,
                            max:10
                        }
                    },
                    indexAxis:'x'
                }
            })
        },
        error:() => console.log("failed to retreive the data results")
    })
})