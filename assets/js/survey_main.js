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

    var headerHeight = $("#header").height();
    console.log("header: " + headerHeight);

    var heightToSet = $(window).height() - headerHeight;
    console.log("$(window).height() " + $(window).height());
    console.log("heightToSet " + heightToSet);

    $("#slider").css("height",heightToSet + "px");


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

        $("#drag-handle").css("background", "#020b11");
        $("#drag-handle").css("opacity", "0.7");

        if ($(".slider-label").length) {
            $(".slider-label").fadeOut("800", function(){
                $(".slider-label").css('visibility', 'hidden');
            });
        }

        var offset = $(this).offset();
        var containerTop = offset.top;
        resValue = Math.round((containerTop - minY + halfHandleHeight) / tickSize);

        sliderDiv.slider("value", resValue);

        //TODO: adjust these numbers to make more sense
        if (resValue <= 30) {
            result = option1;
        }
        else if (resValue >= 21 && resValue <= 50) {
            result = option2;
        }
        else if (resValue >= 51 && resValue <= 60) {
            result = option3;
        }
        else if (resValue >= 61 && resValue <= 80) {
            result = option4;
        }
        else if (resValue >= 81 && resValue <= 100) {
            result = option5;
        }

        $("#final_result").text(result);
    }
});

//Set slider as droppable
sliderDiv.droppable({
    //on drop 
    drop: function (e, ui) {
        // $("#drag-handle").fadeIn(900, function(){
            // $("#drag-handle").css("background", "#020b11");
            $("#drag-handle").css('opacity', '1.0');
        // });
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

        if (resValue <= 30) {
            result = option1;
        }
        else if (resValue >= 21 && resValue <= 50) {
            result = option2;
        }
        else if (resValue >= 51 && resValue <= 60) {
            result = option3;
        }
        else if (resValue >= 61 && resValue <= 80) {
            result = option4;
        }
        else if (resValue >= 81 && resValue <= 100) {
            result = option5;
        }
        //update result on page
        console.log(result + ": " + resValue + "%");

        $("#final_result").text(result);
    }
});


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