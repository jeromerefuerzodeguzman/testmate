@extends('layouts.default')

@section('title')
	Exam Results
@endsection


@section('content')

<table class="large-12">
	<thead>
		<tr>
			<th class="large-1">#</th>
			<th class="large-3">Applicant</th>
			<th class="large-3">Exam</th>
			<th class="large-2">Score</th>
			<th class="large-1">Remark</th>
			<th class="large-2">Date</th>
		</tr>
	</thead>
	<tbody>
		<?php $ctr = 0;?>
		@foreach($results as $result)
		<tr>
			<td>{{ ++$ctr }}</td>
			<td><a href="{{ URL::to('applicant/' . $result->applicant_id) }}">{{ $result->applicant->name }}</a></td>
			<td>{{ $result->exam->title }}</td>
			<td>{{ $result->score }} ({{ round($result->percent, 2) }})</td>
			<td>{{ $result->remark }}</td>
			<td>{{ $result->created_at }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection