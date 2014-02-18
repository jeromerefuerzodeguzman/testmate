<?php 
	//toggle issue section
	$route = explode('/',Route::getCurrentRoute()->getPath());
?>

<div class="section-container accordion" data-section="accordion">
	<section class="<?php echo $route[1] == 'exams' ? 'active':'';?>">
		<p class="title" data-section-title>{{ HTML::link("exams", "Examination") }}</p>
	</section>
	<section  class="<?php echo ($route[1] == 'applicants' OR $route[1] == 'applicant') ? 'active':'';?> ">
		<p class="title" data-section-title>{{ HTML::link("applicants", "Applicants") }}</p>
	</section>
</div>

