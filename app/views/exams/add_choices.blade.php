@extends('layouts.default')

@section('title')
	Add Choices
@endsection


@section('content')
	<ul class="button-group">
		<li><a href="{{ Request::root() . '/view_exam/' . $exam->id }}" class="small button">Return to {{ $exam->title }}</a></li>
	</ul>
	<hr />
	<div class="row">
		<div class="large-8 columns">
			<fieldset>
				<legend>Question</legend>
				<div class="row collapse">
					<p style="font-style: italic; font-weight: bold;"> -- " {{ $question->question }} " </p>
				</div>
			</fieldset>
			<fieldset>
				<legend>Choices</legend>
				<table width="428px;">
					<tr style="text-align: left;">
						<th width="50px;"></th>
						<th>Label</th>
					</tr>
					@foreach($choices as $choice)
					<tr>
						<td> -- </td>
						<td>{{ $choice->label }}</td>
					</tr>
					@endforeach
				</table>
			</fieldset>
			{{ Form::open(array('url' => 'add_choices', 'method' => 'post', 'class' => 'custom')) }}
			<fieldset>
				<legend>Add Choices</legend>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Text:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::textarea('label', Input::old('label'), array('placeholder' => 'Choice Text')) }}
					</div>
				</div>
				<input type="hidden" name="exam_id" value="{{ $exam-> id }}" />
				<input type="hidden" name="question_id" value="{{ $question-> id }}" />
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