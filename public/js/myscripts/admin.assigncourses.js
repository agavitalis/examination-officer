$(document).ready(function(){

    $('#assign-course').click(function(){
        //check if all the fields are seleted
        //alert($('#lecturer').val())

        if ($('input[name=coordinator]:checked').val() == undefined || $('#lecturer').val() == null || $('#course').val() == null|| $('#semester').val()== null ||  $('#session').val() == null || $('#level').val() == null){

            $('.error').removeClass('hidden');
            $('#error').text("Please Select a Lecturer and Fill all the fields to assign");

        }else{
         
            // alert ($('input[name=coordinator]:checked').val());
             $.ajax({
                type:'POST',
                 url:'/admin/assigncourses',
                data:{

                    '_token': $('input[name=_token]').val(),
                    'course':$('#course').val(),
                    'lecturer':$('#lecturer').val(),
                    'semester': $('#semester').val(),
                    'level': $('#level').val(),
                    'session': $('#session').val(),
                    'coordinator': $('input[name=coordinator]:checked').val(),
                    'action':'assigncourse'
                    },
                success:function(data) {

                    if(data.message){
                        $('.error').removeClass('hidden');
                        $('.error').removeClass('alert-danger');
                        $('.error').removeClass('alert-success');
                        $('.error').addClass('alert-info');
                        $('#error').text(data.message); 
                    }
                    
                    else{
                        
                        $('.error').removeClass('hidden');
                        $('.error').removeClass('alert-danger');
                        $('.error').removeClass('alert-info');
                        $('.error').addClass('alert-success');
                        $('#error').text(data.lecturer + "  have been assigned the course: " + data.course);
                        setTimeout(function () {
                            location.reload()
                        }, 2000)


                    }
                 }
             })
        }
    })

    //make coordinator starts here

    $(document).on('click', '.make-coordinator', function () {
        $('#footer_action_button').text("Proceed");
        $('.actionBtn').addClass('coordinator');
        $('.actionBtn').addClass('btn-success');
        $('.modal-title').text('Make Course Co-ordinator');
        $('.contents').html("You are about to assign a new course coordinator, this action will delete any coodinator previously assigned. Do you want to continue?");
        $('.deleteContent').show();
        $('.form-horizontal').hide();

        $('.did').text($(this).data('id'));
        $('.dname').text($(this).data('name'));
        $('.dlevel').text($(this).data('level'));
        $('.dcode').text($(this).data('code'));
        $('.dsession').text($(this).data('session'));

        $('#myModal').modal('show');
    });


    $('.modal-footer').on('click', '.coordinator', function () {
       
        $.ajax({
            type: 'post',
            url: '/admin/assigncourses',
            
            data: {
                '_token': $('input[name=_token]').val(),
                'lecturer_id': $('.did').text(),
                'lecturer_name': $('.dname').text(),
                'level': $('.dlevel').text(),
                'course_code': $('.dcode').text(),
                'session': $('.dsession').text(),
                'action': "coordinator",
            },
            dataType:'JSON',
            success: function (data) {
                $('.assign-message').removeClass('hidden');
                $('.assign-message').removeClass("alert-danger");
                $('.assign-message').addClass('alert-success');
                $('.assign-message').text(data.message);
            }
           
        });
    });

    //Unassign as the coordinator
    $(document).on('click', '.unassign', function () {
        $('#footer_action_button').text("Yes,Unassign");
        $('.actionBtn').addClass('unassign-course');
        $('.actionBtn').addClass('btn-success');
        $('.modal-title').text('Unassign Lecturer a Course');
        $('.contents').html("You are about to unassign, a course from a lecturer, Do you want to continue?")
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        
        // I passed these details to the modal
        $('.did').text($(this).data('id'));
        $('.dname').text($(this).data('name'));
        $('.dlevel').text($(this).data('level'));
        $('.dcode').text($(this).data('code'));
        $('.dsession').text($(this).data('session'));

        $('#myModal').modal('show');
    });


    $('.modal-footer').on('click', '.unassign-course', function () {

        //alert($('.dlevel').text())
        $.ajax({
            type: 'post',
            url: '/admin/assigncourses',

            data: {
                '_token': $('input[name=_token]').val(),
                'lecturer_id': $('.did').text(),
                'lecturer_name': $('.dname').text(),
                'level': $('.dlevel').text(),
                'course_code': $('.dcode').text(),
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