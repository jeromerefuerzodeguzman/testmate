@extends('layouts.default')

@section('title')
	Manage Exam - {{ $exam->title }}

@endsection


@section('content')
	<div class="row">
		<div class="large-11 columns">&nbsp;</div><div class="large-1 columns"><a href="{{ URL::to('/exam/' . $exam->id. '/set/add'); }}" data-tooltip class="has-tip tip-right" title="Add new set"><i class="general foundicon-plus"></i></a></div>
	</div>
	<hr />
	<div class="section-container auto" data-section>
		@foreach($sets as $set)
		<?php $ctr = 1; ?>
		<section>
			<p class="title"><a href="#set{{ $set->id }}" style="font-weight: bold;">{{ $set->name }}</a></p>
			<div class="content" data-slug="section2">
				<ul class="button-group">
					<li class="right"><a href="#" class="small button secondary" data-dropdown="qtypes{{ $set->id }}">Add Question</a>
						<ul id="qtypes{{ $set->id }}" class="f-dropdown" data-dropdown-content>
						  <li><a href="{{ Request::root() . '/exam/' . $exam->id . '/question/add/multiple/' . $set->id }}">Multiple Choice (MC)</a></li>
						  <li><a href="{{ Request::root() . '/exam/' . $exam->id . '/question/add/blank/' . $set->id }}">Fill in the Blanks (FB)</a></li>
						</ul>
					</li>
				</ul>
				<table class="large-12">
					<tr>
						<th class="large-6 text-left">Question</th>
						<th class="large-2 text-center">Type</th>
						<th class="large-2 text-left">Answer</th>
						<th class="large-2 text-left">Manage</th>
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
										<a href="{{ URL::to('question/'.$question->id.'/edit'); }}" data-tooltip class="has-tip tip-right" title="Edit"><i class="general foundicon-edit"></i></a>
										<a href="{{ URL::to('add_choices_form/'.$exam->id.'/'. $question->id); }}" data-tooltip class="has-tip tip-right" title="Manage choices"><i class="general foundicon-tools"></i></a>
										<a href="{{ URL::to('question/'.$question->id.'/delete'); }}" data-tooltip class="has-tip tip-right" title="Delete" class="delete_btn"><i class="general foundicon-trash"></i></a>
									</td>
								@elseif($question->type->name == 'Fill in the Blank')
									<td class="large-1 text-center">FB</td>
									<td>{{ $question->answer }}</td>
									<td>
										<a href="{{ URL::to('question/'.$question->id.'/edit'); }}" data-tooltip class="has-tip tip-right" title="Edit"><i class="general foundicon-edit"></i></a>
										<a href="{{ URL::to('question/'.$question->id.'/delete'); }}" data-tooltip class="has-tip tip-right" title="Delete" class="delete_btn"><i class="general foundicon-trash"></i></a>
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
			if (x==true) {
				return true;
			} else {
				return false;
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