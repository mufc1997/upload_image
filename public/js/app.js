var editFile = function(id) {
    $('#fileForm').attr({
        action: `http://shop.localhost/edit/${id}`
    });
}

var editProject = function(id) {
    $('#projectForm').attr({
        action: `http://shop.localhost/editProject/${id}`
    });
}

var uploadFile = function(id) {
    $('#fileForm').attr({
        action: `http://shop.localhost/upload`
    });
}

var uploadProject = function() {
    $('#projectForm').attr({
        action: `http://shop.localhost/addproject`
    });
}