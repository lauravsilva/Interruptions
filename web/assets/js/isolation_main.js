function submitButton(){
    $("#completeUserBtn").click(function(){
        console.log("fehsehrdgd");
        $.post(
            'isolation_submit.php',
            $("#completeUserForm").serialize(),
            function(data){
                // alert(data);
            }).done(function(){
                window.location.replace('/web/templates/complete.html');
        }).fail(function(){
            alert("ERROR");
        });
    });
}