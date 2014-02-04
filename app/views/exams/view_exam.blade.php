@extends('layouts.default')

@section('title')
	Manage Exam - {{ $exam->title }}

@endsection


@section('content')
	<ul class="button-group">
		<li><a href="{{ Request::root() . '/exam/' . $exam->id. '/set/add'}}" class="small button">Add Set</a></li>
		<li><a href="#" class="small button" data-dropdown="qtypes">Add Question</a>
			<ul id="qtypes" class="f-dropdown" data-dropdown-content>
			  <li><a href="{{ Request::root() . '/exam/' . $exam->id . '/question/add/multiple' }}">Multiple Choice (MC)</a></li>
			  <li><a href="{{ Request::root() . '/exam/' . $exam->id . '/question/add/blank' }}">Fill in the Blanks (FB)</a></li>
			</ul>
		</li>
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
				<table class="large-12">
					<tr>
						<th class="large-6 text-left">Question</th>
						<th class="large-1 text-center">Type</th>
						<th class="large-2 text-left">Answer</th>
						<th class="large-3 text-left">Manage</th>
					</tr>
					@foreach($questions as $question)
						@if($question->set_id == $set->id)
							<tr onmouseover="mouseOn(this)" onmouseout="mouseOut(this)">
								<td>{{ $ctr }}.) {{ $question->question }}</td>
								@if($question->type->name == 'Multiple Choice')
									<td class="large-1 text-center">MC</td>
									<td>
										<?php $answer = Choice::find($question->answer);
											echo is_null($answer)?'':$answer->label;
										?>
									</td>
									<td>
										<ul class="button-group radius">
											<li class="button secondary small"><a href="{{ Request::root() . '/question/' . $question->id . '/edit'}}" ><img style="cursor: pointer;" width="15px" src={{ Request::root(). '/img/edit.png' }} /></a></li>
											<li class="button secondary small"><a href="{{ Request::root() . '/add_choices_form/' . $exam->id . '/' . $question->id}}" ><img style="cursor: pointer;" width="15px" src={{ Request::root(). '/img/choices.gif' }} /></a></li>
											<li class="button secondary small delete_btn"><input type="hidden" name="question_id" value="{{ $question->id }}" ></input><a href="#" ><img style="cursor: pointer;" width="15px" src={{ Request::root(). '/img/delete.png' }} /></a></li>
										</ul>
									</td>
								@elseif($question->type->name == 'Fill in the Blank')
									<td class="large-1 text-center">FB</td>
									<td>{{ $question->answer }}</td>
									<td>
										<ul class="button-group radius">
											<li class="button secondary small"><a href="{{ Request::root() . '/question/' . $question->id . '/edit'}}" ><img style="cursor: pointer;" width="15px" src={{ Request::root(). '/img/edit.png' }} /></a></li>
											<li class="button secondary small delete_btn"><input type="hidden" name="question_id" value="{{ $question->id }}" ></input><a href="#" ><img style="cursor: pointer;" width="15px" src={{ Request::root(). '/img/delete.png' }} /></a></li>
										</ul>
									</td>
								@endif
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