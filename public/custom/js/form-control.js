$(document).ready(function(){

    $(document).on('change', '.select-subject-wrapper>select', function(){
        var parent = $(this).parent(), id = $(this).val();
        if( id == '' ){
            parent.find('.select-level').empty();
            return;
        }
        if( parent.find('.select-level').length == 0 ){
            parent.append('<div class="select-level"></div>');
        }
        parent.find('.select-level').empty().append('<div class="js-multi-field">\
            <div class="input-wrap">\
                <div class="item select-level-wrapper" data-syn="#syn">\
                    <label class="inline-block">Trình độ: </label>\
                    <input style="width:300px" name="level['+id+'][]" id="syn" type="text" class="form-control inline-block">\
                    <a class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i></a>\
                </div>\
            </div>\
            <button class="btn btn-success add-new" type="button"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button>\
        </div>');
    })

    $(document).on('click', '.js-multi-field >.add-new', function(){
        console.log('tset2');
        var parent = $(this).parent().find('>.input-wrap'),
        clone = parent.find('>.item').first().clone();
        clone.find('input').val('');
        clone.find('select').val('');
        clone.find('area').empty();
        clone.find('>div').empty();
        parent.append(clone);
    })

    $(document).on('click', '.item >.remove', function(){
        // neu chi co 1 input duy nhat thi khong xoa duoc
        if( $(this).parent().parent().find('>.item').length <= 1 ){
            return false;
        }
        var parent = $(this).parent();
        parent.hide(300, function(e){
            parent.remove();
        });
        return false;
    })

})