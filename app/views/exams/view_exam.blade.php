@extends('layouts.default')

@section('title')
	Manage Exam - {{ $exam->title }}

@endsection


@section('content')
	<ul class="button-group">
		<li><a href="#" class="small button">View {{ $exam->title }}</a></li>
		<li><a href="{{ Request::root() . '/add_set_form/' . $exam->id }}" class="small button">Add Set</a></li>
		<li><a href="{{ Request::root() . '/add_question_form/' . $exam->id }}" class="small button">Add Question</a></li>
	</ul>
	<hr />
	<div>
		{{ Form::text('test_onkey_input', '' , array('id' => 'ontest', 'placeholder' => 'Filter QUESTION\'s according to words/number')) }}
	</div>
	<div class="section-container auto" data-section>
		@foreach($sets as $set)
		<?php $ctr = 1; ?>
		<section>
				<p class="title"><a href="#section1" style="font-weight: bold;">{{ $set->name }}</a></p>
				<div class="content" data-slug="section2">
					<table width="690px;">
						<tr style="text-align: left;" >
							<th width="350px">Question</th>
							<th width="95px">Type</th>
							<th width="95px">Answer</th>
							<th width="150px;">Manage</th>
						</tr>
						@foreach($questions as $question)
							@if($question->set_id == $set->id)
								<tr onmouseover="mouseOn(this)" onmouseout="mouseOut(this)">
									<td>{{ $ctr }}.) {{ $question->question }}</td>
									<td>{{ $question->type->name }}</td>
									<td>{{ $question->answer }}</td>
									<td>
										<ul class="button-group radius">
											<li class="button secondary small"><a href="{{ Request::root() . '/edit_question_form/' . $exam->id . '/' . $question->id}}" ><img style="cursor: pointer;" width="15px" src={{ Request::root(). '/img/edit.png' }} /></a></li>
											@if( $question->type->name == 'Multiple Choice')
											<li class="button secondary small"><a href="{{ Request::root() . '/add_choices_form/' . $exam->id . '/' . $question->id}}" ><img style="cursor: pointer;" width="15px" src={{ Request::root(). '/img/choices.gif' }} /></a></li>
											@endif
											<li class="button secondary small delete_btn"><input type="hidden" name="question_id" value="{{ $question->id }}" ></input><a href="#" ><img style="cursor: pointer;" width="15px" src={{ Request::root(). '/img/delete.png' }} /></a></li>
										</ul>
									</td>
								</tr>
								<?php $ctr++; ?>
							@endif
						@endforeach
					</table>
				</div>
		</section>
		@endforeach
	<input type="hidden" name="exam_id" value="{{ $exam->id }}" >
	</div>
@endsection


@section('scripts')
	<script>
		var BASE = "{{ Request::root() }}";

		$(".delete_btn").click( function() {
			var id = $(this).closest('li').find('input[name="question_id"]').val();
			var exam_id = $('input[name="exam_id"]').val();
			var x = confirm("Are you sure?");
			if (x==true)
			{
				$.post(BASE+'/delete_question', {
					id: id,
					exam_id: exam_id,
				}, function(data) {
					location.reload();	
				});
			}
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