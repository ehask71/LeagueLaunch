$(document).ready(function(){
	//$('#flash_msg').delay(5000).fadeOut('slow');
        $("#flash_msg").modal({
	opacity:80,
	overlayCss: {backgroundColor:"#515151"},
        overlayClose: true,
        minWidth: '400px',
        maxWidth: '960px',
        closeHTML: 'X',
        onClose: function(){
            $("#flash_msg").css('visibility','hidden');
        }
});
});