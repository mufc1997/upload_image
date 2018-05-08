var url = window.location.origin;
var editFile = function(id) {
    $('#fileForm').attr({
        action: `${url}/edit/${id}`
    });

    $.ajax({
        method : "GET",
        url : `${url}/getData/${id}`,
        dataType : "json",
        success : function(data) {
            $('#fileNameInput').val(data.name)
        },
        error : function(e) {
            console.info("Error");
        },
        done : function(e) {
            console.info("DONE");
        }
    })
}

var editProject = function(id) {
    console.log();
    $('#projectForm').attr({
        action: `${url}/editProject/${id}`
    });
}

var uploadFile = function(id) {
    $('#fileForm').attr({
        action: `${url}/upload`
    });

    $('#fileNameInput').val("");
}

var uploadProject = function() {
    $('#projectForm').attr({
        action: `${url}/addproject`
    });
}