@extends('layouts.default')

@section('title')
	Edit Question
@endsection


@section('content')
	<?php 
		//define type
		$type_label = $question->type=="multiple"?"Multiple Choice":"Fill in the Blank";
	?>
	<ul class="button-group">
		<li><a href="{{ Request::root() . '/exam/' . $exam->id }}" class="small button">Return to {{ $exam->title }}</a></li>
	</ul>
	<hr />
	{{ Form::open(array('url' => '/question/' . $question->id  . '/update', 'method' => 'post', 'class' => 'custom')) }}
	<div class="row">
		<div class="large-7 columns">
			<fieldset>
				<legend>Add Question</legend>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Type:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::text('type', $type_label, array('disabled' => 'disabled')) }}
					</div>
				</div>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Set:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::select('set_id', $sets, $question->set_id) }}
					</div>
				</div>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Text Question:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::textarea('question', $question->question, array('placeholder' => 'Question')) }}
					</div>
				</div>
				<input type="hidden" name="question_id" value="{{ $question-> id }}" />
			</fieldset>
		</div>
	</div>
	{{ Form::submit('UPDATE', array('class' => 'button radius')) }}
	{{ Form::token(); }}
	{{ Form::close(); }}
@endsection


@section('scripts')
	<script>
		
	</script>
@endsection