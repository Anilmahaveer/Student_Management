$(document).ready(function(){
			$("#sub").click( function() {
				 $.post( $("#myForm").attr("action"), 
						 $("#myForm").serializeArray(), 
						 function(info){ $("#result").html(info); 
				   });
				 clearInput();
				});
				 
				$("#myForm").submit( function() {
				  return false;	
				});
				 
				function clearInput() {
					$("#myForm").each( function() {
					   $(this).val('');
					});
				}
		});