$(document).ready(function() {
//验证注册表单
    $("#register-form").validate({
        // debug:true,
        rules: {
            username: {
                required: true,
                minlength: 2,
                maxlength: 10,
                remote:{
                    url: '../Capstone/remote/remote_check_username.php',
                    type:'post',
                    data:{
                        username:function(){
                            return $("#username").val();
                        }
                    }
                }
            },
            email: {
                required: true,
                email: true,
                maxlength: 40,
                remote:{
                    url: '../Capstone/remote/remote_check_email.php',
                    type:'post',
                    data:{
                        email:function(){
                            return $("#email").val();
                        }
                    }
                }
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 16
            },
            confirm_password: {
                required: true,
                minlength: 6,
                maxlength: 16,
                equalTo: "#password"
            }
        },
        messages: {
          username: {
            remote: "The username is occupied."
          },
          email: {
              remote: "The email is occupied."
          }
        },
        errorPlacement: function(error, element) {
            element.next().remove(); //删除显示的√图标
            // 加上×图标
            element.after('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>');
            element.closest('.form-group').append(error); //显示错误消息提示
        },
        //给未通过验证的元素进行处理
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-feedback has-error');
        },
        //验证通过的处理
        success: function(label) {
            var el = label.closest('.form-group').find("input");
            el.next().remove(); //与errorPlacement相似，删除×图标
            el.after('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>');
            label.closest('.form-group').removeClass('has-error').addClass("has-feedback has-success");
            label.remove(); //删掉错误消息
        }
    })
});
