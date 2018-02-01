<script src="{{ asset('admins/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'editor1',
    {
        entities_latin: false,
        entities_greek: false,
        filebrowserBrowseUrl : '{{ url("/admins/ckeditor/ckfinder/ckfinder.html") }}',
        filebrowserImageBrowseUrl : '{{ url("/admins/ckeditor/ckfinder/ckfinder.html?type=Images") }}',
        filebrowserFlashBrowseUrl : '{{ url("/admins/ckeditor/ckfinder/ckfinder.html?type=Flash") }}',
        filebrowserUploadUrl : '{{ url("/admins/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files") }}',
        filebrowserImageUploadUrl : '{{ url("/admins/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images") }}',
        filebrowserFlashUploadUrl : '{{ url("/admins/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash") }}'
        }
    );
    CKEDITOR.replace( 'editor2',
    {
        entities_latin: false,
        entities_greek: false,
        filebrowserBrowseUrl : '{{ url("/admins/ckeditor/ckfinder/ckfinder.html") }}',
        filebrowserImageBrowseUrl : '{{ url("/admins/ckeditor/ckfinder/ckfinder.html?type=Images") }}',
        filebrowserFlashBrowseUrl : '{{ url("/admins/ckeditor/ckfinder/ckfinder.html?type=Flash") }}',
        filebrowserUploadUrl : '{{ url("/admins/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files") }}',
        filebrowserImageUploadUrl : '{{ url("/admins/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images") }}',
        filebrowserFlashUploadUrl : '{{ url("/admins/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash") }}'
        }
    );
</script>