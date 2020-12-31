<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *   Sub 1 
 */

 //get the current page
 $thecurpage = $_GET['page'];

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="container" style="width:100%;text-align:center;">
  <div class="row alert alert-primary">
    <div class="col-sm">
      <h4>Click this button to import all YouTube videos from channel</h4>
      <form method="get" action="">
      <input type="hidden" value="<?php echo($thecurpage); ?>" name="page" />
      <input type="hidden" value="import" name="action" />
      <button type="submit" class="btn btn-success btn-lg">Import</button>
      </form>
    </div>
    <div class="col-sm">
      <h4>Renew / Update YouTube Videos</h4>
      <form method="get" action="">
      <input type="hidden" value="<?php echo($thecurpage); ?>" name="page" />
      <input type="hidden" value="renew" name="action" />
      <button type="submit" class="btn btn-warning btn-lg">Renew</button>
      </form>
    </div>
    <div class="col-sm">
      <h4>Delete ALL YouTube Videos</h4><br>
      <form method="get" action="">
      <input type="hidden" value="<?php echo($thecurpage); ?>" name="page" />
      <input type="hidden" value="delete" name="action" />
      <button type="submit" class="btn btn-danger btn-lg">Delete All</button>
      </form>
    </div>
  </div>
</div>

<?php

//get the action
$theaction = ''; //initialize variable
$blnImport = false; //determine if the user imported
$blnDelete = false; //determine if the user deleted

if (isset($_GET['action'])){
  //set the action
  $theaction = $_GET['action'];
}

//==========================================
//==========================================
//this code runs on IMPORT ACTION
if ($theaction == 'import'){
    $theyoutubekey = get_option( 'youtubeAPIKey' );
    $thechannelid = get_option( 'youtubeChannelID' );

    $videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$thechannelid.'&maxResults='.'50'.'&key='.$theyoutubekey.''));

    //sort through the items and output
    foreach($videoList->items as $item){
      //loop through the videos and add them as custom post types
      
      //INSERT A NEW POST VIDEO
      $data = array(
        'post_title' => $item->snippet->title,
        'post_content' => $item->snippet->description,
        'post_category' => array($_POST['uncategorized']),
        'tags_input' => array($tags),
        'post_status' => 'publish',
        'post_type' => 'wp10yvids'
      );

      //insert this post into the DB and RETRIEVE the ID
      $result = wp_insert_post( $data );
      //echo ($results);

      //capture the ID of the post
      if ( $result && ! is_wp_error( $result ) ) {
        $thenewpostID = $result;
        //add the youtube meta data
        add_post_meta( $thenewpostID, 'videoID', $item->id);
        add_post_meta( $thenewpostID, 'publishedAt', $item->snippet->publishedAt);
        add_post_meta( $thenewpostID, 'channelId', $item->snippet->channelId);
        add_post_meta( $thenewpostID, 'ytitle', $item->snippet->title);
        add_post_meta( $thenewpostID, 'ydescription', $item->snippet->description);
        add_post_meta( $thenewpostID, 'imageresmed', $item->snippet->thumbnails->medium->url);
        add_post_meta( $thenewpostID, 'imagereshigh', $item->snippet->thumbnails->high->url);

        //set the import to true
        $blnImport = true;

        //output the med res image
        //echo ('<img src="' . get_post_meta( $thenewpostID, 'imageresmed', true) . '" />');

      }

    }
}
//END IMPORT ACTION BLOCK
//==========================================
//==========================================


//==========================================
//==========================================
//this code runs on RENEW ACTION

if ($theaction == 'renew'){
  
  //first get all the posts
  $allWPVidPosts = get_posts( array('post_type' => 'wp10yvids', 'numberposts' => 2500, 'order' => 'ASC') );
  $compvids = '';

  //first check if there are any videos to update
  if (count($allWPVidPosts) == 0){
    echo('<h2>There are no videos so click IMPORT first.</h2>');
  } else{

    //we know we have videos so CYCLE THEM
    foreach ($allWPVidPosts as $eachpost){
      if($eachpost->videoID->videoId == ''){
        //do nothing
      } else {

        //this is a video
        $compvids = ',' . $compvids . $eachpost->videoID->videoId . ',';
        
      }
    }

    //echo ($compvids . '<br><br>');

    //NOW call in the new videos and compare
    $theyoutubekey = get_option( 'youtubeAPIKey' );
    $thechannelid = get_option( 'youtubeChannelID' );

    $videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$thechannelid.'&maxResults='.'6'.'&key='.$theyoutubekey.''));
    
    
    //sort through the items and add anything thats new
    foreach($videoList->items as $item){
      //determine if we already have this video
      $videxists = strpos($compvids , $item->id->videoId);

      //check to see if this video exists
      if ($videxists > 0) {

        //echo ('found' . $videxists . '<br>');

      } else {

        //add the video because IT WAS NOT FOUND IN OUR DATABASE STRING
              //INSERT A NEW POST VIDEO
      $data = array(
        'post_title' => $item->snippet->title,
        'post_content' => $item->snippet->description,
        'post_category' => array($_POST['uncategorized']),
        'tags_input' => array($tags),
        'post_status' => 'publish',
        'post_type' => 'wp10yvids'
      );

      //insert this post into the DB and RETRIEVE the ID
      $result = wp_insert_post( $data );
      //echo ($results);

      //capture the ID of the post
      if ( $result && ! is_wp_error( $result ) ) {
        $thenewpostID = $result;
        //add the youtube meta data
        add_post_meta( $thenewpostID, 'videoID', $item->id);
        add_post_meta( $thenewpostID, 'publishedAt', $item->snippet->publishedAt);
        add_post_meta( $thenewpostID, 'channelId', $item->snippet->channelId);
        add_post_meta( $thenewpostID, 'ytitle', $item->snippet->title);
        add_post_meta( $thenewpostID, 'ydescription', $item->snippet->description);
        add_post_meta( $thenewpostID, 'imageresmed', $item->snippet->thumbnails->medium->url);
        add_post_meta( $thenewpostID, 'imagereshigh', $item->snippet->thumbnails->high->url);

        //set the import to true
        $blnRenew = true;

        //output the med res image
        //echo ('<img src="' . get_post_meta( $thenewpostID, 'imageresmed', true) . '" />');

      }

      }
    }


  }


}

//END RENEW ACTION BLOCK
//==========================================
//==========================================


//==========================================
//==========================================
//this code runs on DELETE ACTION

if ($theaction == 'delete'){
  //delete all videos with our custom post type
  $allWPVidPosts = get_posts( array('post_type' => 'wp10yvids', 'numberposts' => 100) );
  //loop through and delete all the posts
  foreach ($allWPVidPosts as $eachpost){
    wp_delete_post($eachpost->ID, true);
    $blnDelete = true;
  }
}

//END IMPORT ACTION BLOCK
//==========================================
//==========================================



//output user action complete
if ($blnImport == true){
  ?>
    <br><br>
    <div class="alert alert-success">
      <h2>You have successfully imported videos from YouTube!</h2>
    </div>
  <?php
} elseif ($blnDelete == true){
  ?>
    <br><br>
    <div class="alert alert-danger">
      <h2>You have successfully deleted videos from the database!</h2>
    </div>
  <?php
} elseif ($blnRenew == true){
  ?>
    <br><br>
    <div class="alert alert-danger">
      <h2>You have RENEWED videos from YouTube!</h2>
    </div>
  <?php
}



?>


<?php
/*
$allWPVidPosts = get_posts( array('post_type' => 'wp10yvids', 'numberposts' => 100) );
$vidsOrdered = array(); //holds all our timestamps and video IDs
$i = 0; //keeps count of the item we are adding information to

//loop through and delete all the posts
foreach ($allWPVidPosts as $eachpost){
  $vidsOrdered[$i] = array();

  //capture the ID of the post and its published at date
  $sortDate = $eachpost->publishedAt;
  $strToTimeFormat = strtotime($sortDate);
  $dateTimeFormat = date('Y-m-d H:i:s', $strToTimeFormat);

  //add this item to our array
  $vidsOrdered[$i]['datetime'] = $dateTimeFormat;
  $vidsOrdered[$i]['theID'] = $eachpost->ID;

  //up the count
  $i++;

}

print_r($vidsOrdered);
echo('<br><br><br><br><br>');

//sort array by TIMESTAMP
function date_compare($a, $b){
  $t1 = strtotime($a['datetime']);
  $t2 = strtotime($b['datetime']);
  return $t1 - $t2;
}
usort($vidsOrdered, 'date_compare');

//after the sort
print_r($vidsOrdered);
*/
?>