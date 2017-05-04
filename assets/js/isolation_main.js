var selectedColor = '';
    $("#selectable").selectable({
        selecting: function (event, ui) {
            if ($(".ui-selected, .ui-selecting").length > 1) {
                $(ui.selecting).removeClass("ui-selecting");
            }
        },
        selected: function(event, ui){
            selectedColor = $(ui.selected).data('color');
            // console.log("color is: #" + selectedColor);
        }
    });


function submitButton() {
    var formData = $("#completeUserForm").serialize();
    formData += '&color='+selectedColor;

    $("#completeUserBtn").click(function () {
        $.post(
            'isolation_submit.php',
            formData,
            function (data) {
                console.log(formData);
                // alert(data);
            }).done(function () {
                console.log("done");
                window.location.replace('complete.php');
        }).fail(function () {
            alert("Error submitting data");
        });
    });
}
