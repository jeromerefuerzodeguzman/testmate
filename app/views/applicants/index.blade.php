@extends('layouts.default')

@section('title')
	Applicants
@endsection


@section('content')
	<div class="row">
		<div class="large-11 columns">&nbsp;</div><div class="large-1 columns"><a href="{{ URL::to('applicant/add'); }}" data-tooltip class="has-tip tip-right" title="Add new applicant"><i class="general foundicon-plus"></i></a></div>
	</div>
	<hr />
	@if(count($applicants) > 0)
	<table class="large-12">
		<thead>
			<tr>
				<th class="large-7">Name</th>
				<th class="large-2">Exam</th>
				<th class="large-1">Score</th>
				<th class="large-2">Date</th>
			</tr>
		</thead>
		<tbody>
			@foreach($applicants as $applicant)
			<tr>
				<td class="text-left"><h5>{{ $applicant->name }} ({{ $applicant->code }})</h5></td>
				<td class="text-left">{{ isset($applicant->exam->title)?$applicant->exam->title:"" }}</td>
				<td class="text-left">{{ $applicant->score }}</td>
				<td class="text-left">{{ date('Y-m-d', strtotime($applicant->created_at)) }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
	No applicants found
	@endif
@endsection