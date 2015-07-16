<script language="JavaScript" type="text/javascript">

    function requestData(chart, range)
    {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "{{$source_url}}", 
            data: { range: range }
        })
        .done(function( data ) {
            chart.setData(data);
        })
        .fail(function() {
            alert("{{ Lang::get(Config::get('morris-graphs::config.translations.messages') . '.graph_load_failed') }}");
        });
    }

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

        requestData(chart, {{$range}});  //initial data request

        $('ul.ranges-{{$id}} a').click(function(e){
            e.preventDefault();

            range = $(this).attr('data-range');
            requestData(chart, range);

            $(this).parent().addClass('active');
            $(this).parent().siblings().removeClass('active');
        })
	});
</script>