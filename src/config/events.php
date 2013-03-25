<?php

return array(

	// register our event handlers. To override an event handler, just replace it here.
	// You can also add new event handlers here.
	'handlers' => array(
		'Dberry37388\Honcho\Events\AuthEventHandler',
		'Dberry37388\Honcho\Events\ProfileEventHandler',
		'Dberry37388\Honcho\Events\UserEventHandler'
	)
);