$(document).ready(function () {
  
    $('.reject').click(function () {

       // alert($(this).data('username'))
        //I got these data from the button
        var name = $(this).data('name');
        var username = $(this).data('username');
        var semester = $(this).data('semester');
        var session = $(this).data('session');
        var level = $(this).data('level');

        $.ajax({
            type: 'post',
            url: '/lecturer/course_results',

            data: {
                '_token': $('input[name=_token]').val(),
                'username': username,
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
                // console.log(data)



            }

        })
    })

})