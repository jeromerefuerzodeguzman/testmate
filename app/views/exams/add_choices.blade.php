@extends('layouts.default')

@section('title')
	Manage Choices
@endsection


@section('content')
	<div class="row">
		<div class="large-10 columns">&nbsp;</div>
		<div class="large-1 columns"><a href="#" data-tooltip class="has-tip tip-right" title="Add new choice" data-reveal-id="myModal" data-reveal><i class="general foundicon-plus"></i></a></div>
		<div class="large-1 columns"><a href="{{ URL::to('/exam/' . $exam->id); }}" data-tooltip class="has-tip tip-right" title="Return to {{ $exam->title }}"><i class="general foundicon-left-arrow"></i></a></div>
	</div>
	<hr />
	<div class="row">
		<div class="large-12 columns">
			<h4>Question</h4>
			<h5 class="subheader">{{ $question->question }}</h5>
			<h5>Choices</h5>
			<table class="large-6">
				<?php $letter = 'A'; ?>
				{{ Form::open(array('url' => 'question/' . $question->id . '/setanswer', 'method' => 'post', 'class' => 'custom', 'id' => 'answer_form')) }}
				@foreach($choices as $choice)
				<tr>
					<td class="large-1">{{ $letter++ }}.</td>
					<td class="text-justify"><a href="#" data-tooltip data-reveal-id="editModal" class="edit-link" title="Click to edit" id="{{ $choice->id }}">{{ $choice->label }}</a></td>
					<td class="large-1">
						{{ Form::radio('answer', $choice->id, $question->answer == $choice->id?true:false) }}
					</td>
				</tr>
				@endforeach
				{{ Form::close() }}
			</table>
		</div>
	</div>
@endsection

@section('popups')
	<div id="myModal" class="reveal-modal small" data-reveal>
		<h5>Add Choice</h5>
		<hr />
		{{ Form::open(array('url' => 'add_choices', 'method' => 'post', 'class' => 'custom')) }}
			<div class="row collapse">
				<div class="large-12 columns">
					{{ Form::textarea('label', Input::old('label'), array('placeholder' => 'Choice Text')) }}
				</div>
			</div>
			<div class="row collapse">
				<div class="large-12 columns">
					{{ Form::submit('ADD', array('class' => 'button secondary small')) }}
				</div>
			</div>
			<input type="hidden" name="exam_id" value="{{ $exam->id }}" />
			<input type="hidden" name="question_id" value="{{ $question->id }}" />
			{{ Form::token(); }}
		{{ Form::close(); }}
	</div>

	<div id="editModal" class="reveal-modal small" data-reveal>
		<h5>Edit Choice</h5>
		<hr />
		{{ Form::open(array('url' => 'choice/update', 'method' => 'post', 'class' => 'custom')) }}
			<div class="row collapse">
				<div class="large-12 columns">
					{{ Form::textarea('label', Input::old('label'), array('id' => 'label', 'placeholder' => 'Choice Text')) }}
				</div>
			</div>
			<div class="row collapse">
				<div class="large-12 columns">
					{{ Form::submit('Update', array('class' => 'button secondary small')) }}
				</div>
			</div>
			<input type="hidden" name="exam_id" value="{{ $exam->id }}" />
			<input type="hidden" name="question_id" value="{{ $question->id }}" />
			<input type="hidden" name="choice_id" id="choice_id" />
			{{ Form::token(); }}
		{{ Form::close(); }}
	</div>
@endsection

@section('scripts')
	<script type="text/javascript">
        $('.edit-link').click(function(){
			var id = $(this).attr('id');
			$('#choice_id').val(id);
			$('#label').val($(this).html());
		});

		 $('input:radio').change(function(){
			$('#answer_form').submit();
		});

		@if(count($errors)>0)
			$('#{{ Session::get('from') }}Modal').foundation('reveal', 'open');
		@endif
	</script>
@endsection