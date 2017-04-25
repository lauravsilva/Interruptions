var result = "";
var resValue = null;
var option1 = document.getElementById("op0").textContent;
var option2 = document.getElementById("op0").textContent;
var option3 = "neutral";
var option4 = document.getElementById("op1").textContent;
var option5 = document.getElementById("op1").textContent;

var halfHandleHeight = 50/2;

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

        var offset = $(this).offset();
        var containerTop = offset.top;
        resValue = Math.round((containerTop - minY + halfHandleHeight) / tickSize);

        console.log("containerTop: " + containerTop);
        console.log("resValue drag: " + resValue);

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
        $("#final_result").text(result);
    }
});

//Set slider as droppable
sliderDiv.droppable({
    //on drop 
    drop: function (e, ui) {
        if ($(".slider-label").length) {
            $(".slider-label").fadeOut("800", function(){
                $(".slider-label").css('visibility', 'hidden');
            });
        }
        if ($("#next-text").length){
            $("#next-text").fadeIn("800", function(){
                $("#next-text").css('opacity', '1.0');
            });
        }

        var finalMidPosition = $(ui.draggable).position().top;
        resValue = Math.round((finalMidPosition - minY + halfHandleHeight) / tickSize);

        console.log("finalMid: " + finalMidPosition);
        console.log("resValue drop: " + resValue);


        sliderDiv.slider("value", resValue);

        if (resValue === 50) {
            result = option3;
            $("#drag-handle").fadeTo(500, 0.8, function(){
                $(this).css("background", "#020b11");
            });
        }
        else if (resValue > 50 && resValue < 75) {
            result = option4;
            $("#drag-handle").fadeTo(500, 0.8, function(){
                $(this).css("background", "#26c5c4");
            });
        }
        else if (resValue >= 75) {
            result = option5;
            $("#drag-handle").fadeTo(500, 0.8, function(){
                $(this).css("background", "#122f3d");
            });
        }
        else if (resValue < 50 && resValue > 25) {
            result = option2;
            $("#drag-handle").fadeTo(500, 0.8, function(){
                $(this).css("background", "#26c5c4");
            });
        }
        else if (resValue < 50) {
            result = option1;
            $("#drag-handle").fadeTo(500, 0.8, function(){
                $(this).css("background", "#122f3d");
            });
        }
        //update result on page
        // console.log(result + ": " + resValue + "%");



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
        data:{
            action:'call_this',
            value: resValue
        },
        success:function(html) {
            // alert(html);
            location.reload();
        }

    });
}