var selectedColor = '';
    $("#selectable").selectable({
        selecting: function (event, ui) {
            if ($(".ui-selected, .ui-selecting").length > 1) {
                $(ui.selecting).removeClass("ui-selecting");
            }
        },
        selected: function(event, ui){
            selectedColor = $(ui.selected).data('color');
        }
    });


function submitButton() {
        // var formData = $("#completeUserForm").serialize();
        // formData += '&color='+selectedColor;
        $.post(
            'isolation_submit.php',
            $("#completeUserForm").serialize()+'&color='+selectedColor)
            .success(function(response){
                console.log(response);
                if (response == "error"){
                    window.location.replace('isolation.php');
                }
                else {
                    window.location.replace('complete.php');
                }
            }).done(function (data) {
                // console.log("done");
        }).fail(function () {
            alert("Error submitting data");
        });
}
