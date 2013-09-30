@extends('layouts.default')

@section('title')
	{{ $exam->title }} - Settings
@endsection


@section('content')
	<div class="row">
		<div class="large-8 columns">
			{{ Form::open(array('url' => 'update_exam_settings', 'method' => 'post', 'class' => 'custom')) }}
			<fieldset>
				<legend>Exam Info</legend>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Title:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::text('title', $exam->title) }}
					</div>
				</div>
				<div class="row collapse">
					<div class="small-3 columns">
						<span class="prefix">Passing Score:</span>
					</div>
					<div class="small-8 columns">
						{{ Form::text('passing_score', $exam->passing_score) }}
					</div>
					<div class="small-1 columns" style="border-right: 1px solid #d9d9d9">
						<span class="prefix">%</span>
					</div>
				</div>
				<div class="row collapse">
					<div class="small-3 columns">
						<span class="prefix">Duration:</span>
					</div>
					<div class="small-8 columns">
						{{ Form::text('duration', $exam->duration) }}
					</div>
					<div class="small-1 columns" style="border-right: 1px solid #d9d9d9">
						<span class="prefix">Min</span>
					</div>
				</div>
			</fieldset>
			{{ Form::submit('ADD', array('class' => 'button radius')) }}
			<input type="hidden" value="{{ $exam->id }}" name="id"></input>
			{{ Form::token(); }}
			{{ Form::close(); }}
			<a href="{{ Request::root() . '/all_exams'}}"><button style="bottom: 79px; left: 90px;" class="button radius">BACK</button></a>
		</div>
 		
	</div>
	
@endsection


@section('scripts')
	<script>
		
	</script>
@endsection