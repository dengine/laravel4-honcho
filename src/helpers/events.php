<?php

// grabs our event handlers from the config.
$eventHandlers = Config::get('honcho::events.handlers', array());

// o through and register our event handlers using Laravel's Event::subscribe() method.
foreach ($eventHandlers as $handler)
{
	// subscribe to our profile event handler
	Event::subscribe(new $handler);
}