// datatables settings
$.extend(true, $.fn.dataTable.defaults, {
    processing: false,
    // colReorder: true,
    serverSide: true,
    autoWidth: false,
    lengthMenu: [5, 10, 25, 50, 100, 250, 500, -1],
    // stateSaveParams: function (settings, data) {
    //     data.search.search = '';
    //     data.start = 0;
    // },
    info:false,
    pagingType: "simple_numbers",
    pageLength: 25,
    stateDuration: 0,
    // stateSave: true,
    responsive: {
        details: {
            display: $.fn.dataTable.Responsive.display.modal({
                header: function (row) {
                    var data = row.data();
                    return '' + 'Detalle';
                }
            }),
            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                tableClass: 'table table-responsive text-primary'
            })
        }
    },
    language:{
        sProcessing:     "Procesando...",
        sLengthMenu:     "Mostrar _MENU_ registros",
        sZeroRecords:    "No se encontraron resultados",
        sEmptyTable:     "Ningún dato disponible en esta tabla",
        // sInfo:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        sInfoEmpty:      "Mostrando registros del 0 al 0 de un total de 0 registros",
        sInfoFiltered:   "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix:    "",
        sSearch:         "Buscar:",
        sUrl:            "",
        sInfoThousands:  ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
            sFirst:    "Primero",
            sLast:     "Último",
            sNext:     "Siguiente",
            sPrevious: "Anterior"
        }
        // oAria: {
        //     sSortAscending:  ": Activar para ordenar la columna de manera ascendente",
        //     sSortDescending: ": Activar para ordenar la columna de manera descendente"
        // }
    },
    // stateLoadCallback: function (settings, callback) {
    //     return JSON.parse(localStorage.getItem($(this).attr('id')));
    // },
    // stateSaveCallback: function (settings, data) {
    //     localStorage.setItem($(this).attr('id'), JSON.stringify(data));
    // }
});

$(document).ready(function () {

    // flash alert if it exists in session storage
    if (sessionStorage.hasOwnProperty('flash_after')) {
        let flash_after = JSON.parse(sessionStorage.getItem('flash_after'));

        flash(flash_after[0], flash_after[1]);
        sessionStorage.removeItem('flash_after');
    }

    // ajax form logic
    $(document).on('submit', '[data-ajax-form]', function (event) {
        event.preventDefault();

        let form = $(this);

        if (form.attr('data-ajax-form') !== 'submitted') {
            // disable additional form submits
            form.attr('data-ajax-form', 'submitted');

            // remove existing alert & invalid field styles
            $('.alert-flash').remove();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                contentType: false,
                processData: false,
                data: new FormData(form[0]),
                success: function (response) {
                    // dismiss modal
                    if (response.hasOwnProperty('dismiss_modal')) {
                        form.closest('[data-ajax-modal]').modal('toggle');
                    }

                    // flash alert message now
                    if (response.hasOwnProperty('flash_now')) {
                        flash(response.flash_now[0], response.flash_now[1]);
                    }

                    // flash alert message after
                    if (response.hasOwnProperty('flash_after')) {
                        sessionStorage.setItem('flash_after', JSON.stringify(response.flash_after));
                    }

                    // redirect to page
                    if (response.hasOwnProperty('redirect')) {
                        $(location).attr('href', response.redirect);
                    }

                    // reload datatables on page
                    if (response.hasOwnProperty('reload_datatables')) {
                        $($.fn.dataTable.tables()).DataTable().ajax.reload(null, false);
                    }

                    // reload current page
                    if (response.hasOwnProperty('reload_page')) {
                        location.reload();
                    }
                },
                error: function (response) {
                    // flash error message
                    flash('danger', response.responseJSON.message);

                    // show error for each input
                    if (response.responseJSON.hasOwnProperty('errors')) {
                        $.each(response.responseJSON.errors, function (key, value) {
                            let container = $('#' + $.escapeSelector(key)).closest('div');

                            container.find('input, select, textarea').addClass('is-invalid');
                            container.addClass('is-invalid-container');
                            container.append('<div class="invalid-feedback">' + value[0] + '</div>');
                        });
                    }
                }
            });
        }
    });

    // re-enable form submit when ajax complete
    $(document).ajaxComplete(function () {
        $('[data-ajax-form="submitted"]').attr('data-ajax-form', '');
    });

    // remove invalid style on input entry
    $(document).on('keyup change', '.is-invalid', function () {
        let container = $(this).closest('.is-invalid-container');

        container.find('input, select, textarea').removeClass('is-invalid');
        container.removeClass('is-invalid-container');
        container.find('.invalid-feedback').remove();
    });

    // show ajax modal with content
    $(document).on('click', '[data-modal]', function () {
        $.get($(this).data('modal'), function (data) {
            $(data).modal('show');
        });
    });

    // execute scripts in ajax modals
    $(document).on('shown.bs.modal', '[data-ajax-modal]', function () {
        $(this).find('script').each(function(){
            eval($(this).text());
        });
    });

    // remove ajax modal when hidden
    $(document).on('hidden.bs.modal', '[data-ajax-modal]', function () {
        $(this).remove();
    });

    // confirm action
    $(document).on('click', '[data-confirm]', function (event) {
        if (!confirm($(this).data('confirm').length ? $(this).data('confirm') : 'Are you sure?')) {
            event.preventDefault();
        }
    });

});

// flash alert message
function flash(alert_class, alert_message) {
    let html = '<div class="alert-flash text-center w-100"><div class="alert bg-' + alert_class + ' text-light d-inline-block">' + alert_message + '</div></div>';

    $(html).hide().appendTo('body').fadeIn('fast', function () {
        $(this).delay(2000).fadeOut('fast', function () {
            $(this).remove();
        });
    });
}
