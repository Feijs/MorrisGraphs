<script language="JavaScript" type="text/javascript">

	$(function() {

		var chart = Morris.{{$type}}({
    		element: 'graph-{{$id}}',
	    	data: {{$data_json}},
	    	parseTime: false,

		    @if($type != 'Donut')
				xkey: '{{$xkey}}',
	    		ykeys: {{$ykeys}}, 
	    		labels: {{$labels}}
	    	@endif
	  	});
	});

</script>