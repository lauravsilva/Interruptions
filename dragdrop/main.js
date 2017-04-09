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

var position = sliderDiv.position()
    , sliderWidth = sliderDiv.width()
    , minX = position.left
    , maxX = minX + sliderWidth
    , tickSize = sliderWidth / range;
//the draggable object
$("#dragcircle").draggable({
    containment: "parent",
    drag: function (e, ui) {
        
//        $("body").css("background", "rgba(255, 255, 255, 1)");
//        $("body").css("background", "-moz-linear-gradient(left, rgba(255, 255, 255, 1) 0%, rgba(224, 224, 224, 1) 50%, rgba(254, 254, 254, 1) 100%)");
//        $("body").css("background", "-webkit-gradient(left top, right top, color-stop(0%, rgba(255, 255, 255, 1)), color-stop(50%, rgba(224, 224, 224, 1)), color-stop(100%, rgba(254, 254, 254, 1)))");
//        $("body").css("background", "-webkit-linear-gradient(left, rgba(255, 255, 255, 1) 0%, rgba(224, 224, 224, 1) 50%, rgba(254, 254, 254, 1) 100%)");
//        $("body").css("background", "-o-linear-gradient(left, rgba(255, 255, 255, 1) 0%, rgba(224, 224, 224, 1) 50%, rgba(254, 254, 254, 1) 100%)");
//        $("body").css("background", "-ms-linear-gradient(left, rgba(255, 255, 255, 1) 0%, rgba(224, 224, 224, 1) 50%, rgba(254, 254, 254, 1) 100%)");
//        $("body").css("background", "linear-gradient(to right, rgba(255, 255, 255, 1) 0%, rgba(224, 224, 224, 1) 50%, rgba(254, 254, 254, 1) 100%)");
//        $("body").css("filter","progid: DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#fefefe', GradientType=1)");
        
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
                $("body").css("background", "blue");
            }
            else if (val > 50 && val < 75) {
                result = option4;
                $("body").css("background", "green");
            }
            else if (val >= 75) {
                result = option5;
                $("body").css("background", "yellow");
            }
            else if (val < 50 && val > 25) {
                $("body").css("background", "orange");
                result = option2;
            }
            else {
                result = option1;
                $("body").css("background", "violet");
            }
            $("#result").text(result);
        }
    }
});
//Set slider as droppable
sliderDiv.droppable({
    //on drop 
    drop: function (e, ui) {
        if ($(".drag_me").length){
            $(".drag_me").css('visibility','hidden');
        }
        
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
            else if (val >= 75) {
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