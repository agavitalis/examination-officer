$(document).ready(function () {

    $('#assign-students').click(function () {
        //check if all the fields are seleted
        //alert($('#lecturer').val())

        if ($('#session').val() == null || $('#lecturer').val() == null  || $('#level').val() == null) {

            $('.error-message').removeClass('hidden');
            $('.error-message').text("Please Select a Lecturer and Fill all the fields to assign");

        } else {

            // alert ($('input[name=coordinator]:checked').val());
            $.ajax({
                type: 'POST',
                url: '/admin/assignstudents',
                data: {

                    '_token': $('input[name=_token]').val(),
                   
                    'lecturer': $('#lecturer').val(),
                   
                    'level': $('#level').val(),
                    'session': $('#session').val(),
                    
                    'action': 'assignstudents'
                },
                success: function (data) {

                    if (data.message) {
                        $('.error-message').removeClass('hidden');
                        $('.error-message').removeClass('alert-danger');
                        $('.error-message').removeClass('alert-success');
                        $('.error-message').addClass('alert-info');
                        $('.error-message').text(data.message);
                    }

                    else {

                        $('.error-message').removeClass('hidden');
                        $('.error-message').removeClass('alert-danger');
                        $('.error-message').removeClass('alert-info');
                        $('.error-message').addClass('alert-success');
                        $('.error-message').text(data.success);

                    }
                }
            })
        }
    })

   
    //Unassign as the academic advicer
    $(document).on('click', '.academic', function () {
        $('#footer_action_button').text("Yes,Unassign");
        $('.actionBtn').addClass('unassign-advicer');
        $('.actionBtn').addClass('btn-success');
        $('.modal-title').text('Unassign Lecturer as academic advicer');
        $('.contents').html("You are about to unassign, as an academic advicer, Do you wish to continue?")
        $('.deleteContent').show();
        $('.form-horizontal').hide();

        // I passed these details to the modal
        $('.did').text($(this).data('id'));
        $('.dname').text($(this).data('name'));
        $('.dlevel').text($(this).data('level'));
        $('.dsession').text($(this).data('session'));

        $('#myModal').modal('show');
    });


    $('.modal-footer').on('click', '.unassign-advicer', function () {

        //alert($('.dlevel').text())
        $.ajax({
            type: 'post',
            url: '/admin/assignstudents',

            data: {
                '_token': $('input[name=_token]').val(),
                'lecturer_id': $('.did').text(),
                'lecturer_name': $('.dname').text(),
                'level': $('.dlevel').text(),
                'session': $('.dsession').text(),
                'action': "delete",
            },
            dataType: 'JSON',
            success: function (data) {
                $('.assign-message').removeClass('hidden');
                $('.assign-message').removeClass("alert-danger");
                $('.assign-message').addClass('alert-success');
                $('.assign-message').text(data.message);
            }

        });
    });



})