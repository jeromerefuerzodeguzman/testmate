@extends('layouts.default')

@section('title')
	Add Question for {{ $exam->title }}
@endsection


@section('content')
	<?php 
		//define type
		$type_label = $type=="multiple"?"Multiple Choice":"Fill in the Blank";
	?>
	<div class="row">
		<div class="large-11 columns">&nbsp;</div><div class="large-1 columns"><a href="{{ URL::to('/exam/' . $exam->id); }}" data-tooltip class="has-tip tip-right" title="Return to {{ $exam->title }}"><i class="general foundicon-left-arrow"></i></a></div>
	</div>
	<hr />
	{{ Form::open(array('url' => '/exam/' . $exam->id  . '/question/create', 'method' => 'post', 'class' => 'custom')) }}
	<div class="row">
		<div class="large-7 columns">
			<fieldset>
				<legend>Question Info</legend>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Type:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::text('type', $type_label, array('readonly' => 'readonly')) }}
					</div>
				</div>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Set:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::select('set_id', $sets, $set_id) }}
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
				@if($type_label == 'Fill in the Blank')
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Answer:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::text('answer') }}
					</div>
				</div>
				@endif
				<div class="row collapse">
					<div class="large-10 columns">
					</div>
					<div class="large-2 columns">
						{{ Form::submit('ADD', array('class' => 'button secondary small')) }}
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	{{ Form::hidden('exam_id', $exam->id) }}
	{{ Form::close(); }}
@endsection


@section('scripts')
	<script>
		
	</script>
@endsection