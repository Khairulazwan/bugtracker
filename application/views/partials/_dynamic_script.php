<script>
    (function($) {
        "use strict";

        $(document).ready(function() {
            function checkElement(type, element) {
                let found = false
                let elements
                switch (type) {
                    case 'class':
                        elements = document.getElementsByClassName(element)
                        if (elements !== undefined && elements !== null && elements.length > 0) {
                            found = true
                        }
                        break

                    case 'id':
                        elements = document.getElementById(element)

                        if (elements !== undefined && elements !== null) {
                            found = true
                        }
                        break
                    case 'tag':
                        elements = document.getElementsByName(element)

                        if (elements !== undefined && elements !== null) {
                            found = true
                        }
                        break
                }
                return found
            }
            let select = checkElement('class', 'select2js')
            if (select) {
                $('.select2js').select2();
            }


            let table = checkElement('id', 'table_id')
            if (table) {
                $('#table_id').dataTable({
                    dom: "<'row justify-content-between' <'col-md-3 col-sm-6' f><'col-md-3 col-sm-8' <'user-list-files d-flex float-right' B>> <'col-md-2' <'ml-2' l>> ><'row table-responsive' t><'row justify-content-between mt-3'<'col-md-6' i><'col-md-6' p>>",
                    buttons: [

                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i> Print',
                            className: 'btn btn-primary',
                        },
                        {
                            extend: 'csv',
                            text: '<i class="fa fa-file"></i> CSV',
                            className: 'btn btn-primary',
                        }
                    ],
                    language: [{
                            search: ''
                        },
                        {
                            searchPlaceholder: 'Search'
                        },
                    ],
                });
            }
            let form = checkElement('tag', 'form')
            if (form) {
                // $('form').validator();
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let datePicker = checkElement('class', 'datepicker')
            if (datePicker) {
                $(".datepicker").flatpickr({
                    dateFormat: "d-m-Y"
                });
            }

            let timePicker = checkElement('class', 'timepicker')
            if (timePicker) {
                $(".timepicker").flatpickr({
                    enableTime: true,
                    noCalendar: true,
                    time_24hr: true,
                    dateFormat: "H:i",
                });
            }

            $(document).on('click', '[data-form="ajax"]', function(f) {
                // $('form').validator('update');
                f.preventDefault();
                var current = $(this);
                current.addClass('disabled');
                var form = $(this).closest('form');
                var url = form.attr('action');
                var fd = new FormData(form[0]);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: fd, // serializes the form's elements.
                    success: function(e) {
                        if (e.status == true) {
                            if (e.event == "submited") {
                                showMessage(e.message);
                                $(".modal").modal('hide');
                            }
                            if (e.event == 'refresh') {
                                // showMessage(e.message);
                                window.location.reload();
                            }
                            if (e.event == "callback") {
                                showMessage(e.message);
                                $(".modal").modal('hide');
                                location.reload();
                            }
                        }
                        if (e.status == false) {
                            if (e.event == 'validation') {
                                errorMessage(e.message);
                            }
                        }
                    },
                    error: function(error) {

                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                });
                f.preventDefault(); // avoid to execute the actual submit of the form.

            });

            $(document).ready(function() {

                $(document).on('change', '.change_status', function() {
                    var status = $(this).prop('checked') == true ? 1 : 0;
                    var id = $(this).attr('data-id');
                    var type = $(this).attr('data-type');
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "{{ route('changeStatus') }}",
                        data: {
                            'status': status,
                            'id': id,
                            'type': type
                        },
                        success: function(data) {
                            showMessage(data.message);
                        }
                    });
                })

                function showMessage(message) {
                    Snackbar.show({
                        text: message,
                        pos: 'bottom-right'
                    });
                }
            })

            $(document).on('click', '[data-toggle="tabajax"]', function(e) {
                e.preventDefault();
                var selectDiv = this;
                ajaxMethodCall(selectDiv);
            });

            function ajaxMethodCall(selectDiv) {

                var $this = $(selectDiv),
                    loadurl = $this.attr('data-href'),
                    targ = $this.attr('data-target'),
                    id = selectDiv.id || '';

                $.post(loadurl, function(data) {
                    $(targ).html(data);
                    $('form').append('<input type="hidden" name="active_tab" value="' + id + '" />');
                });

                $this.tab('show');
                return false;
            }
        });
    })(jQuery);

    function openModal(app_title = '', app_size, url, render) {
        if (app_size === 'small') {
            $('.modal-dialog').removeClass('modal-extra-large modal-lg')
        } else {
            $('.modal-dialog').addClass('modal-extra-large modal-lg')
        }

        $.get(url, function(data) {
            var html = data.html;
            if (render !== undefined && render !== '' && render !== null) {
                $('.' + render).html(html);
            } else {
                $('.main_form').html(html);
                $(".modal-title").empty().append(app_title);
                $("#formModal").modal("show");
            }
        });
    }

</script>
<?php include 'snackbar.php' ?>