<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Generate PDF with PHP</title>

		<link href="custom.css" rel="stylesheet">	
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {    
				$('#success').hide();  
				$('button').click(function () {
					$.post('create_result.php', $('form').serialize(), function () {
						$('div#wrapper').fadeOut( function () {
							$('#success').show();
						});
					});
					return false;
				});
			});
		</script>	
	
	</head>
	<body>
		<div id="main" align="center">
			<div id="success">
				<p> Please <a href="result.pdf">download </a> your results in PDF Version . </p>
			</div>
			<div id="wrapper">
				<form action="index.php"  method="post" class="registration_form">
					<fieldset>
						<legend>Personal Information </legend>
						<div class="elements">
							<label for="name">Name :</label>
							<input type="text" name="name" value="MD. Robeul Islam" size="25" />
						</div>
						<div class="elements">
							<label for="e-mail">E-mail :</label>
							<input type="text" name="email" value="robicse8@gmail.com" size="25" />
						</div>
						<div class="elements">
							<label for="e-mail">Address : </label>
							<input type="text" name="address" value="Badda" size="25" />
						</div>
						<div class="elements">
							<label for="e-mail">City  : </label>
							<input type="text" name="city" value="Dhaka" size="25" />
						</div>
							<div class="elements">
							<label for="e-mail">Country  : </label>
							<input type="text" name="country" value="Bangladesh" size="25" />
						</div> 
					</fieldset>		  
					<fieldset>
						<legend>Results  </legend>
						<div class="elements">
							<input type="text" name="subjects[]" value="Maths" size="25" />
							<input type="text" name="marks[]" value="50" size="10" />
						</div>
						<div class="elements">
							<input type="text" name="subjects[]" value="English" size="25" />
							<input type="text" name="marks[]" value="10" size="10" />
						</div>
						<div class="elements">
							<input type="text" name="subjects[]" value="French" size="25" />
							<input type="text" name="marks[]" value="65" size="10" />
						</div>
						<div class="elements">
							<input type="text" name="subjects[]" value="Science" size="25" />
							<input type="text" name="marks[]" value="80" size="10" />
						</div>
						<div class="elements"></div>
						<div class="submit">
							<input type="hidden" value="submitted" />
							<button type="submit">Submit</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</body>
</html>
