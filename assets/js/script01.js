$(document).ready(function(){
    //Notification
    $('.comment-notify').click(function () {
        var id = $(this).data('id');
        var url = $('#comment-url').val();
        $.ajax({
            url:"/dashboard/redirectNotifyComment",
            method:"POST",
            data:{id:id},
            cache: false,
            success:function (data) {
                console.log('success');
                $('.comment-notify-wrapper').html(data);
                window.location.href= '/'+ url;
            }
        });
        event.preventDefault();
    });

    $('.new-task-notify').click(function () {
        var url = $('#comment-url').val();
        var project = $(this).data('project');
        $.ajax({
            url:"/dashboard/notifyNewTask",
            method:"POST",
            data:{project:project},
            cache: false,
            success:function () {
                console.log('success');
                window.location.href= '/'+ url;
            }
        });
        event.preventDefault();
    });

    $('.read-comment').click(function () {
        var id = $(this).data('id');
        $(this).prev('.comment-badge').css("visibility", "hidden");
        $.ajax({
            url:"/dashboard/readComment",
            method:"POST",
            data:{id:id},
            cache: false,
            success:function (data) {
                console.log('success');
            }
        });
        event.preventDefault();
    });

    //Toggle deadline
    $('.deadline-checkbox').click(function () {
        $(".task-deadline").toggle(this.checked);
    });
    //Deadline
    //DateTime Picker
    $('#picker-deadline').datetimepicker();

    $(".selected-urgency").on('change',function () {
        var urgency = $(this).val();
        var id = $(this).data('id');
        $(this).next('.urgency-spinner').css("display", "inline-block");
        $(this).css("width","80%");
        $.ajax({
            url:"/dashboard/updateUrgency",
            method:"POST",
            data:{urgency:urgency,id:id},
            dataType:"json",
            cache: false,
            success:function (data) {
                $('#urgency-type').html(data.urgency);
                $('#urgency-num').val(data.urgency_num);
                $('.urgency-spinner').hide();
                $('.selected-urgency').css("width","100%");
            }
        });
    });
    //User Profile
    $('.edit-profile-fname').click(function () {
        $('.profile-fname').hide();
        $('#user-fname').attr("type","text");
        event.preventDefault();
    });
    $('.edit-profile-lname').click(function () {
        $('.profile-lname').hide();
        $('#user-lname').attr("type","text");
        event.preventDefault();
    });


    $('.selected-status').change(function () {
        var status = $(this).val();
        var id = $(this).data('id');
        $(this).next('.status-spinner').css("display", "inline-block");
        $(this).css("width","80%");
        $.ajax({
            url:"/dashboard/updateStatus",
            method:"POST",
            data:{status:status,id:id},
            dataType:"json",
            success:function (data) {
                $('#status-type').html(data.status);
                $('#status-num').val(data.status_num);
                $('.status-spinner').hide();
                $('.selected-status').css("width","100%");
            }
        });
    });
    $('.selected-res').change(function () {
        var employee = $(this).val();
        var id = $(this).data('id');
        $(this).next('.responsible-spinner').css("display", "inline-block");
        $(this).css("width","80%");
        $.ajax({
            url:"/dashboard/updateResponsible",
            method:"POST",
            data:{employee:employee,id:id},
            dataType:"json",
            success:function (data) {
                $('#employee-name').html(data.employee_name);
                $('#employeeID').val(data.employee_id);
                $('.responsible-spinner').hide();
                $('.selected-res').css("width","100%");
            }
        });
    });
    //Task comment ajax
    $(document).on('click','.comment-task',function () {
        var id = $(this).attr("data-id");
        $.ajax({
            url:"/dashboard/getTaskComment",
            method:"POST",
            data:{id:id},
            success:function (data) {
                $('#comment-taskID').val(id);
                $('.task-comment-container').html(data);
            }
        });
    });

    $('#comment-task-form').submit(function () {
        $.ajax({
            url:"/dashboard/submit_task_comment",
            type:"POST",
            data:$('#comment-task-form').serialize(),
            success:function (data) {
                $('.task-comment-container').html(data);
                $('#comments').val("");
            },error:function () {
                alert('error');
            }
        });
        event.preventDefault();
    });
    // Alert JS
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 3000);
    //Profile photo preview
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-prv').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function(){
        readURL(this);
    });
    //Change password validation
    $("#create-cpass").keyup(function(){
        if( $('#create-cpass').val() != $('#create-pass').val() ){
            $("#create-cpass").css("border-bottom-color", "red");
            $("#create-cpass").css("border-bottom-color", "red");
            $(".password-error-div").show();
            $(".password-error-div").html("*Password and Confirm Password field doest not match.");
            event.preventDefault();
        }else{
            $("#create-cpass").css("border-bottom-color", "#ced4da");
            $("#create-pass").css("border-bottom-color", "#ced4da");
            $(".password-error-div").hide();
        }
    });
    //Get user profile
    $(document).on('click','.editUserProfile',function () {
        var id = $(this).data("id");
        $.ajax({
            url:'/dashboard/getUserProfile',
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#user-firstname').val(data.firstname);
                $('#user-lastname').val(data.lastname);
                $('.user-id-edit').val(id);
            }
        });
    });
    //Edit user profile
    $('#edit-user-profile').submit(function () {
        $.ajax({
            url:'/dashboard/edit_user_profile',
            method:"POST",
            data:$('#edit-user-profile').serialize(),
            success:function (data) {
                $('#editUser').modal("hide");
                $('.tbl-userlist').html(data);
                swal(
                    'Good job!',
                    'Update saved!',
                    'success'
                );
            }
        });
        event.preventDefault();
    });
    // Delete user profile
    $(document).on('click','.deleteUserProfile',function () {
        var id = $(this).data("id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this user profile!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url:'/dashboard/delete_user_profile',
                    method:"POST",
                    data:{id:id},
                    success:function (data) {
                        $('.tbl-userlist').html(data);
                        swal("Poof! User profile has been deleted!", {
                            icon: "success",
                        });
                    }
                });
            } else {
                swal("User profile is safe!");
    }
    });
    });
});

