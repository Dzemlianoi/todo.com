function reinit(){
    $('.button-add-project').off('click');
    $('.head-buttons-div .glyphicon-trash').off('click');
    $('.head-buttons-div .glyphicon-pencil').off('click');
    $('.project-name').off('blur');
    $('.task-add-btn').off('click');
    $('.task-updating .glyphicon-trash').off('click');
    $('.task-updating .glyphicon-pencil').off('click');
    $('.input-name-task').off('blur');
    $('.task-row').off('hover');
    $('.glyphicon-chevron-up').off('click');
    $('.glyphicon-chevron-down').off('click');

    $('.button-add-project').on('click',function () {
        $.ajax({
            url: "/web/index.php?r=tasks%2Fcreateproject",
            success: function(data){
                $('.task-lists-div').append(data);
                reinit();
            }
        })
    });

    $('.head-buttons-div .glyphicon-trash').on('click',function(){
        var id=$(this).parents('.project').attr('id');
        $.ajax({
            url: "/web/index.php?r=tasks%2Fdeleteproject",
            data:'id='+id,
            success: function(data){
                data=='deleted'?$('.project#'+id).remove():false;
            }
        });
    });

    $('.head-buttons-div .glyphicon-pencil').on('click',function(){
      var input=$(this).parents('.project').find('.project-name');
      var value=input.val();
      input.val('').val(value).prop('disabled',false).focus();
    });

    $('.project-name').on('focus',function() {
        this.old_value=$(this).val();
    });

    $('.project-name').on('blur',function(){
        var currentVal=$(this).val();
        if (currentVal==''){
            $(this).val(this.old_value);
        }else {
            var id = $(this).parents('.project').attr('id');
            $.ajax({
                url: "/web/index.php?r=tasks%2Fupdateproject",
                data: 'id=' + id + '&value=' + currentVal
            })
        }
    });

    $('.task-add-btn').on('click',function(){
        var parent=$(this).parents('.project');
        var Input=parent.find('.head-add-bar input');
        var value=Input.val();
        var id=parent.attr('id');
        var header=parent.find('.task-header');
        var clear=header.next();
        $.ajax({
            url: "/web/index.php?r=tasks%2Fcreatetask",
            data: 'id=' + id + '&text=' + value,
            success: function (data) {
                var project=$('#'+id+' .tasks-of-project');
                if (project.find('.task-row').length==0){
                    console.log(1);
                    project.removeClass('empty-project');
                    header.removeClass('none-display');
                    clear.removeClass('none-display');
                }
                project.append(data);
                Input.val('');
                reinit();
            }
        })
    });

    $('.task-updating .glyphicon-trash').on('click',function(){
        var parent=$(this).parents('.project');
        var id=parent.attr('id');

        var row=$(this).parents('.task-row');
        var normal_id=$(this).parents('.task-row').attr('id').substring(4);
        var data='id='+normal_id;

        var header=parent.find('.task-header');
        var clear=header.next();
        $.ajax({
            url: "/web/index.php?r=tasks%2Fdeletetask",
            data:data,
            success: function(data){
                if (data=='deleted'){
                    if (parent.find('.task-row').length==1){
                        parent.find('tasks-of-project').addClass('empty-project');
                        header.addClass('none-display');
                        clear.addClass('none-display');
                    }
                    row.remove();
                }
            }
        });
    });
    $('.task-updating .glyphicon-pencil').on('click',function(){
        var input=$(this).parents('.task-row').find('.input-name-task');
        var value=input.val();
        input.val('').val(value).prop('disabled',false).focus();
    });

    $('.input-name-task').on('focus',function() {
        this.old_value=$(this).val();
    });

    $('.input-name-task').on('blur',function(){
        var currentVal=($(this).val());
        if (currentVal==''){
            $(this).val(this.old_value);
        }else {
            var normal_id=$(this).parents('.task-row').attr('id').substring(4);
            $.ajax({
                url: "/web/index.php?r=tasks%2Fupdatetask",
                data: 'id=' + normal_id + '&value=' + currentVal,
            })
        }
    });
    $('.done-task input').on('click',function () {
        var parent=$(this).parents('.task-row');
        var Input=parent.find('.input-name-task');
        var checked=$(this).prop('checked');
        var normal_id=$(this).parents('.task-row').attr('id').substring(4);
        $.ajax({
            url: "/web/index.php?r=tasks%2Fupdatestatus",
            data: 'checked='+checked+'&id=' + normal_id,
            success:function(){
                if (checked) {
                    Input.addClass('task-text-completed');
                    parent.addClass('task-completed');
                }else{
                    Input.removeClass('task-text-completed');
                    parent.removeClass('task-completed');
                }
            }
        })
    });
    $('.task-row').hover(
        function() {
            $(this).find('.task-updating').removeClass('none-display');
        },function() {
            $(this).find('.task-updating').addClass('none-display');
        }
    );

    $('.task-deadline input').on('change',function(){

        var currentVal=$(this).val();
        var normal_id=$(this).parents('.task-row').attr('id').substring(4);
        console.log(currentVal);
        $.ajax({
            url: "/web/index.php?r=tasks%2Fupdatedeadline",
            data: 'id=' + normal_id + '&value=' + currentVal,
        })
    });

    $('.glyphicon-chevron-up').on('click',function(){
        var this_task=$(this).parents('.task-row');
        var prev_task=this_task.prev();
        if (!prev_task.prev().hasClass('task-header')){
            var order1=this_task.attr('id').substring(4);
            var order2=prev_task.prev().attr('id').substring(4);
            if (changeOrder(order1,order2)) {
                this_task.insertBefore(prev_task.prev());
                prev_task.insertAfter(this_task);
            }
        }
    });

    $('.glyphicon-chevron-down').on('click',function(){
        var this_task=$(this).parents('.task-row');
        var next_task=this_task.next();
        if (next_task.next().length!=0){
            var order1=this_task.attr('id').substring(4);
            var order2=next_task.next().attr('id').substring(4);
            if (changeOrder(order1,order2)){
                this_task.insertAfter(next_task.next());
                next_task.insertBefore(this_task);
            }
        }
    })
}

function changeOrder(id1,id2) {
     return $.ajax({
        url: "/web/index.php?r=tasks%2Fchangeorder",
        data: 'id1=' + id1 + '&id2=' + id2
        })
}

reinit();