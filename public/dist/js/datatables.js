$(document).ready(function () {

    let basicTable = $("#basicTable").DataTable({
        ordering: false,
        stateSave: true,
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros por página",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros no total)",
            loadingRecords: "Carregando...",
            zeroRecords: "Nenhum registro encontrado",
            emptyTable: "Nenhum dado disponível na tabela",
            paginate: {
                first: "Primeiro",
                last: "Último",
                next: "Próximo",
                previous: "Anterior",
            },
        },
        columnDefs: [
            { className: "text-center align-middle", targets: "_all" },
        ],

        dom:
            '<"d-flex flex-column"<"buttons-container text-start mb-2"B><"d-flex justify-content-between align-items-center"<"length-container"l><"search-container"f>>>' +
            "rt" +
            '<"d-flex justify-content-between align-items-center mt-2"<"info-container"i><"pagination-container"p>>',

        buttons: [
            {
                extend: "excelHtml5",
                className: "btn btn-primary",
                text: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-xls"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" /><path d="M4 15l4 6" /><path d="M4 21l4 -6" /><path d="M17 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" /><path d="M11 15v6h3" /></svg>',
                title: "Relatorio_Excel",
                exportOptions: {
                    format: {
                        body: function (data, row, column, node) {
                            let text = $(node).attr("data-export");
                            return text !== undefined ? text : $(node).text();
                        },
                    },
                },
            },
            {
                extend: "pdfHtml5",
                className: "btn btn-primary",
                text: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" /><path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" /><path d="M17 18h2" /><path d="M20 15h-3v6" /><path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" /></svg>',
                title: "Relatorio_PDF",
                orientation: "landscape",
                pageSize: "A4",
                exportOptions: {
                    format: {
                        body: function (data, row, column, node) {
                            let text = $(node).attr("data-export");
                            return text !== undefined ? text : $(node).text();
                        },
                    },
                },
                customize: function (doc) {
                    doc.defaultStyle.fontSize = 8;
                    doc.styles.title = {
                        alignment: "center",
                        fontSize: 12,
                        bold: true,
                        margin: [0, 0, 0, 10],
                    };
                },
            },
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "TODOS"],
        ],
    });

    let framesTable = $('#framesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/frames/data",
        ordering: false,
        columns: [
            { data: 'os', name: 'os', searchable: true },
            { data: 'brand_name', name: 'Marca', searchable: true },
            { data: 'ref', name: 'Referencia', searchable: true },
            { data: 'price', name: 'Preço', searchable: true },
            { 
                data: 'situation_badge', 
                name: 'situation_badge', // O nome deve corresponder ao 'data'
                orderable: false, 
                searchable: false 
            },
        ],
        columnDefs: [
            { className: "text-center align-middle", targets: "_all" }
        ],
        createdRow: function (row, data, dataIndex) {
            $('td', row).each(function () {
                $(this).addClass('text-center subheader');
            });
        },
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros por página",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros no total)",
            loadingRecords: "Carregando...",
            zeroRecords: "Nenhum registro encontrado",
            emptyTable: "Nenhum dado disponível na tabela",
            paginate: {
                first: "Primeiro",
                last: "Último",
                next: "Próximo",
                previous: "Anterior"
            }
        },
        dom: '<"d-flex flex-column"<"buttons-container text-start mb-2"B><"d-flex justify-content-between align-items-center"<"length-container"l><"search-container"f>>>' +
            'rt' +
            '<"d-flex justify-content-between align-items-center mt-2"<"info-container"i><"pagination-container"p>>',
            buttons: [
                {
                    extend: "excelHtml5",
                    className: "btn btn-primary",
                    text: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-xls"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" /><path d="M4 15l4 6" /><path d="M4 21l4 -6" /><path d="M17 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" /><path d="M11 15v6h3" /></svg>',
                    title: "Relatorio_Excel",
                    exportOptions: {
                        format: {
                            body: function (data, row, column, node) {
                                let text = $(node).attr("data-export");
                                return text !== undefined ? text : $(node).text();
                            },
                        },
                    },
                },
                {
                    extend: "pdfHtml5",
                    className: "btn btn-primary",
                    text: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" /><path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" /><path d="M17 18h2" /><path d="M20 15h-3v6" /><path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" /></svg>',
                    title: "Relatorio_PDF",
                    orientation: "landscape",
                    pageSize: "A4",
                    exportOptions: {
                        format: {
                            body: function (data, row, column, node) {
                                let text = $(node).attr("data-export");
                                return text !== undefined ? text : $(node).text();
                            },
                        },
                    },
                    customize: function (doc) {
                        doc.defaultStyle.fontSize = 8;
                        doc.styles.title = {
                            alignment: "center",
                            fontSize: 12,
                            bold: true,
                            margin: [0, 0, 0, 10],
                        };
                    },
                },
            ],
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "TODOS"]] // Adiciona a opção de mostrar todos os registros
    });
});