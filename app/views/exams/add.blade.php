@extends('layouts.default')

@section('title')
	Add Exam
@endsection


@section('content')
	{{ Form::open(array('url' => '/exam/create', 'method' => 'post', 'class' => 'custom')) }}
	<div class="row">
		<div class="large-8 columns">
			<fieldset>
				<legend>Exam Info</legend>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Title:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::text('title', Input::old('title'), array('placeholder' => 'Title')) }}
					</div>
				</div>
				<div class="row collapse">
					<div class="small-3 columns">
						<span class="prefix">Passing Score:</span>
					</div>
					<div class="small-8 columns">
						{{ Form::text('passing_score', Input::old('passing_score'), array('placeholder' => 'Percentage')) }}
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
						{{ Form::text('duration', Input::old('duration'), array('placeholder' => 'Minutes')) }}
					</div>
					<div class="small-1 columns" style="border-right: 1px solid #d9d9d9">
						<span class="prefix">Min</span>
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