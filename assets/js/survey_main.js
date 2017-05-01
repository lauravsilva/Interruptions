var result = "";
var resValue = 50;
var option1 = document.getElementById("op0").textContent;
var option2 = document.getElementById("op1").textContent;
var option3 = document.getElementById("op2").textContent;
var option4 = document.getElementById("op3").textContent;
var option5 = document.getElementById("op4").textContent;

var halfHandleHeight = 60;

$(document).ready(function(){
    // $("#up-arrow").effect("bounce", "slow");
});


//Prepare the slider
var range = 100
    , sliderDiv = $("#slider");

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
    , sliderHeight = sliderDiv.height()
    , minY = position.top
    , maxY = minY + sliderHeight
    , tickSize = sliderHeight / range;

//the draggable object
$("#drag-handle").draggable({
    containment: "parent",
    axis: "y"
    , drag: function (e, ui) {

        $("#drag-handle").fadeTo(300, 0.7, function(){
            $("#drag-handle").css("background", "#020b11");
        });
        if ($(".slider-label").length) {
            $(".slider-label").fadeOut("800", function(){
                $(".slider-label").css('visibility', 'hidden');
            });
        }

        var offset = $(this).offset();
        var containerTop = offset.top;
        resValue = Math.round((containerTop - minY - halfHandleHeight) / tickSize);


        sliderDiv.slider("value", resValue);

        //TODO: adjust these numbers to make more sense
        if (resValue === 50) {
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
        $("#final_result").text(result);
    }
});

//Set slider as droppable
sliderDiv.droppable({
    //on drop 
    drop: function (e, ui) {
        $("#drag-handle").fadeTo(300, 1.0, function(){
            $("#drag-handle").css("background", "#020b11");
            // $("#drag-handle").css('opacity', '1.0');
        });
        // $("#drag-handle").fadeTo(800, 1.0, function(){
        //     $(this).css("background", "#020b11");
        //     $(this).css('opacity', '1.0');
        // });
        if ($("#next-text").length){
            $("#next-text").fadeIn("800", function(){
                $("#next-text").css('opacity', '1.0');
            });
        }

        var finalMidPosition = $(ui.draggable).position().top;
        resValue = Math.round((finalMidPosition - minY + halfHandleHeight) / tickSize);

        sliderDiv.slider("value", resValue);

        if (resValue === 50) {
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

        $("#final_result").text(result);
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
        data:{
            action:'call_this',
            value: resValue
        },
        success:function(html) {
            location.reload();
        }

    });
}