$(document).ready(function () {

    $('.reject').click(function () {

       // alert($(this).data('lecturer'))
        //I got these data from the button
        var lecturer = $(this).data('lecturer');
        var course_code = $(this).data('course');
        var semester = $(this).data('semester');
        var session = $(this).data('session');
        var level = $(this).data('level');

        $.ajax({
            type: 'post',
            url: '/admin/approveresults',

            data: {
                '_token': $('input[name=_token]').val(),
                'lecturer': lecturer,
                'course_code': course_code,
                'semester': semester,
                'session': session,
                'level': level,
                'action': 'reject'
            },
            dataType: 'JSON',
            success: function (data) {
                //clear the modal
                $('.error').removeClass('hidden');
                $('.error').text(data.success);
                //console.log(data)



            }

        })
    })

    $('.approve').click(function () {

        // alert($(this).data('lecturer'))
        //I got these data from the button
        var lecturer = $(this).data('lecturer');
        var course_code = $(this).data('course');
        var semester = $(this).data('semester');
        var session = $(this).data('session');
        var level = $(this).data('level');

        $.ajax({
            type: 'post',
            url: '/admin/approveresults',

            data: {
                '_token': $('input[name=_token]').val(),
                'lecturer': lecturer,
                'course_code': course_code,
                'semester': semester,
                'session': session,
                'level': level,
                'action': 'approve'
            },
            dataType: 'JSON',
            success: function (data) {
                //clear the modal
                $('.error').removeClass('hidden');
                $('.error').text(data.success);
                //console.log(data)



            }

        })
    })

    $('.view').click(function () {
        //alert($(this).data('username'))
        //I got these data from the button
        var lecturer = $(this).data('lecturer');
        var course_code = $(this).data('course');
        var semester = $(this).data('semester');
        var session = $(this).data('session');
        var level = $(this).data('level');

        $.ajax({
            type: 'post',
            url: '/admin/approveresults',

            data: {
                '_token': $('input[name=_token]').val(),
                'lecturer': lecturer,
                'course_code': course_code,
                'semester': semester,
                'session': session,
                'level': level,
                'action': 'view'
            },
            dataType: 'JSON',
            success: function (data) {
                //clear the modal
                $('.vita').html("");
                //set the modal header
                $('.modal-title').text(course_code + ',  ' + session + '    Result Details');
                //inject data to the table
                data.forEach(element => {
                    //console.log(element.course_code)
                    $('.vita').append("<tr><td>" + element.name + "</td><td>" + element.username + "</td><td>" + element.course_code + "</td><td>" + element.course_title + "</td><td>" + element.session + "</td><td>" + element.semester + "</td><td>" + element.ca_score + "</td><td>" + element.exam_score + "</td><td>" + element.total_score + "</td><td>" + element.grade + "</td></tr>");
                });

                //then show the modal
                $('#myModal').modal('show');


            }

        })
    })

})