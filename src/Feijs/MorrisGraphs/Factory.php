<?php namespace Feijs\MorrisGraphs;

use Lang, Config, View;
use Carbon\Carbon;

/**
 * Graph creator instance
 *
 * @package    Feijs/MorrisGraphs
 * @author     Mike Feijs <mfeijs@gmail.com>
 * @copyright  (c) 2015, Mike Feijs
 */
class Factory
{
    /**
     * Div identifier
     * @var string
     */
    protected $graph_id;

	/**
     * Graph type
     * @var string
     */
    protected $graph_type;

    /**
     * Horizontal key
     * @var string
     */
    protected $x_key;

	/**
     * Graph height
     * @var string
     */
    protected $height;

	/**
     * Label translations file
     * @var string
     */
    protected $lang_labels;


    public function __construct()
    {
    	Config::addNamespace('morris-graphs', __DIR__.'/../../config');
        Lang::addNamespace('morris-graphs', __DIR__.'/../../lang');
        View::addNamespace('morris-graphs', __DIR__.'/../../views');

        $this->lang_labels = Config::get('morris-graphs::config.translations.labels');
    }

	/*---------------------------------------
	 * View generating functions
	 *-------------------------------------*/

	/**
     * Generate a <script> block for a graph
     *  with dynamic data source
     *
     * @param string[] $data
     * @param string[] $descriptors
     * @return string
     */
    public function dynamice($source_url, $descriptors = null)
    {
    	$replacers = [
            'id' 			=> $this->getGraphId(),
            'type'			=> $this->getGraphType(),
            'source_url' 	=> $source_url,
			'data_json' 	=> '['.$this->getDataJson($descriptors).']',
			'range'			=> 7
		];

		if($this->graph_type != 'Donut') {
			$labels = $this->getLabels($descriptors);
			$replacers += [
	            'xkey' 			=> $this->getXkey(),
	            'ykeys' 		=> "['".implode("','", $descriptors)."']",
	            'labels' 		=> "['".implode("','", $labels)."']",
        	];
        }

        return View::make('morris-graphs::script_dynamic', $replacers)->render();
    }

	/**
     * Generate a <script> block for a graph
     *  with a fixed data source
     *
     * @param string[] $data
     * @param string[]|null $descriptors
     * @return string
     */
    public function fixed($data, $descriptors = null)
    {
		$replacers = [
            'id' 			=> $this->getGraphId(),
            'type'			=> $this->getGraphType(),
			'data_json' 	=> json_encode($data),
		];

		if($this->graph_type != 'Donut') {
			$labels = $this->getLabels($descriptors);
			$replacers += [
	            'xkey' 			=> $this->getXkey(),
	            'ykeys' 		=> "['".implode("','", $descriptors)."']",
	            'labels' 		=> "['".implode("','", $labels)."']",
        	];
        }
    	
        return View::make('morris-graphs::script_fixed', $replacers)->render();
    }

    /**
     * Print the <div> where the graph will be rendered to
     * @return string
     */
    public function div() 
    {
    	return '<div class="col-md-12 well"><div id="graph-'. $this->getGraphId() .'" style="height: '. $this->getHeight() .';"></div></div>';
    }
    
	/**
     * Print the required style & script includes
     * @return string
     */
    public function includes() 
    {
    	return View::make('morris-graphs::includes')->render();
    }

    /**
     * Print a set of range buttons for the graph
     * @return string
     */
    public function ranges($ranges) 
    {
    	$html = '<ul class="nav nav-pills ranges-'. $this->getGraphId() .'">';

    	$first = true;
    	foreach($ranges as $range) {
    		if($first) {
    			$html .= '<li class="active"><a href="#" data-range=';
    			$first = false;
    		}
    		else {
    			$html .= '<li><a href="#" data-range=';
    		}
            $html .= $range .'>'. $range . ' ' . Lang::get($this->lang_labels . '.' . $this->getXkey()) . '</a></li>';
    	}
		return $html . '</ul>';
	}

	/*---------------------------------------
	 * Helpers
	 *-------------------------------------*/

	/**
     * Get a json encoded array of all data columns 
     *  initialised to value
     *
     * @param string[] $descriptors
     * @param int $value (optional)
     * @return string
     */
    protected function getDataJson($descriptors, $value = 0)
    {
    	return json_encode(array_fill_keys($descriptors, $value));
    }

    /** 
     * Get translated labels for bar & line graphs
     *
     * @param string[] $descriptors
     * @return string[]
     */
	protected function getLabels($descriptors)
	{
    	$labels  = [];
    	foreach($descriptors as $descriptor) {
    		$labels[] = Lang::get($this->lang_labels . '.' . $descriptor);
    	}
    	return $labels;
    }

	/*---------------------------------------
	 * Getters & Setters
	 *-------------------------------------*/

	/**
     * Get the ID of the generated graph
     * This value is randomized unless a custom value was set via setGraphId
     *
     * @return string
     */
    public function getGraphId()
    {
        if(empty($this->graph_id)) {
            $this->graph_id = str_random(4);
        }
        return $this->graph_id;
    }

    /** 
     * Set the graph id
     * @param string
     */
    public function setGraphId($id) { $this->graph_id = $id; }

	/**
     * Get the graph type
     * @return string
     */
    public function getGraphType() 
    { 
        return (isset($this->graph_type) ? $this->graph_type : 'Bar'); 
    }

	/** 
     * Set the graph tyoe
     * @param string
     */
    public function setGraphType($type) { $this->graph_type = $type; }

    /**
     * Get the horizontal graph key
     * @return string
     */
    public function getXkey() 
    { 
        return (isset($this->x_key) ? $this->x_key : 'x'); 
    }

    /**
     * Set the horizontal graph key
     * @param string
     */
    public function setXkey($value) 
    { 
        $this->x_key = $value;
    }

	/**
     * Get the graph height
     * @return string
     */
    public function getHeight() 
    { 
        return (isset($this->height) ? $this->height : '250px'); 
    }

    /**
     * Set the graph height
     * @param string
     */
    public function setHeight($value) 
    { 
        $this->height = $value;
    }
}