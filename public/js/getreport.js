
$(".excel").click(function(){
    $("#list-sale-report").table2excel({
        exclude: ".noExl",
        name: "Excel Document Name",
        filename: "Salereport" + new Date().toISOString().replace(/[\-\:\.]/g, "")+'.xls',
        fileext: ".xls",
        exclude_img: true,
        exclude_links: true,
        exclude_inputs:true
    });
});
$(".word").click(function () {
    $("#list-of-sale").wordexport("Daily Report");
});


