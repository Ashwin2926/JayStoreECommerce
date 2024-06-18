$(document).ready(function(){
    save_record();
    save_user_record();
    login_user_record();
    add_cart();
});


//save contact_us record
function save_record(){

    $(document).on('click','#btn_cnt',function(){

        var name = $('#name').val();
        var email = $('#email').val();
        var subject = $('#subject').val();
        var message = $('#message').val();        

        if(name=="" || email=="" || subject=="" || message=="")
        {
            $('#error').html('Please fill in the Blanks');
        }
        else{
            $.ajax({
                url:'ajax/cnt.php',
                method:'post',
                data:{Name:name, Email:email, Subject:subject, Message:message},
                success:function(data)
                {
                    $('#success').html(data);
                    $('form').trigger('reset');
                    $('#error').html('');
                }
            })
        }
    })
}



//save customer/user record
function save_user_record(){

    $(document).on('click','#btn_register',function(){

        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var address = $('#address').val();
        var city = $('#city').val();
        var state = $('#state').val();
        var zipcode = $('#zipcode').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var cpassword = $('#cpassword').val();

        if(first_name=="" || last_name=="" || address=="" || city=="" || state=="" || zipcode=="" || phone=="" || email=="" || password=="" || cpassword=="")
        {
            $('#error').html('Please fill in the Blanks');
        }

        if(password!=cpassword){
            $('#error').html('Password Not Matched');
        }
        else{
            $.ajax({
                url:'ajax/user_register.php',
                method:'post',
                data:{first_name:first_name,last_name:last_name,address:address,city:city,state:state,zipcode:zipcode,phone:phone,email:email,password:password},
                success:function(data)
                {
                    $('#success').html(data);
                    $('form').trigger('reset');
                    $('#error').html('');
                }
            })
        }
    })
}


//login customer/user account
function login_user_record(){

    $(document).on('click','#btn_login',function(){

        var email = $('#email').val();
        var password = $('#password').val();

        if(email=="" || password=="")
        {
            $('#error').html('Please fill in the Blanks');
        }
        else{
            $.ajax({
                url:'ajax/login_user.php',
                method:'post',
                data:{Email:email,Password:password},
                success:function(data)
                {

                    if(data=='valid')
                    {
                        $('form').trigger('reset');
                        $('#error').html('');
                        window.location.href='index.php';
                    }
                    if(data=='invalid')
                    {
                        $('#error').html('Password or Email Incorrect');
                    }
                }
            })
        }
    })
}
