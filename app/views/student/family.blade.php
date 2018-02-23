<div class="form-group well well-sm">
    <fieldset>
        <legend>Thông tin về mẹ</legend>
        <div class="input-group inline-block">
            <label for="mom_fullname">Họ tên mẹ</label>
            {{ Form::text('mom_fullname', null, array('class' => 'form-control', 'placeholder' => 'Họ tên mẹ' )) }}
        </div>
        <div class="input-group inline-block">
            <label for="mom_phone">Số điện thoại</label>
            {{ Form::text('mom_phone', null, array('class' => 'form-control', 'placeholder' => 'Số điện thoại' )) }}
        </div>
    </fieldset>
</div>
<div class="form-group well well-sm">
    <fieldset>
        <legend>Thông tin về bố</legend>
        <div class="input-group inline-block">
            <label for="dad_fullname">Họ tên bố</label>
            {{ Form::text('dad_fullname', null, array('class' => 'form-control', 'placeholder' => 'Họ tên bố' )) }}
        </div>
        <div class="input-group inline-block">
            <label for="dad_phone">Số điện thoại</label>
            {{ Form::text('dad_phone', null, array('class' => 'form-control', 'placeholder' => 'Số điện thoại' )) }}
        </div>
    </fieldset>
</div>