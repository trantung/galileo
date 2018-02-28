$(document).ready(function(){

    ////// Chon thoi gian hoc form tao lich hoc
    $(document).on('change', '.schedule-create-form select[name="package_id"]', function(){
        var val = $(this).val(),
        order = $(this).find('>option[value="'+ val +'"]').attr('number-lesson');
        $('.time-box-student >.item').each(function(key, val){
            $(this).find('input').val('').change();
            if( (key+1) <= order ){
                $(this).removeClass('hidden');
            } else{
                $(this).addClass('hidden');
            }
        })
    })

    ////// chon trinh do trong bo loc trang danh sach hoc lieu
    $(document).on('change', '.filter-document-form select.select-class, .filter-document-form select.select-subject', 
        function(){
        var classId = $('.filter-document-form select.select-class').val(),
        subjectId = $('.filter-document-form select.select-subject').val();
        $('.filter-document-form .select-level-from-class-subject > select').val('').change();
        $('.filter-document-form .select-level-from-class-subject > select>option:not([value=""])').addClass('hidden');
        $('.filter-document-form .select-level-from-class-subject > select>option[class-id="'+classId+'"][subject-id="'+subjectId+'"]').removeClass('hidden');
    })

    //// Them moi hoc lieu trong trang quan ly cac buoi hoc cua 1 level
    $(document).on('click', '.wrap-multi-file-each-lesson a.add-new-doc-to-lesson', function(){
        var parent = $(this).parents('.wrap-multi-file-each-lesson'),
        clone = parent.find('.element-to-clone').html(),
        order = parent.find('>form .item-doc').length;

        parent.find('>form .item-list').append( clone.replace(/@order/g, order) );
        return false;
    })
    /////// Xoa 1 o nhap hoc lieu
    $(document).on('click', '.document-of-lesson-form .remove-item-doc.no-ajax', function(){
        if( $(this).parents('.item-list').find('>.item-doc').length > 1 ){
            $(this).parent().hide(300, function(){
                $(this).remove();
            })
        }
        console.log('test');
        return false;
    })
    ////////////////////////////

    //// Chon danh sach lop hoc, mon hoc, level cho Center
    $(document).on('change', '.list-class-in-center .item>label>input', function(){
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
    $(document).on('click', '.list-class-in-center .item>label>a.select-all', function(){
        console.log('test');
        $(this).parent().find('>input').prop('checked', 'checked').change();
        $(this).parent().parent().find('>ul>li>label>input').prop('checked', 'checked').change();
        return false;
    })
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