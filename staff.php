<?php
/*
Template Name: Staff
*/
?>
<!DOCTYPE html>

<html>

<head>
   
   <title><?php bloginfo("Newspaper"); ?><?php wp_title(); ?></title>
   <meta charset="<?php bloginfo('charset'); ?>" />
   <meta name="generator" content="Wordpress <?php bloginfo('version'); ?>" />
   <meta name="description" content="<?php bloginfo('description'); ?>">
   <link rel="stylesheet" href="<?php bloginfo("stylesheet_url"); ?>" type="text/css" media="screen" />
   
   	<!--Type Kit-->
	<script type="text/javascript" src="http://use.typekit.com/ojk4cnw.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
   
   
   <style type="text/css">
   
   
   </style>
   
   
   <?php wp_head(); ?>
   <script type="text/javascript" src="http://cdn.jquerytools.org/1.2.4/full/jquery.tools.min.js"></script>
   <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/jquery.simplyscroll.js"></script>
   <script type="text/javascript">
    $(function(){
      $(".glass").hover(showSearch,hideSearch);
   });
   var mouseinglass = 0;
         var mouseinsearch = 0;
         var timer = 0;
         function showSearch(){
            $(".searchForm").show();
            mouseinglass = 1;
            $(".searchForm").hover(focusSearch,blurSearch);
            timer = setTimeout("timesUp()",3000);
         }
         function focusSearch() {
            mouseinsearch = 1;
         }
         function blurSearch() {
            mouseinsearch = 0;
         }
         function hideSearch() { 
            mouseinglass = 0;
         }        
         function timesUp() {
            if ((! mouseinglass) && (! mouseinsearch)) {
               $(".searchForm").fadeOut();
               clearTimeout($timer);
            }
            else {
               timer = setTimeout("timesUp()",3000);
            }
         }
   
   </script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19864735-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>


<body>
   

   
  	<div class="header">

	      <?php get_header(); ?>

	</div>

   <div class="container staffcontainer">
	<h1>Staff</h1>
	<p class="staffThanks">The All-Nighter is the culmination of all of these people's tireless effort and dedication.</p>
<?php
// Get users and sort depending on role
$users = get_users_of_blog();
$founders = array();
$staff = array();
foreach ($users as $user) {
   $user_object = new WP_User($user->ID);
   $roles = $user_object->roles;
   if ($roles[0] == 'administrator') {
      $founders[] = $user->ID;
   }
   else {
      $staff[] = $user->ID;
   }
}
?>
     
		
		
		<?php
		$editorUsers = get_users_with_role('editor');
		$adminUsers = get_users_with_role('admin');
		?>
		
		<div>
			<h2 class="staffHeadline contrib">Editors</h2>
			<ul class="writers">
				<?php
		         foreach($adminUsers as $admin) {
		         $user_info = get_userdata($admin);
		         echo "<li>";
		         echo "<a href=\"".get_bloginfo('url')."/?author=";
		         echo $user_info->ID;
		         echo "\">";
		         echo userphoto($user_info->ID);
		         echo "</a>";
		         echo '<div class="authorName">';
		         echo "<a href=\"".get_bloginfo('url')."/?author=";
		         echo $user_info->ID;
		         echo "\">".$user_info->display_name;
		         echo "</a>";
		         echo "</div>";
		         echo "<p class='nickname'><em>".$user_info->nickname;
		         echo "</em></p>";
		         echo "</li>\n";

		         }
		         ?>
				
	         <?php
	         foreach($editorUsers as $editor_id) {
	         $user_info = get_userdata($editor_id);
	         echo "<li>";
	         echo "<a href=\"".get_bloginfo('url')."/?author=";
	         echo $user_info->ID;
	         echo "\">";
	         echo userphoto($user_info->ID);
	         echo "</a>";
	         echo '<div class="authorName">';
	         echo "<a href=\"".get_bloginfo('url')."/?author=";
	         echo $user_info->ID;
	         echo "\">".$user_info->display_name;
	         echo "</a>";
	         echo "</div>";
	         echo "<p class='nickname'><em>".$user_info->nickname;
	         echo "</em></p>";
	         echo "</li>\n";

	         }
	         ?>
			 
	         </ul>
		</div>	
		<div class="clear"></div>
		
		<?php
		$developerUsers = get_users_with_role('developer');
		?>
		
		<div>
			<h2 class="staffHeadline contrib">Development / Design</h2>
			<ul class="writers">
	         <?php
	         foreach($developerUsers as $developer_id) {
	         $user_info = get_userdata($developer_id);
	         echo "<li>";
	         echo "<a href=\"".get_bloginfo('url')."/?author=";
	         echo $user_info->ID;
	         echo "\">";
	         echo userphoto($user_info->ID);
	         echo "</a>";
	         echo '<div class="authorName">';
	         echo "<a href=\"".get_bloginfo('url')."/?author=";
	         echo $user_info->ID;
	         echo "\">".$user_info->display_name;
	         echo "</a>";
	         echo "</div>";
	         echo "<p class='nickname'><em>".$user_info->nickname;
	         echo "</em></p>";
	         echo "</li>\n";

	         }
	         ?>
	         </ul>
		</div>	
		<div class="clear"></div>
		
		<?php
		$contributorUsers = get_users_with_role('contributor');
		?>
		
		<div>
			<h2 class="staffHeadline contrib">Contributors</h2>
			<ul class="writers">
	         <?php
	         foreach($contributorUsers as $contributor_id) {
	         $user_info = get_userdata($contributor_id);
	         echo "<li>";
	         echo "<a href=\"".get_bloginfo('url')."/?author=";
	         echo $user_info->ID;
	         echo "\">";
	         echo userphoto($user_info->ID);
	         echo "</a>";
	         echo '<div class="authorName">';
	         echo "<a href=\"".get_bloginfo('url')."/?author=";
	         echo $user_info->ID;
	         echo "\">".$user_info->display_name;
	         echo "</a>";
	         echo "</div>";
	         echo "<p class='nickname'><em>".$user_info->nickname;
	         echo "</em></p>";
	         echo "</li>\n";

	         }
	         ?>
	         </ul>
		</div>	
		<div class="clear"></div>
		<?php
		$pastContributers = get_users_with_role('Goodbye');
		?>
		<div>
			<h2 class="staffHeadline contrib">Past Contributors</h2>
			<ul class="pastContributors">
				
	         <?php
	         foreach($pastContributers as $past_id) {
	         $user_info = get_userdata($past_id);
	         echo "<li>";
	         echo '<div class="authorName">';
	         echo "<a href=\"".get_bloginfo('url')."/?author=";
	         echo $user_info->ID;
	         echo "\">".$user_info->display_name;
	         echo "</a>";
	         echo "</div>";
	         echo "<p class='nickname'><em>".$user_info->nickname;
	         echo "</em></p>";
	         echo "</li>\n";

	         }
	         ?>
				
	         </ul>
		</div>
		<div class="clear"></div>


   </div>
   


      <?php get_footer(); ?>
