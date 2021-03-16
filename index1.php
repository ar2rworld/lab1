<html>
<body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="jquery.qrcode.js"></script>
<div id="test"></div>
<p>Hello world!</p>
<script type="text/javascript">
$(document).ready(function() {
	$('#test').qrcode({
	'url' : 'https://www.jqueryscript.net', // users will be redirected to this URL when scanning the QR-Code
	'width' : 300, // image width in pixel
	'height' : 300, // image height in pixel
	'qrsize' : 100 // quality of the QR-Code in pixel
	});
});
</script>
</body>
</html>