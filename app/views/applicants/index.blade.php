@extends('layouts.default')

@section('title')
	Applicants
@endsection


@section('content')
	<table class="large-12">
		<thead>
			<tr>
				<th class="large-6">Name</th>
				<th class="large-4">Exam</th>
				<th class="large-2">Score</th>
			</tr>
		</thead>
		<tbody>
			@foreach($applicants as $applicant)
			
			@endforeach
		</tbody>
	</table>
@endsection