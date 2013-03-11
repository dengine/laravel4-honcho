<div class="alert alert-block alert-error {{array_get($attributes, 'styles')}}">
	{{-- if this is closeable, let's add the href for it. --}}
	@if ( ! empty($attributes['closeable']))
		<a class="close" data-dismiss="alert" href="#">&times;</a>
	@endif

	<h4>Oops, an Error Occurred</h4>
	<p>Please check the form bellow for errors</p>
</div>