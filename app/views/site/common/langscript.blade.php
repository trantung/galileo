{{ HTML::style('assets/country/css/msdropdown/dd.css') }}
{{ HTML::script('assets/country/js/msdropdown/jquery.dd.min.js') }}
{{ HTML::style('assets/country/css/msdropdown/flags.css') }}


<script language="javascript">

$(document).ready(function() {
    $("#countries").msDropdown();
});

function sendLang()
{
    // if($("#countries").val() == "{{ LANG_EN }}") {
    //     location.href = "{{ url('/en') }}";
    // } else {
    //     location.href = "{{ url('/vi') }}";
    // }
    var link = window.location.href;
    var segments = link.split( '/' );
    //get game name to check id game
    var lang = "{{ LaravelLocalization::setLocale() }}";
    if(lang) {
        var link_url = (segments[4])?segments[4]:'';
        var link_url2 = (segments[5])?segments[5]:'';
    } else {
        var link_url = (segments[3])?segments[3]:'';
        var link_url2 = (segments[4])?segments[4]:'';
    }
    $.ajax(
    {
        type:'post',
        url: '{{ url("/sendLang") }}',
        data:{
            'lang_current': "{{ getLang() }}",
            'lang': $("#countries").val(),
            'url': "{{ URL::current() }}",
            'link_url': link_url,
            'link_url2': link_url2,
        },
        success: function(data)
        {
            if(data) {
                // console.log(data);
                location.href = data;
            }
        }
    });
}
</script>

<select name="countries" id="countries" style="width:55px;" onchange="sendLang()">
    <option value='vi' data-image="{{ url('assets/country/images/msdropdown/icons/blank.gif') }}" data-imagecss="flag vn" data-title="Tiếng việt" <?php if(getLang() == 'vi'){echo 'selected="selected"';} ?> ></option>
    <option value='en' data-image="{{ url('assets/country/images/msdropdown/icons/blank.gif') }}" data-imagecss="flag england" data-title="English" <?php if(getLang() == 'en'){echo 'selected="selected"';} ?> ></option>
</select>