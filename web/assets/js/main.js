function createUser(userKey, name, color, email) {
    //    var html = "";
    //    $.ajax({
    //        type: "POST"
    //        , url: "../classes/DB.class.php"
    //        , data: {
    //            key: userKey,
    //            name: name,
    //            color: color,
    //            email: email
    //        }
    //        , error: function () {
    //            alert('Unable to load');
    //        }
    //        , success: function (data) {
    //            console.log(data);
    //        }
    //    });
    $.post('favorites.php', {
        storyName, storyURL
    }).done(function (data) {
        console.log("data: " + data);
    }).fail(function (xhr, textStatus, errorThrown) {
        console.log(xhr.responseText + "    error: " + errorThrown + "   text: " + textStatus);
    }).always(function () {
        console.log("finished");
    });
}