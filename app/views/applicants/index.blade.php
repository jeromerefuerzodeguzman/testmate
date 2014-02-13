@extends('layouts.default')

@section('title')
	Applicants
@endsection


@section('content')
	<table  width="720px" >
		<thead>
			<tr style="font-size: 16px" >
				<th width="225px">Name</th>
				<th width="225px">Exam</th>
				<th width="225px">Score</th>
			</tr>
		</thead>
		<tbody>
			@foreach($applicants as $applicant)
			
			@endforeach
		</tbody>
	</table>
@endsection