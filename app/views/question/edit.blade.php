@extends('layouts.default')

@section('title')
	Edit Question
@endsection


@section('content')
	<div class="row">
		<div class="large-11 columns">&nbsp;</div><div class="large-1 columns"><a href="{{ URL::to('/exam/' . $exam->id); }}" data-tooltip class="has-tip tip-right" title="Return to {{ $exam->title }}"><i class="general foundicon-left-arrow"></i></a></div>
	</div>
	<hr />
	{{ Form::open(array('url' => '/question/' . $question->id  . '/update', 'method' => 'post', 'class' => 'custom')) }}
	<div class="row">
		<div class="large-7 columns">
			<fieldset>
				<legend>Question Info</legend>
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
				<div class="row collapse">
					<div class="large-10 columns">
					</div>
					<div class="large-2 columns">
						{{ Form::submit('DONE', array('class' => 'button secondary small')) }}
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	{{ Form::hidden('question_id', $question->id); }}
	{{ Form::token(); }}
	{{ Form::close(); }}
@endsection


@section('scripts')
	<script>
		
	</script>
@endsection