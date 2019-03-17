$(document).ready(function () {

    $('#register-lecturer').click(function (e) {
        e.preventDefault();
        //alert('welcome');

        let action = 'register_lecturer';

        let lecturer_name = $('input[name=lecturer_name]').val();
        let lecturer_email = $('input[name=lecturer_email]').val();
        let lecturer_regno = $('input[name=lecturer_regno]').val();
       
            //alert(lecturer_name);
        if (lecturer_name == "" || lecturer_email == "" || lecturer_regno == "" ) {

            $('.error').removeClass('hidden');
            $('.error').text("Please fill all the fields");

        }
        else {

            $.ajax({

                type: 'POST',
                url: "/admin/registerlect",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'name': lecturer_name,
                    'email': lecturer_email,
                    'username': lecturer_regno,
                    'action': action
                },
                success: function (data) {
                    if ((data.errors)) {
                        $('.error').removeClass('hidden');
                        $('.error').removeClass('alert-success');
                        $('.error').addClass('alert-danger');
                        $('.error').text('Duplicate Registration Number not allowed');
                    } else{
                        $('.error').removeClass('alert-danger');
                        $('.error').addClass('alert-success');
                        $('.error').removeClass('hidden');
                        $('.error').text(lecturer_name + " have been successfully registered ");
                    
                        //var content = '<option value = "' + lecturer_code + '"> ' + lecturer_code + '</option>';
                        var content = '<tr> <td>'+ lecturer_name +'</td> <td>'+ lecturer_regno +'</td> <td><div class="checkbox icheck"> <label>   <input type="radio" name="lecturer_chosen" value="'+ lecturer_regno + '" id="'+ lecturer_regno+'">  </label> </div>  </td></tr>';
                        $('#list-lect').append(content);  
                        }                 
                },
                error: function (data) {
                    console.log(data.responseJSON.error);

                }
            })
        }




    });


    $(document).on('click', '.lecturer-details', function () {

        var username = $('input[name=lecturer_chosen]:checked').val();
       // alert(username);

        if (username == undefined) {
            $('.detail-error').removeClass('hidden');
            $('.detail-error').addClass('alert-danger');
            $('.detail-error').text('Select a lecturer to view its details');
        }
        else {
            $('.actionBtn').addClass('hidden');
            $('.modal-title').text('Lecturer Details');
            $('.deleteContent').hide();
            $('.form-horizontal').show();
            $('#l-username').val(username);

            $.ajax({
                type: 'POST',
                url: '/admin/registerlect',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'username': username,
                    'action': 'lecturer_details'
                },
                success: function (data) {
                    $('.detail-error').addClass('hidden');
                    $('#l-name').val(data.name);
                    $('#l-email').val(data.email);
                  
                    $('#l-name').attr('disabled', '');
                    $('#l-email').attr('disabled', '');
                    $('#l-username').attr('disabled', '');
                    $('#myModal').modal('show');



                }
            })
        }

    });

    $(document).on('click', '.lecturer-edit', function () {

        var username = $('input[name=lecturer_chosen]:checked').val();

        if (username == undefined) {
            $('.detail-error').removeClass('hidden');
            $('.detail-error').addClass('alert-danger');
            $('.detail-error').text('Select a Lecturer to edit');
        }
        else {

            $('.actionBtn').removeClass('hidden');
            $('#footer_action_button').text("Update");
            $('#footer_action_button').addClass('glyphicon-check');
            $('#footer_action_button').removeClass('glyphicon-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').addClass('edit');

            $('.modal-title').text('Edit Lecturer Details');
            $('.deleteContent').hide();
            $('.form-horizontal').show();

            $('#l-username').val(username);

            $.ajax({
                type: 'POST',
                url: '/admin/registerlect',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'username': username,
                    'action': 'lecturer_details'
                },
                success: function (data) {
                    $('.detail-error').addClass('hidden');
                    $('#l-name').val(data.name);
                    $('#l-email').val(data.email);
                    $('#l-username').attr('disabled', '');
                    $('#l-email').removeAttr('disabled');
                    $('#l-name').removeAttr('disabled');
                    $('#nationality').attr('disabled', '');
                    $('#dob').attr('disabled', '');
                    $('#lga').attr('disabled', '');
                    $('#bio').attr('disabled', '');
                    $('#address').attr('disabled', '');
                    $('.actionBtn').removeAttr(' data-dismiss');
                    $('#myModal').modal('show');

                }
            });

        }

    });

    $('.modal-footer').on('click', '.edit', function (e) {
        e.preventDefault();
        var action = "edit_lecturer";

        let name = $('#l-name').val();
        let username = $('#l-username').val();
        let email = $('#l-email').val();

        if (name == "" || username == "" || email == "") {

            $('.modal-error').removeClass('alert-success');
            $('.modal-error').addClass('alert-danger');
            $('.modal-error').removeClass('hidden');
            $('.modal-error').text("Please fill all the fields");

        }
        else {
            $.ajax({
                type: 'post',
                url: '/admin/registerlect',
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

                    setTimeout(function () {
                        location.reload()
                    }, 2000)

                }
            });
        }
    });


    $(document).on('click', '.lecturer-delete', function () {

        var username = $('input[name=lecturer_chosen]:checked').val();
        if (username == null) {

            $('.detail-error').removeClass('alert-success');
            $('.detail-error').addClass('alert-danger');
            $('.detail-error').removeClass('hidden');
            $('.detail-error').text("Select a Lecturer to delete");

        } else {

            $('#footer_action_button').text(" Delete");
            $('#footer_action_button').removeClass('glyphicon-check');
            $('#footer_action_button').addClass('glyphicon-trash');
            $('.actionBtn').removeClass('btn-success');
            $('.actionBtn').addClass('btn-danger');
            $('.actionBtn').addClass('delete');
            $('.modal-title').text('Delete Lecturer');
            $('.deleteContent').show();
            $('.form-horizontal').hide();
            $('.dname').html(username);
            $('.actionBtn').removeAttr(' data-dismiss');
            $('#myModal').modal('show');

        }

    })

    $('.modal-footer').on('click', '.delete', function () {

        var action = "delete_lecturer";
        var username = $('input[name=lecturer_chosen]:checked').val();


        $.ajax({
            type: 'post',
            url: '/admin/registerlect',
            data: {
                '_token': $('input[name=_token]').val(),
                'username': username,
                'action': action
            },
            success: function (data) {
                $('.modal-error').removeClass('hidden');
                $('.modal-error').removeClass("alert-danger");
                $('.modal-error').addClass('alert-success');
                $('.modal-error').text("Lecturer have been deleted successfuly");

                setTimeout(function () {
                    location.reload()
                }, 2000)

            }
        });

    });


});