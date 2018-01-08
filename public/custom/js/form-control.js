$(document).ready(function(){

    //// Chon danh sach lop hoc, mon hoc, level cho Center
    $('.list-class-in-center').on('change', '.item>label>input', function(){
        var id = $(this).parent().attr('href');
        if( $(this).is(':checked') ){
            $(id).collapse('show');
        }else{
            $(this).parent().parent().find('input[type="checkbox"]').prop('checked', false);
            $(id).collapse('hide');
        }
    })
    if( $('.list-class-in-center .level-item>label>input').length ){
        $('.list-class-in-center .level-item>label>input').each(function(){
            if( $(this).is(':checked') ){
                $(this).parents('.subject-item').find('>label>input').prop('checked', 'checked').change();
                $(this).parents('.class-item').find('>label>input').prop('checked', 'checked').change();
            }
        })
    }
    /////////////////////////////

    //// Tao input nhap trinh do khi chon mon hoc trong form Create Class
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
            <button class="btn btn-success add-new" type="button"><i class="glyphicon glyphicon-plus"></i> Thêm mới trình độ</button>\
        </div>');
    })

    // Khi them moi 1 o input
    $(document).on('click', '.js-multi-field >.add-new:not(.edit)', function(){
        console.log('tset2');
        var parent = $(this).parent().find('>.input-wrap'),
        clone = parent.find('>.item').first().clone();
        clone.find('input').val('');
        clone.find('select').val('');
        clone.find('select').removeAttr('disabled');
        clone.find('area').empty();
        clone.find('>div').empty();
        parent.append(clone);
    })

    // Khi xoa 1 o input
    $(document).on('click', '.item >.remove', function(){
        // neu chi co 1 input duy nhat thi khong xoa duoc
        if( $(this).parent().parent().find('>.item').length <= 1 ){
            return false;
        }
        var parent = $(this).parent();
        parent.hide(300, function(e){
            parent.remove();
        });
        return true;
    })

    //// Khi them moi 1 o input da co du lieu truoc do
    $(document).on('click', '.select-level .js-multi-field >.edit', function(){
        console.log('edit class subject');
        var id = $(this).parents('.item.select-subject-wrapper').find('>select').val();
        var parent = $(this).parent().find('>.input-wrap');
        var test = '<div class="item select-level-wrapper" data-syn="#syn">\
                    <label class="inline-block">Trình độ: </label>\
                    <input style="width:300px" name="level_new['+id+'][]" id="syn" type="text" class="form-control inline-block">\
                    <a class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i></a>\
                </div>';
        parent.append(test);
    })

})