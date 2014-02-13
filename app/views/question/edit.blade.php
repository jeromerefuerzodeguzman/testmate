@extends('layouts.default')

@section('title')
	Edit Question
@endsection


@section('content')
	<?php 
		//define type
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
						{{ Form::text('type', $question->type->name, array('disabled' => 'disabled')) }}
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
				@if($question->type->name == 'Fill in the Blank')
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Answer:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::text('answer', $question->answer) }}
					</div>
				</div>
				@endif
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