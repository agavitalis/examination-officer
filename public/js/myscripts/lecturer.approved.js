$(document).ready(function(){
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
            url: '/lecturer/approved_courses',

            data: {
                '_token': $('input[name=_token]').val(),
                'username': username,
                'semester': semester,
                'session': session,
                'level': level,
                'action':'details'
            },
            dataType: 'JSON',
            success: function (data) {
                //clear the modal
                $('.vita').html("");
                //set the modal header
                $('.modal-title').text(name + '    Course Registration Details');
                //inject data to the table
                data.forEach(element => {
                  //console.log(element.course_code)
                    $('.vita').append("<tr><td>" + element.course_code + "</td><td>" + element.course_title + "</td><td>" + element.unit + "    Unit</td></tr>");
                });
            
               //then show the modal
                $('#myModal').modal('show');
            

            }
            
        })
    })

    


   

})