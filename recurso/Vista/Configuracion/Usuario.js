table = $("div[Listado] table");
selections = [];
$(function(){
    
    initialComponents();
    initSelect();
    $("div[Listado] table").bootstrapTable(TablePaginationDefault);
});

function edit(datos){
    $("form[save]").edit(datos);
}