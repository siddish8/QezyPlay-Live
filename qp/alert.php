<link rel='stylesheet' href='http://ideabytestraining.com/demoqezyplay/jAlert-master/src/jAlert-v3.css'>
	<script src='http://ideabytestraining.com/demoqezyplay/jAlert-master/vendor/jquery-1.11.3.min.js'></script>
	<script src='http://ideabytestraining.com/demoqezyplay/jAlert-master/src/jAlert-v3.js'></script>
	<script src='http://ideabytestraining.com/demoqezyplay/jAlert-master/src/jAlert-functions.js'></script>

	<script>
		$(function(){
			$.jAlert({
				'title': 'Normal',
				'content': 'Normal = Boring',
				'closeOnEsc': false,
				'closeOnClick': false
			});
			$.jAlert({
				'title': 'Click to Hide',
				'content': 'Click anywhere outside this alert to close',
				'closeOnClick': true
			});
			$.jAlert({
				'title': 'Hit "ESC" to Hide',
				'content': 'Click the "ESC" key to close this alert.',
				'closeBtn': false,
				'closeOnEsc': true
			});
			errorAlert('ERROR WILL ROBINSON, ERROR!');
			successAlert('Success!', 'You did it!');
            infoAlert('Info', 'Something interesting to read.');
			alert('Boring regular alert..');
		});
	</script>
