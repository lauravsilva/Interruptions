function submitButton(){
    $("#completeUserBtn").click(function(){
        $.post(
            'isolation_submit.php',
            $("#completeUserForm").serialize(),
            function(data){
                // alert(data);
            }).done(function(){
                window.location.replace('/templates/complete.html');
        }).fail(function(){
            alert("ERROR");
        });
    });
}