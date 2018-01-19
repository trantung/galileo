<script type="text/javascript">
	function PrintAll() {
	    var pages = ["http://localhost:8000/uploads/documents/testso1.pdf", "http://localhost:8000/uploads/documents/testso2.pdf"];
	    for (var i = 0; i < pages.length; i++) {
	        var oWindow = window.open(pages[i], "print");
	        oWindow.print();
	        oWindow.close();
	    }
	}
	PrintAll();
</script>
