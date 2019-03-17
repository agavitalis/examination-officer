$(document).ready(function () {

    $('#register-student').click(function (e) {
        e.preventDefault();
        //alert('welcome');

        let action = 'register_student';

        let student_name = $('input[name=student_name]').val();
        let student_email = $('input[name=student_email]').val();
        let student_regno = $('input[name=student_regno]').val();

        let current_level = $('#level_current').val();
        let level_admitted = $('#level_admitted').val();
        let session_admitted = $('#session').val();
        let mode = $('#mode').val();

        //alert(student_name);
        if (student_name == "" || student_email == "" || student_regno == "" || mode == "" || session_admitted == "" || level_admitted == "" || current_level == "") {

            $('.error').removeClass('hidden');
            $('.error').text("Please fill all the fields");

        }
        else {

            $.ajax({

                type: 'POST',
                url: "/admin/registerstud",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'name': student_name,
                    'email': student_email,
                    'username': student_regno,
                    'current_level': current_level,
                    'level_admitted': level_admitted,
                    'session_admitted': session_admitted,
                    'mode': mode,
                    'action': action
                },
                success: function (data) {
                    //console.log(data)
                    if ((data.errors)) {
                        $('.error').removeClass('hidden');
                        $('.error').removeClass('alert-success');
                        $('.error').addClass('alert-danger');
                        $('.error').text('Duplicate Registration Number not allowed');
                    } else {
                        $('.error').removeClass('alert-danger');
                        $('.error').addClass('alert-success');
                        $('.error').removeClass('hidden', 'alert-danger');
                        $('.error').text(student_name + " have been successfully registered ");

                        //var content = '<option value = "' + student_code + '"> ' + student_code + '</option>';
                        var content = '<tr> <td>' + student_name + '</td> <td>' + student_regno + '</td> <td><div class="checkbox icheck"> <label>   <input type="radio" name="student_chosen" value="' + student_regno + '" id="' + student_regno + '">  </label> </div>  </td></tr>';
                        $('#list-lect').append(content);
                    }
                },
                error: function (data) {
                    console.log(data.responseJSON.error);

                }
            })
        }




    });


    $(document).on('click', '.student-details', function () {

        var username = $('input[name=student_chosen]:checked').val();
        // alert(username);

        if (username == undefined) {
            $('.detail-error').removeClass('hidden');
            $('.detail-error').addClass('alert-danger');
            $('.detail-error').text('Select a student to view its details');
        }
        else {
            $('.actionBtn').addClass('hidden');
            $('.modal-title').text('student Details');
            $('.deleteContent').hide();
            $('.form-horizontal').show();
            $('#s-username').val(username);

            $.ajax({
                type: 'POST',
                url: '/admin/registerstud',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'username': username,
                    'action': 'student_details'
                },
                success: function (data) {
                    $('.detail-error').addClass('hidden');
                    $('#s-name').val(data.name);
                    $('#s-email').val(data.email);

                    $('#s-name').attr('disabled', '');
                    $('#s-email').attr('disabled', '');
                    $('#s-username').attr('disabled', '');
                    $('#myModal').modal('show');



                }
            })
        }

    });

    $(document).on('click', '.student-edit', function () {

        var username = $('input[name=student_chosen]:checked').val();

        if (username == undefined) {
            $('.detail-error').removeClass('hidden');
            $('.detail-error').addClass('alert-danger');
            $('.detail-error').text('Select a student to edit');
        }
        else {

            $('.actionBtn').removeClass('hidden');
            $('#footer_action_button').text("Update");
            $('#footer_action_button').addClass('glyphicon-check');
            $('#footer_action_button').removeClass('glyphicon-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').addClass('edit');

            $('.modal-title').text('Edit student Details');
            $('.deleteContent').hide();
            $('.form-horizontal').show();

            $('#s-username').val(username);

            $.ajax({
                type: 'POST',
                url: '/admin/registerstud',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'username': username,
                    'action': 'student_details'
                },
                success: function (data) {
                    $('.detail-error').addClass('hidden');
                    $('#s-name').val(data.name);
                    $('#s-email').val(data.email);
                    $('#s-username').attr('disabled');                  
                    $('#nationality').attr('disabled');
                    $('#dob').attr('disabled');
                    $('#lga').attr('disabled');
                    $('#bio').attr('disabled');
                    $('#address').attr('disabled');
                    $('.actionBtn').removeAttr(' data-dismiss');
                    $('#myModal').modal('show');

                }
            });

        }

    });

    $('.modal-footer').on('click', '.edit', function (e) {
        e.preventDefault();
        var action = "edit_student";

        let name = $('#s-name').val();
        let username = $('#s-username').val();
        let email = $('#s-email').val();

        if (name == "" || username == "" || email == "") {

            $('.modal-error').removeClass('alert-success');
            $('.modal-error').addClass('alert-danger');
            $('.modal-error').removeClass('hidden');
            $('.modal-error').text("Please fill all the fields");

        }
        else {
            $.ajax({
                type: 'post',
                url: '/admin/registerstud',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'name': name,
                    'username': username,
                    'email': email,
                    'action': action
                },
                success: function (data) {
                    $('.modal-error').removeClass('hidden');
                    $('.modal-error').removeClass("alert-danger");
                    $('.modal-error').addClass('alert-success');
                    $('.modal-error').text(data.name + " have been edited successfuly");
                }
            });
        }
    });


    $(document).on('click', '.student-delete', function () {

        var username = $('input[name=student_chosen]:checked').val();
        if (username == null) {

            $('.detail-error').removeClass('alert-success');
            $('.detail-error').addClass('alert-danger');
            $('.detail-error').removeClass('hidden');
            $('.detail-error').text("Select a student to delete");

        } else {

            $('#footer_action_button').text(" Delete");
            $('#footer_action_button').removeClass('glyphicon-check');
            $('#footer_action_button').addClass('glyphicon-trash');
            $('.actionBtn').removeClass('btn-success');
            $('.actionBtn').addClass('btn-danger');
            $('.actionBtn').addClass('delete');
            $('.modal-title').text('Delete student');
            $('.deleteContent').show();
            $('.form-horizontal').hide();
            $('.dname').html(username);
            $('.actionBtn').removeAttr(' data-dismiss');
            $('#myModal').modal('show');

        }

    })

    $('.modal-footer').on('click', '.delete', function () {

        var action = "delete_student";
        var username = $('input[name=student_chosen]:checked').val();


        $.ajax({
            type: 'post',
            url: '/admin/registerstud',
            data: {
                '_token': $('input[name=_token]').val(),
                'username': username,
                'action': action
            },
            success: function (data) {
                $('.modal-error').removeClass('hidden');
                $('.modal-error').removeClass("alert-danger");
                $('.modal-error').addClass('alert-success');
                $('.modal-error').text("student have been deleted successfuly");
            }
        });

    });


});