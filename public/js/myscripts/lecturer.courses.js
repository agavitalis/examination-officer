$(document).ready(function () {

  
    $('.view').click(function () {

        //I got these data from the button
        var course = $(this).data('course');
        var semester = $(this).data('semester');
        var session = $(this).data('session');
        var level = $(this).data('level');
        $.ajax({
            type: 'post',
            url: '/lecturer/l_courses',

            data: {
                '_token': $('input[name=_token]').val(),
                'course':course,
                'semester':semester,
                'session':session,
                'level': level,
            },
            dataType: 'JSON',
            success: function (data) {
                $('.dropdown-menu').html("");
                data.forEach(element => {
                    //check if he is a coordinator;
                    if (element.coordinator == 1){
                        var coordinator = "YES";
                    }
                    else{
                        var coordinator = "NO";
                    }
                    
                    $('.dropdown-menu').append("<li><a href='#'>" + element.lecturer_name + "  :" + element.lecturer_id + " Coordinator?:" + coordinator +"</a></li>")
                    });
                   //console.log(data);
                   
                }
    
            });
        });
    
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


   



})