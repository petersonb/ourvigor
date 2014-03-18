var textarea                   = "#description_textarea";
var description                = "#toggle_description";
var row                        = "#description_row";
var hidden_include_description = "#include_description";

$(document).ready(function () {
	if (! $(textarea).html() != "") {
		$(row).hide();
		$(hidden_include_description).val('0');
	}
	
	$(description).click (function () {
		$(row).toggle();
		
		if ( $(row).is(":visible")) {
			$(description).html("Remove Description");
			$(hidden_include_description).val('1');
		}
		else {
			$(description).html("Include Description");
			$(hidden_include_description).val('0');
		}
		
	});
});
