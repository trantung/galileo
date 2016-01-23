{{ HTML::style('assets/lang/css/msdropdown/dd.css') }}
{{ HTML::script('assets/lang/js/msdropdown/jquery.dd.min.js') }}
<script language="javascript">
$(document).ready(function(e) {
try {
$("#lang").msDropDown();
} catch(e) {
alert(e.message);
}
});

function sendLang()
{
    if($("#lang").val() == "{{ LANG_EN }}") {
        location.href = "{{ url('/en') }}";
    } else {
        location.href = "{{ url('/vi') }}";
    }
    // $.ajax(
    // {
    //     type:'post',
    //     url: '{{ url("/sendLang") }}',
    //     data:{
    //         'lang': $("#lang").val(),
    //         'url': "{{ URL::current() }}",
    //     },
    //     success: function(data)
    //     {
    //         if(data) {
    //             console.log(data);
    //             // window.location.reload();
    //         }
    //     }
    // });
}
</script>

<select name="lang" id="lang" onchange="sendLang();">
    <option value="vi" data-image="{{ url('assets/images/vi.png') }}"> </option>
    <option value="en" data-image="{{ url('assets/images/en.png') }}"> </option>
</select>