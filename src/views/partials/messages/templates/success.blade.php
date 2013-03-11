<div class="alert alert-block alert-success {{array_get($attributes, 'styles')}}">
	{{-- if this is closeable, let's add the href for it. --}}
	@if ( ! empty($attributes['closeable']))
		<a class="close" data-dismiss="alert" href="#">&times;</a>
	@endif

	{{-- loop through our messages --}}
	@foreach ($messages as $msg)
		<p>{{ $msg }}</p>
	@endforeach
</div>