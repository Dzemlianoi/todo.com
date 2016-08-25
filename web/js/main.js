$(document).ready(function () {
    $('.button-add-project').on('click',function () {
        $.ajax({
            url: "/web/index.php?r=tasks%2Fcreate",
            success: function(data){
                $('.task-lists-div').append(data);
            }
        })
    });
});
function deleteProject($id){
    var data='id='+$id;
    $.ajax({
        url: "/web/index.php?r=tasks%2Fdelete",
        type:"get",
        data:data,
        success: function(data){
            data=='deleted'?$('.project#'+$id).remove():false;
        }
    });
}
