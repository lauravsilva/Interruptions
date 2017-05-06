var result = "";
var resValue = "";
var percentValue = "";

var option1 = document.getElementById("op0").textContent;
var option2 = document.getElementById("op1").textContent;
var option3 = document.getElementById("op2").textContent;
var option4 = document.getElementById("op3").textContent;
var option5 = document.getElementById("op4").textContent;

//TODO: change handle height to dynamic
var halfHandleHeight = $('#drag-handle').height()/2;
var sliderheightDynamic = 400;
var sliderSectionsHeight = 0;
var headerHeight;

//Prepare the slider
// var range = sliderheightDynamic
//     , sliderDiv = $("#slider")
//     , position = sliderDiv.position()
//     , minY = position.top
//     , maxY = minY + sliderheightDynamic
//     , tickSize = sliderheightDynamic / range;




$(document).ready(function(){
    // $("#up-arrow").effect("bounce", "slow");

    headerHeight = $("#header").height();
    console.log("header " + headerHeight);

    // sliderheightDynamic = $(window).height() - headerHeight;
    sliderheightDynamic = $(window).height() - headerHeight;
    console.log("$(window).height() " + $(window).height());
    console.log("sliderheightDynamic " + sliderheightDynamic);

    sliderSectionsHeight = sliderheightDynamic/5;
    console.log("sliderSectionsHeight " + sliderSectionsHeight);

    console.log("halfHandleHeight " + halfHandleHeight);

    $("#slider").css("height",sliderheightDynamic);



    console.log("input " + input);
    console.log("low " + low);
    console.log("high " + high);


    console.log("slider offset " + $("#slider").offset().top);


});


var sliderDiv = $("#slider")
    , input = sliderheightDynamic
    , low = $("#header").height() + halfHandleHeight + 5
    , high = $(window).height() - halfHandleHeight - 20
    , min = 0
    , max = 99;



// Activate the UI slider
sliderDiv.slider({
    orientation: "vertical"
    , min: min
    , max: max
    // , step: step
    // , value: 50
    , create: function () {
        $(this).find(".ui-slider-handle").hide();
    }
});



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
        var handleToTop = offset.top;

        resValue = Math.ceil(handleToTop + halfHandleHeight + halfHandleHeight);
        percentValue = linear(resValue, low, high, min, max);

        if (percentValue < 0){
            percentValue = 0
        }
        else if (percentValue > 99){
            percentValue = 99
        }


        // console.log("container top: " + handleToTop);
        // console.log("resValue: " + resValue);
        // console.log("percentValue " + percentValue);


        sliderDiv.slider("value", percentValue);

        if (percentValue <= 20) {
            result = option1;
        }
        else if (percentValue >= 21 && percentValue <= 50) {
            result = option2;
        }
        else if (percentValue >= 51 && percentValue <= 60) {
            result = option3;
        }
        else if (percentValue >= 61 && percentValue <= 80) {
            result = option4;
        }
        else if (percentValue >= 81 && percentValue <= 100) {
            result = option5;
        }

        $("#final_result").text(result);
    }
});

//Set slider as droppable
sliderDiv.droppable({
    //on drop
    drop: function (e, ui) {
        $("#drag-handle").css('opacity', '1.0');

        if ($("#next-text").length){
            $("#next-text").fadeIn("800", function(){
                $("#next-text").css('opacity', '1.0');
            });
        }

        var finalMidPosition = $(ui.draggable).position().top;
        resValue = Math.round((finalMidPosition - min + halfHandleHeight));
        percentValue = linear(resValue, low, high, min, max);

        if (percentValue < 0){
            percentValue = 0
        }
        else if (percentValue > 99){
            percentValue = 99
        }

        sliderDiv.slider("value", resValue);
        // console.log(resValue);
        // console.log(percentValue);

        if (percentValue <= 20) {
            result = option1;
        }
        else if (percentValue >= 21 && percentValue <= 50) {
            result = option2;
        }
        else if (percentValue >= 51 && percentValue <= 60) {
            result = option3;
        }
        else if (percentValue >= 61 && percentValue <= 80) {
            result = option4;
        }
        else if (percentValue >= 81 && percentValue <= 100) {
            result = option5;
        }
        //update result on page
        console.log(result + ": " + percentValue + "%");

        $("#final_result").text(result);
    }
});

function linear(input, low, high, min, max){
    return Math.ceil(min+(max-min)*(input-low)/(high-low));
}


function nextButton(){
    $.ajax({
        type: "POST",
        url: 'survey_nextbtn.php',
        data:{
            action:'call_this',
            value: percentValue
        },
        success:function(html) {
            location.reload();
        }

    });
}