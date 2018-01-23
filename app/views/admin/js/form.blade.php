<script type="text/javascript">

$(document).ready(function(){
    var counter = 2;
   $(document).on('click', '#addButton', function () {
		if(counter>10){
	            alert("Only 10 textboxes allow");
	            return false;
		}
		var newTextBoxDiv = $(document.createElement('div'))
		     .attr("id", 'TextBoxDiv' + counter);

		newTextBoxDiv.after().html('<label>Textbox #'+ counter + ' : </label>' +
		      '<input type="text" name="textbox' + counter +
		      '" id="textbox' + counter + '" value="" >');
		newTextBoxDiv.appendTo("#partner_form #TextBoxesGroup");
		counter++;
    });

    $(document).on('click', '#removeButton', function () {
		if(counter==1){
			alert("No more textbox to remove");
			return false;
	    }
		counter--;
	        $("#partner_form #TextBoxDiv" + counter).remove();

    });
  });
</script>

<div id = "test" class="hidden">
	<div id='TextBoxesGroup'>
		<div id="TextBoxDiv1">
			<label>Textbox #1 : </label>
			<input type='textbox' id='textbox1' >
			{{ Form::text("textbox[]") }}
		</div>
	</div>
	<input type='button' value='Add Button' id='addButton'>
	<input type='button' value='Remove Button' id='removeButton'>
</div>