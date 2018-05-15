

jQuery(document).ready(function($) {


    $(".btnReg").on("click",function () {
        var firstname = $(".firstname").val();
        var lastname = $(".lastname").val();
        var email = $(".email").val();

        $.ajax({
            type: 'POST',
            url:myVar.ajax_url,
            data: {
                action: 'my_ajax_hook',
                firstname : firstname,
                lastname : lastname,
                email : email,
            }, success: function (res) {
                $("#applicant-form")[0].reset();
                //var dataJson =  JSON.stringify(res.data.response);
                console.log(res.data.response.status);

                if(res.data.response.status == "Failed"){
                    $.each( res.data.response, function( key, value ) {
                        // alert( key + ": " + value );
                        $(".resultWrapper ul").append('<li style="color:red">'+value+'</li>');
                    });
                }else{
                    $(".resultWrapper ul").append('<li style="color:green">Success</li>');

                }
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });


    });




});