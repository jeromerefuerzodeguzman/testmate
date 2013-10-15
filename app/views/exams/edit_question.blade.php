@extends('layouts.default')

@section('title')
	Edit Question
@endsection


@section('content')
	<ul class="button-group">
		<li><a href="{{ Request::root() . '/exam/' . $exam->id }}" class="small button">Return to {{ $exam->title }}</a></li>
	</ul>
	<hr />
	{{ Form::open(array('method' => 'post', 'class' => 'custom')) }}
	<div class="row">
		<div class="large-7 columns">
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
					<span class="prefix">Type:</span>
				</div>
				<div class="small-8 large-9 columns">
					{{ Form::select('type_id', $types, $question->type_id) }}
				</div>
			</div>
			<div class="row collapse">
				<div class="small-4 large-3 columns">
					<span class="prefix">Text Question:</span>
				</div>
				<div class="small-8 large-9 columns">
					{{ Form::textarea('question', $question->question) }}
				</div>
			</div>
			<div class="row collapse">
				<div class="small-4 large-3 large-offset-9 columns">
					{{ Form::submit('UPDATE', array('class' => 'small button radius large-12')) }}
				</div>
			</div>
			<input type="hidden" name="exam_id" value="{{ $exam->id }}" />
			<input type="hidden" name="question_id" value="{{ $question->id }}" />
		</div>
 		<div class="large-5 columns">
 			<div class="row" id="multiple_choice">
 				<fieldset>
					<legend>Choices</legend>
					<div class="row collapse">
						<div class="small-4 large-3 columns">
							<span class="prefix">Choice A:</span>
						</div>
						<div class="small-8 large-9 columns">
							{{ Form::text('choice') }}
						</div>
					</div>
				</fieldset>
	 			<fieldset>
					<legend>Answer</legend>
						<div class="row collapse">
							<div class="small-4 large-3 columns">
								<span class="prefix">Answer:</span>
							</div>
							<div class="small-8 large-9 columns">
								{{ Form::text('answer') }}
							</div>
						</div>
					<input type="hidden" name="exam_id" value="{{ $exam-> id }}" />
				</fieldset>
 			</div>
 		</div>
	</div>
	
	{{ Form::token(); }}
	{{ Form::close(); }}
@endsection

@section('scripts')
	<script>
		
	</script>
@endsection