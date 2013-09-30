<?php 
	//toggle issue section
	$controller = explode('/',Route::getCurrentRoute()->getPath());
?>

<div class="section-container accordion" data-section="accordion">
	<section class="">
		<p class="title" data-section-title>{{ HTML::link("all_exams", "View All Exams") }}</p>
	</section>
	<section  class="<?php echo $controller[1] == 'add_exam_form' ? 'active':'';?> ">
		<p class="title" data-section-title>{{ HTML::link("add_exam_form", "Add Exam") }}</p>
	</section>
	<section  class="<?php echo $controller[1] == 'exam_results' ? 'active':'';?> ">
		<p class="title" data-section-title>{{ HTML::link("exam_results", "View Exam Results") }}</p>
	</section>
</div>

