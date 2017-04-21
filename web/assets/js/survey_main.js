var result = "";
var val = null;
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
        val = Math.round((containerPosition - minX) / tickSize);
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
        else if (val < 50) {
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
        if ($(".slider_label").length){
            $(".slider_label").css('visibility','hidden');
        }

        console.log("drop");
        var finalMidPosition = $(ui.draggable).position().top;
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
        else if (val < 50) {
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
        //        }
        $("#final_result").text(result);
        // $("#result").text(" ");
    }
});