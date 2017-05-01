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
                // alert(data);
            }).done(function () {
            window.location.replace('complete.php');
        }).fail(function () {
            alert("ERROR");
        });
    });
}

// function submitButton() {
//     $("#completeUserBtn").click(function () {
//         $.post(
//             'isolation_submit.php',
//             $("#completeUserForm").serialize(),
//             function (data) {
//                 // alert(data);
//             }).done(function () {
//             window.location.replace('/templates/complete.html');
//         }).fail(function () {
//             alert("ERROR");
//         });
//     });
// }