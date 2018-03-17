<?php 
/**
 * Template Name: Post a Job
 */

global $current_user, $wp_rewrite;
$general_opt	= new ET_GeneralOptions();

$job	= get_query_var('job_id');

if (!!$job){
	$job	= get_post($job);
	if ( !isset($job->ID) || !isset($current_user->ID) || $job->post_author != $current_user->ID ){

		// not the job author, redirect to this page without var
		wp_redirect( et_get_page_link('post-a-job') );
		exit;
	}

	$job	= et_create_jobs_response($job);
}

$job_opt 		= new ET_JobOptions () ;
$contact_widget	= $job_opt->get_post_job_sidebar ();
$term_of_use	= et_get_page_link('terms-of-use' , array () , false);
if( isset($current_user->ID)) {
	$recent_location  	=	 et_get_user_field ($current_user->ID,'recent_job_location');
	
	$full_location 		=	isset($recent_location['full_location']) ? $recent_location['full_location'] : '' ;
	$location 			=	isset($recent_location['location']) ? $recent_location['location'] : '';
	$location_lat		=	isset($recent_location['location_lat']) ? $recent_location['location_lat'] : '';
	$location_lng 		=	isset($recent_location['location_lng']) ? $recent_location['location_lng'] : '';
	$company			=	et_create_companies_response($current_user->ID);
	$apply_method		=	$company['apply_method'];
	$apply_email		=	$company['apply_email'];
	$applicant_detail	=	$company['applicant_detail'];	
} else {
	$apply_method		=	'isapplywithprofile';
	$apply_email		=	'';
	$applicant_detail	=	'';
	$full_location 		=	 '';
	$location 			=	 '';
	$location_lat		=	 '';
	$location_lng 		=	 '';
}
remove_action( 'je_after_register_form' , 'render_captcha' );
get_header(); ?>

<div class="wrapper">
	<div class="heading">
		<div class="main-center">
			<h1 class="title"><span class="icon" data-icon="W"></span>
				<?php 
					if(!$job) {
						_e('Post a Job', ET_DOMAIN);
					}
					else {
						_e('Renew this Job', ET_DOMAIN);
					}
				?>
			</h1>
		</div>
	</div>
	
	<div class="main-center margin-top25 clearfix">
	<?php 
		$main_colum	=	'full-column';
		if( !empty($contact_widget) || current_user_can('manage_options') ) {
			$main_colum	=	'main-column';
		}
	?>
		<div class="<?php echo $main_colum ?>" id="post_job">
			
			<?php if(!!$job){ // add the existed job data here for js ?>
				<script type="application/json" id="job_data">
					<?php echo json_encode($job);?>
				</script>
			<?php }?>

			<div class="post-a-job">
				<?php $steps = array('1','2','3','4'); ?>

				<div class="step current <?php // if(!!$job) echo 'completed';?>" id='step_package'>
					<div class="toggle-title f-left-all  <?php if(!!$job) echo 'toggle-complete';?>">
						<div class="icon-border"><?php echo array_shift($steps) ?></div>
						<span class="icon" data-icon="2"></span>
						<span class="step-plan-label" data-label="<?php _e('Choose the pricing plan that fits your needs', ET_DOMAIN);?>" >
							<?php _e('Choose the pricing plan that fits your needs', ET_DOMAIN);?>
						</span>
					</div>
					<div class="toggle-content clearfix">
					<?php 
					global $current_user;
					$plans = et_get_payment_plans();
					do_action ('je_before_job_package_list');

					if ( !empty($plans) ){	?>						
						<ul>
							<?php 
							$only_free = false;
							/**
							 * check if only one package force user select it
							*/
							if(count($plans) == 1 ) {
								$temp	=	$plans;
								$p		=	array_pop($temp);
								if( $p['price'] == 0 )  $only_free = true;
							}

							foreach ( $plans as $plan ) :
								$sel = ( isset($job['job_package']) && $job['job_package'] == $plan['ID']) ? 'selected' : '';

								$featured_text = $plan['featured'] ? __('featured', ET_DOMAIN) : __('normal', ET_DOMAIN);
								$plan['quantity'] = isset($plan['quantity']) ? $plan['quantity'] : 1;
								if ($plan['quantity'] > 1){
									$content_plural = sprintf( __('Each job will be displayed as %s for %d days.', ET_DOMAIN), $featured_text, $plan['duration'] );
									$content_single = sprintf( __('Each job will be displayed as %s for %d day.', ET_DOMAIN), $featured_text, $plan['duration'] );
								}else {
									$content_plural = sprintf( __('Your job will be displayed as %s for %d days.', ET_DOMAIN), $featured_text, $plan['duration'] );
									$content_single = sprintf( __('Your job will be displayed as %s for %d day.', ET_DOMAIN), $featured_text, $plan['duration'] );
								}
								$desc = $plan['duration'] == 1 ? $content_single : $content_plural;
								$purchase_plans = !empty($current_user->ID) ? et_get_purchased_quantity($current_user->ID) : array();
								$a = 0; $j =  0;
							?>
							<li class="clearfix <?php // echo $sel;?>">
								<div class="label f-left">
									<div class="title">
										<?php echo $plan['title'] ?>
										<?php if($plan['price'] > 0) {?>
											<span> <?php echo et_get_price_format( $plan['price'], 'sup' ) ?> </span> 
										<?php } ?>
										<?php 
										// if current user have purchased plans, show they 
										if (!empty($purchase_plans[$plan['ID']]) && $purchase_plans[$plan['ID']] > 0) {
											echo '<span class="quan"> - ';
											echo $purchase_plans[$plan['ID']] > 1 ? 
												sprintf( __('You have %d jobs in this plan', ET_DOMAIN), $purchase_plans[$plan['ID']]) : 
												sprintf( __('You have %d job in this plan', ET_DOMAIN), $purchase_plans[$plan['ID']]);
												$a	=	1;
											echo '</span>';
										} else if($plan['price'] > 0) {
											echo '<span class="quan"> - ';
												echo $plan['quantity'] > 1 ? 
													sprintf( __('This plan includes %s jobs', ET_DOMAIN), $plan['quantity']) : 
													sprintf( __('This plan includes %s job', ET_DOMAIN), $plan['quantity']);
											echo '</span>';
										}
										?>

									</div>
									<div class="desc"><?php echo $desc ?></div>
								</div>
								<div class="btn-select f-right">
									<!-- /*add class mark-step will be auto select*/ -->
									<button class="bg-btn-hyperlink border-radius select_plan <?php if( ($a == 1 && $j == 0) || $only_free ) { echo 'mark-step' ; $j = 1;} ?>" 
										data-package="<?php echo $plan['ID'];?>" 
										data-price="<?php echo $plan['price'];?>" 
										<?php if( $plan['price'] > 0 ) { ?>
											data-label="<?php printf(__("You have selected: '%s'", ET_DOMAIN) , $plan['title'] ); ?>"
										<?php } else { ?>
											data-label="<?php _e("You are currently using the 'Free' plan", ET_DOMAIN); ?>"
										<?php } ?>
									>
										<?php _e('Select', ET_DOMAIN );?>
									</button>
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
					<?php }
					do_action ('je_after_job_package_list');
					 ?>
					<script id="package_plans" type="text/data">
					<?php echo json_encode($plans); ?>
					</script>						
					</div>
				</div>
				<?php if ( !et_is_logged_in() ){
					get_template_part('template/step','1');
				}
				get_template_part('template/step','2');
				get_template_part('template/step','3');
				?>
			
			</div>

		</div>
		<?php 
			if( !empty($contact_widget) || current_user_can('manage_options') ) {
			
		?>
			<div class="second-column widget-area" id="static-text-sidebar">
			<div id="sidebar" class="post-job-sidebar">

				<?php 
				global $user_ID;
				je_user_package_data ($user_ID , 'job');

				foreach ($contact_widget as $key => $value) { ?>
				<div class="widget widget-contact bg-grey-widget" id="<?php echo $key ?>">
					<div class="view">
						<?php echo $value ?>
					</div>
					<?php if(current_user_can('manage_options')) { ?>
					<div class="btn-widget edit-remove"> 
						<a href="#" class="bg-btn-action border-radius edit"><span class="icon" data-icon='p'></span></a> 
						<a href="#" class="bg-btn-action border-radius remove"><span class="icon" data-icon='#'></span></a> 
					</div>
					<?php } ?>
				</div>
				
				<?php } ?>
			</div>

			<?php if(current_user_can('manage_options')) { ?>
				<div class="widget widget-contact bg-grey-widget" id="widget-contact">
					<a href="#" class="add-more"><?php _e('Add a text widget +', ET_DOMAIN) ?> </a>
				</div>
			<?php } ?>

			</div>
		<?php } ?>
	</div>
</div>

<?php get_footer(); 
