 $(document).ready(function () {
 
    $('.promote-lev').click(function () {
    
         //I got these data from the button
        var from_level = $('#from_level').val()
        var to_level = $('#to_level').val()
        
        if(to_level == null || from_level == null ){

            $('.message').removeClass('hidden');
            $('.message-p').removeClass('alert-success');
            $('.message-p').addClass('alert-danger');
            $('.message-p').text('Please fill all fields');
        }
        else if(to_level == from_level ) {

            $('.message').removeClass('hidden');
            $('.message-p').removeClass('alert-success');
            $('.message-p').addClass('alert-danger');
            $('.message-p').text('You cannot promote from a level to the same level');
        }
        else{

            $.ajax({
            type: 'post',
            url: '/admin/promote_students',

                data: {
                    '_token': $('input[name=_token]').val(),
                    'from_level': from_level,
                    'to_level': to_level,
                    'action': 'promote_level'

                },
                dataType: 'JSON',
                success: function (data) {

                    $('.message').removeClass('hidden');
                    $('.message-p').removeClass('alert-danger');
                    $('.message-p').addClass('alert-success');
                    $('.message-p').text(data.message);

                }

            })
        


        }

    })

    $('.demote-lev').click(function () {

         //I got these data from the button
         var from_level = $('#from_level').val()
         var to_level = $('#to_level').val()

         if (to_level == null || from_level == null) {

             $('.message').removeClass('hidden');
             $('.message-p').removeClass('alert-success');
             $('.message-p').addClass('alert-danger');
             $('.message-p').text('Please fill all fields');
         } else if (to_level == from_level) {

             $('.message').removeClass('hidden');
             $('.message-p').removeClass('alert-success');
             $('.message-p').addClass('alert-danger');
             $('.message-p').text('You cannot demote from a level to the same level');
         } else {

             $.ajax({
                 type: 'post',
                 url: '/admin/promote_students',

                 data: {
                     '_token': $('input[name=_token]').val(),
                     'from_level': from_level,
                     'to_level': to_level,
                     'action': 'demote_level'

                 },
                 dataType: 'JSON',
                 success: function (data) {

                     $('.message').removeClass('hidden');
                     $('.message-p').removeClass('alert-danger');
                     $('.message-p').addClass('alert-success');
                     $('.message-p').text(data.message);

                 }

             })



         }

    })

    $('.promote-ind').click(function () {

        //I got these data from the button
        var reg_no = $('#reg_no').val()
        var to_level = $('#level').val()

        if (to_level == null || reg_no == null) {

            $('.messag').removeClass('hidden');
            $('.messag-p').removeClass('alert-success');
            $('.messag-p').addClass('alert-danger');
            $('.messag-p').text('Please fill all fields');
        }
        else {

            $.ajax({
                type: 'post',
                url: '/admin/promote_students',

                data: {
                    '_token': $('input[name=_token]').val(),
                    'reg_no': reg_no,
                    'to_level': to_level,
                    'action': 'promote_per'

                },
                dataType: 'JSON',
                success: function (data) {

                    $('.messag').removeClass('hidden');
                    $('.messag-p').removeClass('alert-danger');
                    $('.messag-p').addClass('alert-success');
                    $('.messag-p').text(data.message);

                }

            })



        }

    })

    $('.demote-ind').click(function () {

        //I got these data from the button
        var reg_no = $('#reg_no').val()
        var to_level = $('#level').val()

        if (to_level == null || reg_no == null) {

            $('.messag').removeClass('hidden');
            $('.messag-p').removeClass('alert-success');
            $('.messag-p').addClass('alert-danger');
            $('.messag-p').text('Please fill all fields');
        } else {

            $.ajax({
                type: 'post',
                url: '/admin/promote_students',

                data: {
                    '_token': $('input[name=_token]').val(),
                    'reg_no': reg_no,
                    'to_level': to_level,
                    'action': 'demote_per'

                },
                dataType: 'JSON',
                success: function (data) {

                    $('.messag').removeClass('hidden');
                    $('.messag-p').removeClass('alert-danger');
                    $('.messag-p').addClass('alert-success');
                    $('.messag-p').text(data.message);

                }

            })



        }

    })

})