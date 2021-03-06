@extends('layouts.default')

@section('title')
	{{ $exam->title }} - Settings
@endsection


@section('content')
	<div class="row">
		<div class="large-9 columns">&nbsp;</div>
		@if($exam->status == '1')
			<div class="large-1 columns">
				<a href="{{ URL::to('exam/' . $exam->id . '/deactivate'); }}" data-tooltip class="has-tip tip-right" title="Deactivate Exam"><i class="general foundicon-remove"></i></a>
			</div>
		@else
			<div class="large-1 columns">
				<a href="{{ URL::to('exam/' . $exam->id . '/activate'); }}" data-tooltip class="has-tip tip-right" title="Activate Exam"><i class="general foundicon-checkmark"></i></a>
			</div>
		@endif
		<div class="large-1 columns">
			<a href="{{ URL::to('exam/' . $exam->id); }}" data-tooltip class="has-tip tip-right" title="Manage question"><i class="general foundicon-tools"></i></a>
		</div>
		<div class="large-1 columns">
			<a href="{{ URL::to('/exam/' . $exam->id. '/set/add'); }}" data-tooltip class="has-tip tip-right" title="Add new set"><i class="general foundicon-plus"></i></a>
		</div>
	</div>
	<hr />
	<div class="row">
		<div class="large-8 columns">
			{{ Form::open(array('url' => '/exam/' . $exam->id . '/settings/update', 'method' => 'post', 'class' => 'custom')) }}
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
				<div class="row collapse">
					<div class="large-7 columns">
					</div>
					<div class="large-5 columns">
						{{ Form::submit('UPDATE', array('class' => 'button secondary small')) }}
						<a href="{{ Request::root() . '/exams'}}" class="button secondary small">BACK</a>
					</div>
				</div>
			</fieldset>
			<input type="hidden" value="{{ $exam->id }}" name="id" />
			{{ Form::token(); }}
			{{ Form::close(); }}
		</div>
 		
	</div>
	
@endsection


@section('scripts')
	<script>
		
	</script>
@endsection