<?php


	if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'ericasSidebar',
	));
	if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'upcomingEvents',
	));
	if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'iCaughtYou',
	));
	if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'facultyQuotes',
	));
	if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'freshmenQuestion',
	));
add_theme_support("menus"); 

if ( function_exists('register_nav_menu') ):
	register_nav_menu( 'primary_nav', "Primary Navigation");
	register_nav_menu('secondary_nav', "Secondary Navigation");
endif;




function is_subpage() {
	global $post;                                 // load details about this page
        if ( is_page() && $post->post_parent ) {      // test to see if the page has a parent
               $parentID = $post->post_parent;        // the ID of the parent is this
               return $parentID;                      // return the ID
        } else {                                      // there is no parent so...
               return false;                          // ...the answer to the question is false
        };
};

function get_the_content_our_way($more,$strip_teaser) {
   if (! in_category(array('tylerdibiasio','mishatownsend','korwinbriggs','twogirls','thefinerthings'))) {
      $content = get_the_content($more,$strip_teaser);
      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);
      return "$content";
   }
   else {
//get the category
	if(in_category('tylerdibiasio')){
      $href = "<a href=\"". get_option('siteurl')."/category/tylerdibiasio\">";
	}elseif(in_category('mishatownsend')){
	 $href = "<a href=\"". get_option('siteurl')."/category/mishatownsend\">";	
	}
	elseif(in_category('korwinbriggs')){
	 $href = "<a href=\"". get_option('siteurl')."/category/korwinbriggs\">";	
	}
	elseif(in_category('twogirls')){
	 $href = "<a href=\"". get_option('siteurl')."/category/twogirls\">";	
	}
	elseif(in_category('thefinerthings')){
	 $href = "<a href=\"". get_option('siteurl')."/category/thefinerthings\">";	
	}
      $content = get_the_content($more,$strip_teaser);
      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);
      $content = preg_replace('/(.*)(<a.*?href.*?\>)/is',"\\1$href",$content);
      return "$content";
   }
}


function has_children_cat($parent_id) {
   # Brute force approach, but I don't see any other way with the standard
   # wp functions. --M.Morse
   $category_ids = get_all_category_ids();
   foreach($category_ids as $cat_id) {
      if ($cat_id == $parent_id) {
         continue;
      }
      if (cat_is_ancestor_of($parent_id,$cat_id)) {
         return 1;
      }
   }
   return 0;
}


// get_cat_classes(): Returns class names separated by spaces. Only returns
// top level classes.
// Example:  cat-opinion
// Called by collapsing archives plugin RISD mods
function get_cat_classes($post_obj) {
   $cat_array = array();
   foreach(get_the_category($post_obj->ID) as $category) {
      if (! $category->category_parent) {
         $cat_array[] = 'cat-' . $category->category_nicename;
      }
   }
   $count = count($cat_array);
   if ($count == 0) {
      return '';
   }
   return ' ' . implode(' ',$cat_array);
}

// add_theme_support( 'post-thumbnails' );
// set_post_thumbnail_size( 198, 110, true );


# get_users_with_role: Returns an array of user IDs that have the role
# M.Morse
function get_users_with_role($role) {
   global $wpdb;
   $query = <<<EOM
SELECT user_id
FROM $wpdb->usermeta
WHERE meta_key = 'wp_capabilities'
AND meta_value LIKE '%$role%'
EOM;
   $results = $wpdb->get_results($query,ARRAY_A);
   $results_array = array();
   foreach ($results as $result) {
      $results_array[] = $result['user_id'];
   }
   return $results_array;
}
 
# mk_negative_user_ids: Takes the array from get_users_with_role, and returns
# a string of the ids with minus signs separated by commas.
function mk_negative_user_ids($ids) {
   $new_array = array();
   foreach ($ids as $id) {
      $new_array[] = "-$id";
   }
   return implode(',',$new_array);
}
# mk_user_ids: Takes the array from get_users_with_role, and returns
# a string of the ids separated by commas.
function mk_user_ids($ids) {
   $new_array = array();
   foreach ($ids as $id) {
      $new_array[] = "$id";
   }
   return implode(',',$new_array);
}
#exclude pages from search results
function vibeExcludePages($query) {
        if ($query->is_search) {
        $query->set('post_type', 'post');
                                }
        return $query;
}
add_filter('pre_get_posts','vibeExcludePages');

function risd_mail_filter ($var) {
   // Removes the string [/caption] from all emails. These have appeared
   // in the emails sent by subscribe2.
   $var['message'] = preg_replace("/\[\/caption]/i",'',$var['message']);
   return $var;
}

add_filter('wp_mail','risd_mail_filter');

# risd_coauthors_posts_links() 
# Replaces coauthors_posts_links() from the co-authors-plus plugin
# Allows us to credit contributors as either writers or image makers.
# Relies on a custom-field in the post. Add the contributors to the post,
# writers first. Then, set the custom_field "number_of_authors" to the
# number of writers. If number_of_authors is not set (or not set to
# a valid number), then we assume all contributors are writers.
# Must be in the loop.
# Author: M.Morse 10/23/2010
function risd_coauthors_posts_links($writer_string,$image_folks_string) {
   global $post;
   $num_authors = get_post_meta($post->ID,'number_of_authors',true);
   $co_auth_obj = new CoAuthorsIterator();
   $num_contributors = $co_auth_obj->count();
   # Check that the number_of_authors custom field is valid
   # If not, make everybody a writer
   if (! is_numeric($num_authors) || $num_authors < 1 || 
      $num_authors > $num_contributors) {
         $num_authors = $num_contributors;
   }
   echo($writer_string); 
   $count = 0;
   while($co_auth_obj->iterate()){
     the_author_posts_link();
     $count++;   # number of contributors we've displayed
     risd_add_delimiter($image_folks_string,$count,$num_authors,
                            $num_contributors);
   }
}

function risd_add_delimiter($image_folks_string,$count,$num_authors,
                            $num_contributors) {
   # Picks the right delimiter and prints it
   # Do easy cases first...
   # We're at the end of the list
   if ($count == $num_contributors) {
      echo(""); return;
   }
   # We're between the writers and image folks
   if ($count == $num_authors) {
      echo($image_folks_string); return;
   }
   # OK, at this point, we're either in the midst of multiple
   # authors, or in midst of 1 or more image folks
   # Look at writers first...
   if ($count < $num_authors) {
      # We're in the midst of multiple authors
      if ($count == $num_authors - 1) {
         echo (" and "); return;
      }
      else {
         echo(", "); return;
      }
   }
   else {
      # We're in the image folks
      if ($count == $num_contributors - 1) {
         echo (" and "); return;
      }
      else {
         echo(", "); return;
      }
   }
}

?>
