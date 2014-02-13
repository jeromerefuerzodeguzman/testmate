@extends('layouts.default')

@section('title')
	Add Applicant
@endsection


@section('content')
	{{ Form::open(array('url' => '/applicant/create', 'method' => 'post', 'class' => 'custom')) }}
	<div class="row">
		<div class="large-8 columns">
			<fieldset>
				<legend>Basic Info</legend>
				<div class="row collapse">
					<div class="large-3 columns">
						<span class="prefix">Name:</span>
					</div>
					<div class="large-9 columns">
						{{ Form::text('name', Input::old('name'), array('placeholder' => 'Name')) }}
					</div>
				</div>
				<div class="row collapse">
					<div class="large-3 columns">
						<span class="prefix">Choose Exam:</span>
					</div>
					<div class="large-9 columns">
						{{ Form::select('exam_id', $exams) }}
					</div>
				</div>
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
	{{ Form::token(); }}
	{{ Form::close(); }}
@endsection


@section('scripts')
	<script>
		
	</script>
@endsection