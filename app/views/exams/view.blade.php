@extends('layouts.default')

@section('title')
	View All Exams
@endsection


@section('content')
	<div>
		{{ Form::text('test_onkey_input', '' , array('id' => 'ontest', 'placeholder' => 'Search EXAM here...')) }}
	</div>
	<table  width="720px" >
		<thead>
			<tr style="font-size: 16px" >
				<th width="225px">Exam Title</th>
				<th width="225px">Passing Score</th>
				<th width="225px">Duration</th>
				<th width="15px">View</th>
				<th width="15px">Settings</th>
				<th width="15px">Delete</th>
			</tr>
		</thead>
		<tbody>
			@foreach($lists as $list)
			<tr onmouseover="mouseOn(this)" onmouseout="mouseOut(this)">
				<td style="color: #6a0000; font-weight: bold;">{{ $list->title }}</td>
				<td>{{ $list->passing_score }} %</td>
				<td>{{ $list->duration }} mins</td>
				<td style="text-align: center;">
					<a href="{{ Request::root() . '/exam/' . $list->id}}"><img class="view_btn" style="cursor: pointer;" width="15px" src={{ Request::root(). '/img/view.png' }} /></a>
				</td>
				<td style="text-align: center;">
					<a href="{{ Request::root() . '/exam/' . $list->id . '/settings'}}"><img class="setting_btn" style="cursor: pointer;" width="15px" src={{ Request::root(). '/img/setting.png' }} /></a>
				</td>
				<input type="hidden" name="exam_id" value="{{ $list->id }}" ></input>
				<td style="text-align: center;">
					<a href="{{ Request::root() . '/exam/' . $list->id . '/delete'}}"><img class="delete_btn" style="cursor: pointer;" width="15px" src={{ Request::root(). '/img/delete.png' }} /></a>
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


		function mouseOn(x) {
				x.style.backgroundColor='#D2E0F5';
			}

			function mouseOut(x) {
				x.style.backgroundColor='#FFFFFF';
			}

			//Filter table 
			//add index column with all content.
			$("table tr:has(td)").each(function(){
				var t = $(this).text().toLowerCase(); //all row text
				$("<td class='indexColumn'></td>").hide().text(t).appendTo(this);
			});//each tr
			$("#ontest").keyup(function(){
				var s = $(this).val().toLowerCase().split(" ");
				if(s == "") {
					$("table tr:hidden").show();
				} else {
					//show all rows.
					$("table tr:hidden").show();
					$.each(s, function(){
						$("table tr:visible .indexColumn:not(:contains('"+ this + "'))").parent().hide();
					});//each
				}
				
			});//key up.
	</script>
@endsection