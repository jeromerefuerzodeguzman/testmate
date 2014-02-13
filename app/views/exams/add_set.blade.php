@extends('layouts.default')

@section('title')
	Add Set for {{ $exam->title }}
@endsection


@section('content')
	<div class="row">
		<div class="large-10 columns">&nbsp;</div><div class="large-1 columns"><a href="{{ URL::to('/exam/' . $exam->id. '/set/add'); }}" data-tooltip class="has-tip tip-right" title="Add new set"><i class="general foundicon-plus"></i></a></div><div class="large-1 columns"><a href="{{ URL::to('/exam/' . $exam->id); }}" data-tooltip class="has-tip tip-right" title="Return to {{ $exam->title }}"><i class="general foundicon-left-arrow"></i></a></div>
	</div>
	<hr />
	{{ Form::open(array('url' => '/exam/' . $exam->id . '/set/create', 'method' => 'post', 'class' => 'custom')) }}
	<div class="row">
		<div class="large-8 columns">
			<fieldset>
				<legend>Set Name</legend>
				<div class="row collapse">
					<div class="large-9 columns">
						{{ Form::text('name', Input::old('name'), array('placeholder' => 'Enter your set name')) }}
					</div>
					<div class="large-1 columns"></div>
					<div class="large-2 columns">
						{{ Form::submit('ADD', array('class' => 'button small')) }}
					</div>
				</div>
				<input type="hidden" name="exam_id" value="{{ $exam-> id }}" />
			</fieldset>
		</div>
 		
	</div>
	{{ Form::token(); }}
	{{ Form::close(); }}
@endsection