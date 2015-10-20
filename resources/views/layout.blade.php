<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Monkeytwizzle - Photography within dreams</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" media="print,screen" />
    <link rel="stylesheet" href="{{ asset('select2.min.css') }}" media="print,screen" />
    <link rel="stylesheet" href="{{ asset('dropzone.css') }}" media="print,screen" />
    <link rel="stylesheet" href="{{ asset('monkeytwizzle.css') }}" media="print,screen" />
	<script src="{{ asset('jquery.js') }}"></script>
    <script src="{{ asset('select2.min.js') }}"></script>

</head>
<body>

	@include ('partials.navbar')

	<div class="container">

		<noscript>
			<div class="alert alert-danger"><strong>Warning:</strong> This site will not work correctly without javascript</div>
		</noscript>

		@include ('partials.alerts')

        @yield('content')
	</div><!-- container -->

    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
    	$( document ).ready(function() {
	    	//$(".datepicker").datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true });
    		$('.filtertable').filterTable({highlightClass:'bg-success'});
    		$('.select2').select2();
			$('a[data-confirm]').click(function(ev) {
				var href = $(this).attr('href');
				if (!$('#dataConfirmModal').length) {
					$('body').append('<div id="dataConfirmModal" class="modal fade" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button><a class="btn btn-primary" id="dataConfirmOK">OK</a></div></div></div>');
				} 
				$('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
				$('#dataConfirmOK').attr('href', href);
				$('#dataConfirmModal').modal({show:true});
				return false;
			});
	        $('.datetime').AnyTime_picker({ 
                format: "%Y-%m-%d %H:%i:00" 
	        });
	        $('.timeonly').AnyTime_picker({ 
                format: "%H:%i:00" 
	        });
	        $('.dateonly').AnyTime_picker({ 
                format: "%Y-%m-%d" 
	        });
		});
    </script>

</body>
</html>
