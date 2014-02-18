@extends('layouts.default')

@section('title')
	{{ $applicant->name }} ({{ $applicant->code }})
@endsection


@section('content')
	<div class="row">
		<div class="large-10 columns">&nbsp;</div><div class="large-1 columns"><a href="#" data-tooltip class="has-tip tip-right" title="Add new set"><i class="general foundicon-plus"></i></a></div>
	</div>
	<hr />
	<div class="section-container auto large-8" data-section>
		<section>
			<p class="title"><a href="#info">Info</a></p>
			<div class="content" data-slug="section2">
				<table class="large-6">
					<tr>
						<td class="large-4 text-right"><h5 class="subheader">Name:</h5></td><td class="large-8">{{ $applicant->name }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h5 class="subheader">Code:</h5></td><td class="large-8">{{ $applicant->code }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h5 class="subheader">Exams Taken:</h5></td><td class="large-8">{{ count($exams) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h5 class="subheader">Date:</h5></td><td class="large-8">{{ $applicant->created_at }}</td>
					</tr>
				</table>
			</div>
		</section>
		<section>
			<p class="title"><a href="#exams">Exams</a></p>
			<div class="content" data-slug="section2">
				<table class="large-12">
					<thead>
						<tr>
							<th class="large-1">#</th>
							<th class="large-5">Exam</th>
							<th class="large-2">Score</th>
							<th class="large-2">Remark</th>
							<th class="large-2">Date</th>
						</tr>
					</thead>
					<tbody>
						<?php $ctr = 0;?>
						@foreach($exams as $exam)
						<tr>
							<td>{{ ++$ctr }}</td>
							<td>{{ $exam->exam->title }}</td>
							<td>{{ $exam->score }} ({{ round($exam->percent, 2) }})</td>
							<td>{{ $exam->remark }}</td>
							<td>{{ $exam->created_at }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</section>
	</div>
@endsection