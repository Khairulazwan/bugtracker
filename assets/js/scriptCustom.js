//Modal get ID for specific row
$(document).on('click', '#btn-assignModal,#btn-doneModal', function () {
    $('.modal-body #id').val($(this).data('id'));
})

// The script to get data from specific row table into Modal after click view button
$(document).on('click', '#btn-viewModal', function () {
    $('.modal-body #id').val($(this).data('id'));
    $('.modal-body #no').val($(this).data('no'));
    $('.modal-body #name').val($(this).data('name'));
    $('.modal-body #desc').val($(this).data('desc'));
    $('.modal-body #expt').val($(this).data('expt'));
    $('.modal-body #prog').val($(this).data('prog'));
    $('.modal-body #type').val($(this).data('type'));
    $('.modal-body #dtcre').val($(this).data('dtcre'));
    $('.modal-body #dtcom').val($(this).data('dtcom'));

    var a = document.getElementById('prog').value;

    if (a == '0') {
        document.getElementById("prog").value = "Open";
    }
    else if (a == '1') {
        document.getElementById("prog").value = "In progress";
    }
    else if (a == '2') {
        document.getElementById("prog").value = "To be tested";
    }
    else if (a == '3') {
        document.getElementById("prog").value = "Closed";
    }
    else {
        document.getElementById("prog").value = "NULL";
    }

    var b = document.getElementById('type').value;

    if (a == '0') {
        document.getElementById("type").value = "Low";
    }
    else if (a == '1') {
        document.getElementById("type").value = "Medium";
    }
    else if (a == '2') {
        document.getElementById("type").value = "Major";
    }
    else if (a == '3') {
        document.getElementById("type").value = "Showstopper";
    }
    else {
        document.getElementById("type").value = "NULL";
    }

})

//Pagination
$(document).ready(function () {
    $('#tablePagination').dataTable({
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        autoWidth: false,
        ordering: true,
        info: true,
        lengthChange: false,
        pageLength: 10,
        paging: true
    })
});

//Sweetalert section
$('.swalBtn').on('click', function (e) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You're going to logged out!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = base_url + 'auth/logout'
        }
    });
});

$(document).ready(function () {
    $('.cancelBtn').on('click', function (e) {
        e.preventDefault();
        var href = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: 'You are going to delete this record!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
                Swal.fire(
                    'Deleted!',
                    'Details has been deleted successfully.',
                    'success'
                )
            }
        });
    });

    const flashData = $('.flashAdd').data('fadd');

    if (flashData) {
        Swal.fire({
            title: 'Added !',
            text: 'Data has been submitted successfully!',
            icon: 'success',

        })
    }

    const updateData = $('.flashUpdate').data('fupd');

    if (updateData) {
        Swal.fire({
            title: 'Updated !',
            text: 'Details are successfully updated!',
            icon: 'success',

        })
    }
});

$('.guideButton').on('click', function (e) {
    Swal.fire({
        title: 'Hi, One Medicare Sdn Bhd!',
        html:
            'I am <b>Khairulazwan</b>, the person who developed this system. The system have 3 level of access which are <b>Admin, Expertise, and User.</b> ' +
            'The User role is when the person wants to report a bug/issue, the Admin role will identify the bug severity and assign the expertise to solve the bug. Lastly, the Expertise role will solve the issue and update the progress in the system. ' +
            'The system will also identify the time taken for the expertise to solve the problem. To log in, please use username "admin" for the Admin role, "peterparker" for the User role, while "tonystark" and "steverogers" for the username Expertise role.' +
            'The password for all users are same which is "<b>abc1234</b>". If there is any problem, please contact me at your convenience. I hope this system meets your requirements Mr. Rahman and the team.',
        width: 1200,
        padding: '3em',
        color: '#008069',
        background: '#fff',
    })
});