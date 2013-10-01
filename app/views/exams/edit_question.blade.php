@extends('layouts.default')

@section('title')
	Edit Question
@endsection


@section('content')
	<ul class="button-group">
		<li><a href="{{ Request::root() . '/view_exam/' . $exam->id }}" class="small button">Return to {{ $exam->title }}</a></li>
	</ul>
	<hr />
	{{ Form::open(array('url' => 'edit_question', 'method' => 'post', 'class' => 'custom')) }}
	<div class="row">
		<div class="large-8 columns">
			<fieldset>
				<legend>Add Question</legend>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Text Question:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::textarea('question', $question->question) }}
					</div>
				</div>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Answer: </span>
					</div>
					<div class="small-8 large-9 columns">
						@if( $question->type->name == 'Multiple Choice')
							{{ Form::select('answer', $choices, $question->answer )}}
						@else
							{{ Form::text('answer', $question->answer) }}
						@endif
					</div>
				</div>
				<input type="hidden" name="exam_id" value="{{ $exam->id }}" />
				<input type="hidden" name="question_id" value="{{ $question->id }}" />
			</fieldset>
			{{ Form::submit('SAVE', array('class' => 'button radius')) }}
		</div>
 		
	</div>
	{{ Form::token(); }}
	{{ Form::close(); }}
@endsection


@section('scripts')
	<script>
		
	</script>
@endsection