$(document).ready(function(){
	//$('#flash_msg').delay(5000).fadeOut('slow');
        $("#flash_msg").modal({
	opacity:80,
	overlayCss: {backgroundColor:"#515151"},
        overlayClose: true,
	minHeight: '200px',
        minWidth: '400px',
        maxWidth: '960px',
        closeHTML: '<span>Click anywhere to Close</span>',
        persist: false,
        onClose: function(){
            closeModal();
        }
});
var mtid;
//mtid = window.setTimeout(closeModal, 5000);
function closeModal(){
    $.modal.close();
    $('#flash_msg').css('display','none');
    window.clearTimeout(mtid);
}
});