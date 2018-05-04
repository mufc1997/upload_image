var url = window.location.origin;
var editFile = function(id) {
    $('#fileForm').attr({
        action: `${url}/edit/${id}`
    });
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
}

var uploadProject = function() {
    $('#projectForm').attr({
        action: `${url}/addproject`
    });
}