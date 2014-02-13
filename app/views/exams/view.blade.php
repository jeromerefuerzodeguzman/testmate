@extends('layouts.default')

@section('title')
	Examinations
@endsection


@section('content')
	<div class="row">
		<div class="large-11 columns">&nbsp;</div><div class="large-1 columns"><a href="{{ URL::to('exam/add'); }}" data-tooltip class="has-tip tip-right" title="Add new exam"><i class="general foundicon-plus"></i></a></div>
	</div>
	<hr />
	<table class="large-12">
		<thead>
			<tr>
				<th class="large-6">Title</th>
				<th class="large-2">Passing Score</th>
				<th class="large-2">Duration</th>
				<th class="large-2">Manage</th>
			</tr>
		</thead>
		<tbody>
			@foreach($lists as $exam)
			<tr>
				<td><a href="{{ URL::to('exam/'.$exam->id); }}"><h5>{{ $exam->title }}</h5></a></td>
				<td>{{ $exam->passing_score }}%</td>
				<td>{{ $exam->duration }} minutes</td>
				<td><a href="{{ URL::to('exam/'.$exam->id.'/settings'); }}" data-tooltip class="has-tip tip-right" title="Settings"><i class="general foundicon-settings"></i></a>
					<a href="{{ URL::to('exam/'.$exam->id.'/delete'); }}" data-tooltip class="has-tip tip-right" title="Delete" class="delete_btn"><i class="general foundicon-trash"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@endsection


@section('scripts')
	<script>
		$(".delete_btn").click( function() {
			var x = confirm("Are you sure?");
			if (x==true)
			{
				return true;
			}

			return false;
		});
	</script>
@endsection