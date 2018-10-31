$(document).ready(function () {
    
    $('.view').click(function () {
        //alert($(this).data('username'))
        //I got these data from the button
        var name = $(this).data('name');
        var username = $(this).data('username');
        var semester = $(this).data('semester');
        var session = $(this).data('session');
        var level = $(this).data('level');

        $.ajax({
            type: 'post',
            url: '/lecturer/students_results',

            data: {
                '_token': $('input[name=_token]').val(),
                'username': username,
                'semester': semester,
                'session': session,
                'level': level,
                'action': 'details'
            },
            dataType: 'JSON',
            success: function (data) {
                //clear the modal
                $('.vita').html("");
                //set the modal header
                $('.modal-title').text(name +'  '+ session + '    Result Details');
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