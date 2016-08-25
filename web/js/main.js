
function reinit(){
    $('.button-add-project').off('click');
    $('.glyphicon-trash').off('click');
    $('.glyphicon-pencil').off('click');
    $('.project-name').off('blur');

    $(document).ready(function () {
        $('.button-add-project').on('click',function () {
            $.ajax({
                url: "/web/index.php?r=tasks%2Fcreate",
                success: function(data){
                    $('.task-lists-div').append(data);
                    reinit();
                }
            })
        });
    });
    $('.glyphicon-trash').on('click',function(){
        var id=$(this).parents('.project').attr('id');
        var data='id='+id;
        $.ajax({
            url: "/web/index.php?r=tasks%2Fdelete",
            type:"GET",
            data:data,
            success: function(data){
                data=='deleted'?$('.project#'+id).remove():false;
            }
        });
    });

    $('.glyphicon-pencil').on('click',function(){
        var parent=$(this).parents('.project');
        var Input=parent.find('.project-name');
        Input.prop('disabled',false).focus();
    });

    $('.project-name').on('focus',function() {
        this.old_value=$(this).val();
    });

    $('.project-name').on('blur',function(){
        var currentVal=($(this).val());;
        if (currentVal==''){
            $(this).val(this.old_value);
        }else {
            var id = $(this).parents('.project').attr('id');
            $.ajax({
                url: "/web/index.php?r=tasks%2Fupdate",
                data: 'id=' + id + '&value=' + currentVal,
                success: function (data) {
                    alert(data);
                }
            })
        }
    })
}

reinit();