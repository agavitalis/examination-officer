$(document).ready(function () {
    $(document).on('click', '.edit-modal', function () {
        $('#footer_action_button').text("Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#n').val($(this).data('name'));
        $('#myModal').modal('show');
    });
    $(document).on('click', '.delete-modal', function () {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.did').text($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.dname').html($(this).data('name'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function () {
         var action = "edit";
        $.ajax({
            type: 'post',
            url: '/admin/semses',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'session_name': $('#n').val(),
                'action':action
            },
            success: function (data) {
                $('.error').removeClass('hidden');
                $('.error').removeClass('alert-danger');
                $('.error').addClass('alert-success');

                $('.error').text(" Session successfully edited");
                setTimeout(function () {
                    location.reload()
                }, 2000)
            }
         });
    });

    $(document).on('click', '.set-current', function (e) {
        e.preventDefault();
        //alert($(this).data('id'));

        var action = "current";

        $.ajax({
            type:'post',
            url: '/admin/semses',
            data:{
                '_token': $('input[name=_token]').val(),
                'id': $(this).data('id'),
                'action':action
            },
            success:function(data) {
                $('.error').removeClass('hidden');
                $('.error').removeClass('alert-danger');
                $('.error').addClass('alert-success');
    
                $('.error').text(data.session_name + " has seen set as the current session");
                setTimeout(function() {
                    location.reload()
                },2000)
                
               
            }
        })
        
    });

    $("#add-session").click(function (e) {
            e.preventDefault();
            
        if ($('input[name=session-name]').val()==""){
             $('.error').removeClass('hidden');
             $('.error').text("Please input a session name");
        }else{
            var action ="create";

            $.ajax({
                type: 'post',
                url: '/admin/semses',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'session_name': $('input[name=session-name]').val(),
                    'action': action
                },
                success: function (data) {
                    if ((data.errors)) {
                        $('.error').removeClass('hidden');
                        $('.error').text('Please pick a unique session name');
                    } else {
                        $('.error').addClass('hidden');
                        $('#session-table').append("<tr class='item" + data.id + "'><td>" + data.session_name + "</td><td><button class='edit-modal btn btn-success' data-id='" + data.id + "' data-name='" + data.session_name + "'><span class='glyphicon glyphicon-check'></span> Set as current</button></td>   <td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.session_name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button></td> <td> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.session_name + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                    }
                    
                },

            });
            $('#name').val('');

      } 
    });
    $('.modal-footer').on('click', '.delete', function () {
         
        var action = "delete";
        

        $.ajax({
            type: 'post',
            url: '/admin/semses',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text(),
                'action':action
            },
            success: function (data) {
                //$('.item' + $('.did').text()).remove();
               // location.reload();
                $('.error').removeClass('hidden');
                $('.error').removeClass('alert-danger');
                $('.error').addClass('alert-success');
                $('.error').text(" Session successfully deleted");
                setTimeout(function () {
                    location.reload()
                }, 2000)
            }
        });
    });

    $(document).on('click', '#set-semester', function (e) {
        e.preventDefault();
      if ( $('#semester').val() == null){
            $('.semester-error').removeClass('hidden');
            $('.semester-error').text('Please select a semester from the options');
      }
      else{     

        var action = "setsemester";

        $.ajax({
            type: 'post',
            url: '/admin/semses',
            data: {
                '_token': $('input[name=_token]').val(),
                'semester_value': $('#semester').val(),
                'action': action
            },
            success: function (data) {
                if(data.success){
                    $('.semester-error').removeClass('hidden');
                    $('.semester-error').removeClass('alert-danger');
                    $('.semester-error').addClass('alert-success');
                    $('.semester-error').text(data.success);
                }else{

                    $('.semester-error').removeClass('hidden');
                    $('.semester-error').removeClass('alert-danger');
                    $('.semester-error').addClass('alert-success');
                    $('.semester-error').text(data.errors);
                }
               
                setTimeout(function () {
                    location.reload()
                }, 2000)


            }
        })

      }
    });
});
