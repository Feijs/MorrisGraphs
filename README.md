# MorrisGraphs

This package provides a class to easily generate dynamic graphs with Morris.js

## Installation

Add the package in `composer.json` and run `composer update`

```php
"require": {
	"feijs/morris-graphs": "dev-master"
}
```

Add the ServiceProvider to the providers in `config\app.php`

```php
'Feijs\MorrisGraphs\MorrisGraphsServiceProvider'
```

And publish the package assets:

```bash
php artisan asset:publish "feijs/morris-graphs"
```


## Usage

### Creating a graph

Create a Factory object and pass this to a view

```php
use Feijs\MorrisGraphs\Factory as Graph;

public function show()
{
	$graph = new Graph();
	return View::make('views.index')->with('graph', $graph)
}
```

Then in your view include the following:

```php
{{ $graph->includes() }}	//Preferably once per page

{{ $graph->div() }}			//Where you want to place the graph

{{ $graph->ranges('7', '14', 21) }}		//Add buttons for data ranges

{{ $graph->dynamic($source_url, ['quantity1', 'quantity2']) }}	

//Or

{{ $graph->fixed([/*data*/], ['quantity1', 'quantity2']) }}	

```
For Donut graphs the second parameter may be ommitted

### Settings

To customize graph settings you can call the following setters

#### Horizontal key

Must match the horizontal key in the dataset, defaults to `x`
```php
$graph->setXKey('segment');
```

#### Graph type

Choose from `Bar`, `Line`, `Area`, `Donut`, defaults to `Bar`
```php
$graph->setGraphType('Donut');
```

#### Id

This id will match the script with the the div
```php
$graph->setGraphId('1234');
```

#### Height

The height of the graph, defaults to 250px
```php
$graph->setHeight('300px');
```