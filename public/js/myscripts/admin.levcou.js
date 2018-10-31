$(document).ready(function(){

    $('#register-course').click(function(e) {
        e.preventDefault();
        //alert('welcome');

        let action = 'register-course';

        let course_code = $('input[name=course_code]').val();
        let course_title = $('input[name=course_title]').val();
        let course_level = $('#course_level').val();
        let course_semester = $('#semester').val();
        let unit = $('input[name=course_unit]').val();
        let status = $('input[name=status]:checked').val();

        if (course_code == "" || course_title == "" || course_level == "" || course_semester == "" || unit == "" || status == "") {

            $('.error-course').removeClass('hidden');
            $('.error-course').text("Please fill all the fields");

        }
        else {
          
            $.ajax({

                type: 'POST',
                url: "/admin/levcou",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'course_code': course_code,
                    'course_title': course_title,
                    'course_level': course_level,
                    'course_semester': course_semester,
                    'unit': unit,
                    'status': status,
                    'action': 'addcourse'
                },
                success: function (data) {
                    if ((data.errors)) {
                        $('.error-course').removeClass('hidden');
                        $('.error-course').removeClass('alert-success');
                        $('.error-course').removeClass('alert-danger');
                        $('.error-course').addClass('alert-info');
                        $('.error-course').text('Please pick a unique course code');
                    } else {
                        $('.error-course').removeClass('alert-danger');
                        $('.error-course').removeClass('alert-info');
                        $('.error-course').addClass('alert-success');
                        $('.error-course').removeClass('hidden');
                        $('.error-course').text(course_code + " have been added successfullly ");

                        var content = '<option value = "' + course_code + '"> ' + course_code + '</option>';                      
                        $('#course-detail').append(content);
                    }

                },
                error: function (data) {
                    $('.error-course').removeClass('hidden').show().html(data.responseJSON.error).delay(5000).fadeOut();
                }
            })
        }




    });
 
    $('#register-level').click(function(){
        var level = $('input[name=level]').val();

       
        if(level == ""){
            //alert(level);
             $('.error').removeClass('hidden');
             $('.error').text("Please enter a Level");
         } 
         else{
            var action = 'newlevel';
            $.ajax({
                type:'POST',
                url: '/admin/levcou',
                data:{
                    'action':action,
                    'level_name':level,
                     '_token': $('input[name=_token]').val(),
                },
                success:function(data){
                    if ((data.errors)) {
                        $('.error').removeClass('hidden');
                        $('.error').removeClass('alert-success');
                        $('.error').removeClass('alert-danger');
                        $('.error').addClass('alert-info');
                        $('.error').text('Level names must be unique');
                    } else {
                        $('.error').removeClass('hidden');
                        $('.error').removeClass('alert-danger');
                        $('.error').addClass('alert-success');
                        $('.error').text(data.level_name + " level has been added successfully");
                        setTimeout(function () {
                            location.reload()
                        }, 2000)

                    }
                   
                },
                error:function (data) {
                    $('.error').removeClass('hidden');
                    $('.error').text(data.responseJSON.error);
                }

            })


         }
    });


    $(document).on('click', '.delete-level', function (e) {
        e.preventDefault();
        //alert($(this).data('id'));
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('level-delete');
        $('.modal-title').text('Delete Level');
        $('.deleteContent').show();
        $('.did').text($(this).data('id'));
        //$('.lev').text($(this).data('name'));
        $('.form-horizontal').hide();
        $('.dname').html('Level ' + $(this).data('name'));
        $('.actionBtn').removeAttr(' data-dismiss');
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.level-delete', function () {
        var action = "delete_level";

        $.ajax({
            type: 'post',
            url: '/admin/levcou',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text(),
                'action': action
            },
            success: function (data) {
                $('.modal-error').removeClass('hidden');
                $('.modal-error').removeClass('alert-danger');
                $('.modal-error').addClass('alert-success');

                $('.modal-error').text("Selected Level have been deleted successfully");
                //$('#'+$('.lev').text()).remove();
                setTimeout(function () {
                    location.reload()
                }, 2000)


            }
        })

    });


    $(document).on('click', '.course-details', function () {

        var course_code = $('#course-detail').val();
        //alert(course_code);

        if(course_code == null){
            $('.detail-error').removeClass('hidden');
            $('.detail-error').addClass('alert-danger');
            $('.detail-error').text('Select a course to view its details');
        }
        else{
                $('.actionBtn').addClass('hidden');
                $('.modal-title').text('Course Details');
                $('.deleteContent').hide();
                $('.form-horizontal').show();
                $('#course-code').val(course_code);

                $.ajax({
                    type:'POST',
                    url: '/admin/levcou',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'course_code':course_code,
                        'action': 'course_detail'
                    },
                    success: function (data) {
                        $('.detail-error').addClass('hidden');    
                        $('#course-title').val(data.course_title); 
                        $('#course-semester').val(data.semester) ;
                        $('#course-level').val(data.level);
                        $('#course-unit').val(data.unit); 
                        $('#course-status').val(data.status);
                        $('#course-code').attr('disabled', '');          
                        $('#course-level').attr('disabled', '');  
                        $('#course-semester').attr('disabled', '');
                        $('#course-title').attr('disabled', '');
                        $('#course-unit').attr('disabled', '');
                        $('#course-status').attr('disabled', '');
                        $('#myModal').modal('show');
                    
                        //console.log(course_code);

                    }
                })
            }     

    });
  
    $(document).on('click', '.course-edit', function() {

        var course_code = $('#course-detail').val();

        if (course_code == null) {
            $('.detail-error').removeClass('hidden');
            $('.detail-error').addClass('alert-danger');
            $('.detail-error').text('Select a course to edit');
        }
        else{

            $('.actionBtn').removeClass('hidden');
            $('#footer_action_button').text("Update");
            $('#footer_action_button').addClass('glyphicon-check');
            $('#footer_action_button').removeClass('glyphicon-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').addClass('edit');
           
            $('.modal-title').text('Edit Course');
            $('.deleteContent').hide();
            $('.form-horizontal').show();            
            $('#course-code').val(course_code);

            $.ajax({
                type: 'POST',
                url: '/admin/levcou',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'course_code': course_code,
                    'action': 'course_detail'
                },
                success: function (data) {
                    //fill in the details in the modal
                    $('.detail-error').addClass('hidden');
                    $('#course-title').val(data.course_title);
                    $('#course-semester').val(data.semester);
                    $('#course-level').val(data.level);
                    $('#course-code').attr('disabled','');
                    $('#course-level').removeAttr('disabled');
                    $('#course-unit').removeAttr('disabled');
                    $('#course-semester').removeAttr('disabled');
                    $('#course-title').removeAttr('disabled');
                    $('.checkbox').removeClass('hidden');
                    $('.stat').addClass('hidden');
                    $('.actionBtn').removeAttr(' data-dismiss');
                    $('#myModal').modal('show');

                }
            });


        }     

       

    });

    $('.modal-footer').on('click', '.edit', function (e) {
        e.preventDefault();
        var action = "edit_course";

        let course_code = $('#course-code').val();
        let course_title = $('#course-title').val();
        let course_level = $('#course-level').val();
        let course_semester = $('#course-semester').val();
        let course_unit = $('#course-unit').val();
        let status = $('input[name=status]:checked').val();

        if (course_code == "" || course_title == "" || course_level == "" || course_semester == "" || course_unit == "" || status == "") {

            $('.modal-error').removeClass('alert-success');
            $('.modal-error').addClass('alert-danger');    
            $('.modal-error').removeClass('hidden');
            $('.modal-error').text("Please fill all the fields");

        }
        else{
                $.ajax({
                    type: 'post',
                    url: '/admin/levcou',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'course_code': course_code,
                        'course_title': course_title,
                        'course_level': course_level,
                        'course_semester': course_semester,
                        'course_unit': course_unit,
                        'status': status,
                        'action':action
                    },
                    success: function (data) {
                        $('.modal-error').removeClass('hidden');
                        $('.modal-error').removeClass("alert-danger");
                        $('.modal-error').addClass('alert-success');                  
                        $('.modal-error').text(data.course_code + " have been edited successfuly");
                    }
                });
            }
    });

    $(document).on('click', '.course-delete', function () {

        var course_code = $('#course-detail').val();
        if (course_code == null) {

            $('.detail-error').removeClass('alert-success');
            $('.detail-error').addClass('alert-danger');
            $('.detail-error').removeClass('hidden');
            $('.detail-error').text("Select a course to delete");

        } else {

        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete Course');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.dname').html(course_code);
        $('.actionBtn').removeAttr(' data-dismiss');
        $('#myModal').modal('show');

        }
    
    })

    $('.modal-footer').on('click', '.delete', function () {

        var action = "delete_course";
        var course_code = $('#course-detail').val();
       

            $.ajax({
                type: 'post',
                url: '/admin/levcou',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'course_code':course_code,
                    'action': action
                },
                success: function (data) {
                    $('.modal-error').removeClass('hidden');
                    $('.modal-error').removeClass("alert-danger");
                    $('.modal-error').addClass('alert-success');
                    $('.modal-error').text(data.course_code + " have been deleted successfuly");
                }
            });
         
    });
});