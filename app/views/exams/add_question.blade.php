@extends('layouts.default')

@section('title')
	Add Set for {{ $exam->title }}
@endsection


@section('content')
	<ul class="button-group">
		<li><a href="{{ Request::root() . '/view_exam/' . $exam->id }}" class="small button">Return to {{ $exam->title }}</a></li>
	</ul>
	<hr />
	{{ Form::open(array('url' => 'add_question', 'method' => 'post', 'class' => 'custom')) }}
	<div class="row">
		<div class="large-8 columns">
			<fieldset>
				<legend>Add Question</legend>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Set:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::select('set_id', $sets) }}
					</div>
				</div>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Type:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::select('type_id', $types) }}
					</div>
				</div>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Text Question:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::textarea('question', Input::old('question'), array('placeholder' => 'Question')) }}
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