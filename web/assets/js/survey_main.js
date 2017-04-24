var result = "";
var resValue = null;
var option1 = document.getElementById("op0").textContent;
var option2 = document.getElementById("op0").textContent;
var option3 = "neutral";
var option4 = document.getElementById("op1").textContent;
var option5 = document.getElementById("op1").textContent;

//Prepare the slider
var range = 100
    , sliderDiv = $("#slider")
    , sliderDivObj = $("#slider")[0];

// Activate the UI slider
sliderDiv.slider({
    orientation: "vertical"
    , min: 0
    , max: 100
    , step: 25
    , value: 50
    , create: function () {
        $(this).find(".ui-slider-handle").hide();
    }
});
var position = sliderDiv.position()
    , sliderWidth = sliderDiv.width()
    , minX = position.left
    , maxX = minX + sliderWidth
    , tickSize = sliderWidth / range;

//the draggable object
$("#drag-handle").draggable({
    containment: "parent"
    , drag: function (e, ui) {
        console.log("drag");
        var offset = $(this).offset();
        var containerPosition = offset.top;
        resValue = Math.round((containerPosition - minX) / tickSize);
        sliderDiv.slider("value", resValue);
        if (resValue == 50) {
            result = option3;
            $("body").css("background", "blue");
        }
        else if (resValue > 50 && resValue < 75) {
            result = option4;
            $("body").css("background", "green");
        }
        else if (resValue >= 75) {
            result = option5;
            $("body").css("background", "yellow");
        }
        else if (resValue < 50 && resValue > 25) {
            $("body").css("background", "orange");
            result = option2;
        }
        else if (resValue < 50) {
            result = option1;
            $("body").css("background", "violet");
        }
        $("#final_result").text(result);
    }
});

//Set slider as droppable
sliderDiv.droppable({
    //on drop 
    drop: function (e, ui) {
        if ($(".slider_label").length) {
            $(".slider_label").css('visibility', 'hidden');
        }

        console.log("drop");
        var finalMidPosition = $(ui.draggable).position().top;
        resValue = Math.round((finalMidPosition - minX) / tickSize);
        sliderDiv.slider("value", resValue);
        if (resValue == 50) {
            result = option3;
        }
        else if (resValue > 50 && resValue < 75) {
            result = option4;
        }
        else if (resValue >= 75) {
            result = option5;
        }
        else if (resValue < 50 && resValue > 25) {
            result = option2;
        }
        else if (resValue < 50) {
            result = option1;
        }
        //update result on page
        console.log(result + ": " + resValue + "%");
        //do ajax update here to set the position
        /*$.ajax({
         type: "POST",
         url: url,
         data: resValue,
         success: function () {
         //congrats
         },
         dataType: dataType
         });*/
        //        }
        $("#final_result").text(result);
        // $("#result").text(" ");
    }
});


// click of next button
// $('#next-btn').click(function () {
//     console.log("clicked");
//
//     // $.ajax({
//     //     type: "POST",
//     //     url: "survey_nextbtn.php",
//     //     data: { questionRes: resValue },
//     //     error: function () {
//     //         alert('error');
//     //     }
//     // }).done(function( msg ) {
//     //     alert( "Data Saved");
//     // });
//
//     //noinspection JSAnnotator
//     $.post('survey_nextbtn.php', {
//         resValue
//     }).done(function (data) {
//         // console.log("data: " + data);
//     }).fail(function (xhr, textStatus, errorThrown) {
//         console.log(xhr.responseText + "    error: " + errorThrown + "   text: " + textStatus);
//     });

// });

function nextButton(){
    $.ajax({
        type: "POST",
        url: 'survey_nextbtn.php',
        data:{action:'call_this', value: resValue},
        success:function(html) {
            // alert(html);
            location.reload();
        }

    });
}