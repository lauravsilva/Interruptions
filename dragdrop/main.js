var result = "";
var val = null;
var option1 = "very relieved";
var option2 = "relieved";
var option3 = "neutral";
var option4 = "disappointed";
var option5 = "very disappointed";
//Prepare the slider
var range = 100
    , sliderDiv = $("#slider")
    , sliderDivObj = $("#slider")[0];
// Activate the UI slider
sliderDiv.slider({
    min: 0
    , max: 100
    , step: 25
    , create: function () {
        $(this).find(".ui-slider-handle").hide();
    }
});
//noUiSlider.create(sliderDivObj, {
//    start: [50],
//    range: {
//        'min': [0],
//        'max': [100]
//    }
//});
var position = sliderDiv.position()
    , sliderWidth = sliderDiv.width()
    , minX = position.left
    , maxX = minX + sliderWidth
    , tickSize = sliderWidth / range;
//the draggable object
$("#dragcircle").draggable({
    drag: function (e, ui) {
        var offset = $(this).offset();
        var circleXPos = offset.left;
        var circleYPos = offset.top;
        var circleWidth = Math.round($(this).width() / 2);
        var circlePosition = circleXPos + circleWidth
        if (circlePosition >= minX && circlePosition <= maxX) {
            val = Math.round((circlePosition - minX) / tickSize);
            sliderDiv.slider("value", val);
            if (val == 50) {
                result = option3;
            }
            else if (val > 50 && val < 75) {
                result = option4;
            }
            else if (val > 75) {
                result = option5;
            }
            else if (val < 50 && val > 25) {
                result = option2;
            }
            else {
                result = option1;
            }
            $("#result").text(result);
        }
    }
});
//Set slider as droppable
sliderDiv.droppable({
    //on drop 
    drop: function (e, ui) {
        var finalMidPosition = $(ui.draggable).position().left + Math.round($("#dragcircle").width() / 2);
        //If within the slider's width, follow it along
        if (finalMidPosition >= minX && finalMidPosition <= maxX) {
            val = Math.round((finalMidPosition - minX) / tickSize);
            sliderDiv.slider("value", val);
            if (val == 50) {
                result = option3;
            }
            else if (val > 50 && val < 75) {
                result = option4;
            }
            else if (val > 75) {
                result = option5;
            }
            else if (val < 50 && val > 25) {
                result = option2;
            }
            else {
                result = option1;
            }
            //update result on page
            console.log(result + ": " + val + "%");
            //do ajax update here to set the position
            /*$.ajax({
                type: "POST",
                url: url,
                data: val,
                success: function () {
                    //congrats
                },
                dataType: dataType
            });*/
        }
        $("#final_result").text("I am " + result);
        $("#result").text(" ");
    }
});