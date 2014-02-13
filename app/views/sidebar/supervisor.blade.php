<?php 
	//toggle issue section
	$route = explode('/',Route::getCurrentRoute()->getPath());
?>

<div class="section-container accordion" data-section="accordion">
	<section class="<?php echo $route[1] == 'exams' ? 'active':'';?>">
		<p class="title" data-section-title>{{ HTML::link("exams", "Manage") }}</p>
	</section>
	<section  class="<?php echo $route[1] == 'exam' && $route[2] == 'add' ? 'active':'';?>">
		<p class="title" data-section-title>{{ HTML::link("exam/add", "Create") }}</p>
	</section>
	<section  class="<?php echo $route[1] == 'applicants' ? 'active':'';?> ">
		<p class="title" data-section-title>{{ HTML::link("applicants", "Applicants") }}</p>
	</section>
	<section  class="<?php echo $route[1] == 'exam_results' ? 'active':'';?> ">
		<p class="title" data-section-title>{{ HTML::link("exam_results", "Results") }}</p>
	</section>
</div>

