<link rel="stylesheet" type="text/css" href="..\toster/toastr-notify.min.css">
<script src="..\toster/toastr-notify.min.js"></script>
<script src="..\toster/SwetAlert/sweetalert2@11.js"></script>
 <script type="text/javascript"> 

	function CuteAleart(status,title,text) {

			   new Notify ({
	     	    status: status,
			    title: title,
			    text: text,
			    effect: 'slide',
			    speed: 300,
			    customClass: '',
			    customIcon: '',
			    showIcon: true,
			    showCloseButton: true,
			    autoclose: true,
			    autotimeout: 4500,
			    gap: 20,
			    distance: 20,
			    type: 1,
			    position: 'left top',
			    customWrapper: '',
			  })

	} 
</script>