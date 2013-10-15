@extends('layouts.default')

@section('title')
	Add Set for {{ $exam->title }}
@endsection


@section('content')
	<ul class="button-group">
		<li><a href="{{ Request::root() . '/view_exam/' . $exam->id }}" class="small button">Return to {{ $exam->title }}</a></li>
	</ul>
	<hr />
	{{ Form::open(array('url' => '/exam/' . $exam->id . '/set/create', 'method' => 'post', 'class' => 'custom')) }}
	<div class="row">
		<div class="large-8 columns">
			<fieldset>
				<legend>Add Set</legend>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Set Name:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::text('name', Input::old('name'), array('placeholder' => 'Name')) }}
					</div>
				</div>
				<input type="hidden" name="exam_id" value="{{ $exam-> id }}" />
			</fieldset>
			{{ Form::submit('ADD', array('class' => 'button radius')) }}
		</div>
 		
	</div>
	{{ Form::token(); }}
	{{ Form::close(); }}
@endsection


@section('scripts')
	<script>
		
	</script>
@endsection