
function reinit(){
    $('.button-add-project').off('click');
    $('.head-buttons-div .glyphicon-trash').off('click');
    $('.head-buttons-div .glyphicon-pencil').off('click');
    $('.project-name').off('blur');
    $('.task-add-btn').off('click');
    $('.task-updating .glyphicon-trash').off('click');
    $('.task-updating .glyphicon-pencil').off('click');
    $('.input-name-task').off('blur');

    $(document).ready(function () {
        $('.button-add-project').on('click',function () {
            $.ajax({
                url: "/web/index.php?r=tasks%2Fcreateproject",
                success: function(data){
                    $('.task-lists-div').append(data);
                    reinit();
                }
            })
        });
    });
    $('.head-buttons-div .glyphicon-trash').on('click',function(){
        var id=$(this).parents('.project').attr('id');
        var data='id='+id;
        $.ajax({
            url: "/web/index.php?r=tasks%2Fdeleteproject",
            type:"GET",
            data:data,
            success: function(data){
                data=='deleted'?$('.project#'+id).remove():false;
            }
        });
    });

    $('.head-buttons-div .glyphicon-pencil').on('click',function(){
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
                url: "/web/index.php?r=tasks%2Fupdateproject",
                data: 'id=' + id + '&value=' + currentVal,
            })
        }
    });

    $('.task-add-btn').on('click',function(){
        var parent=$(this).parents('.project');
        var Input=parent.find('.head-add-bar input')
        var value=Input.val();
        var id=parent.attr('id');
        $.ajax({
            url: "/web/index.php?r=tasks%2Fcreatetask",
            data: 'id=' + id + '&text=' + value,
            success: function (data) {
                var project=$('#'+id+' .tasks-of-project');
                if (!project.find('.tasks-row')){
                    project.empty().removeClass('empty-project');
                }
                project.append(data);
                Input.val('');
                reinit();
            }
        })
    })

    $('.task-updating .glyphicon-trash').on('click',function(){
        var row=$(this).parents('.task-row');
        var not_normal_id=$(this).parents('.task-row').attr('id');
        var normal_id=not_normal_id.substring(4);
        var data='id='+normal_id;
        console.log(data);
        $.ajax({
            url: "/web/index.php?r=tasks%2Fdeletetask",
            type:"GET",
            data:data,
            success: function(data){
                data=='deleted'?row.remove():false;
            }
        });
    });
    $('.task-updating .glyphicon-pencil').on('click',function(){
        var parent=$(this).parents('.task-row');
        var Input=parent.find('.input-name-task');
        Input.prop('disabled',false).focus();
    });

    $('.input-name-task').on('focus',function() {
        this.old_value=$(this).val();
    });

    $('.input-name-task').on('blur',function(){
        var currentVal=($(this).val());;
        if (currentVal==''){
            $(this).val(this.old_value);
        }else {
            var not_normal_id=$(this).parents('.task-row').attr('id');
            var normal_id=not_normal_id.substring(4);
            $.ajax({
                url: "/web/index.php?r=tasks%2Fupdatetask",
                data: 'id=' + normal_id + '&value=' + currentVal,
            })
        }
    });


}

reinit();