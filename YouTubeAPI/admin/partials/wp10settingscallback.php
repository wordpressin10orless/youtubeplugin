<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    partials/wp10settingscallback
 */
?>

<h1>General Settings for WP10YouTube Test</h1><br><hr>
<div class="container" style="max-width:100%;">
  <div class="row">
    <div class="col">
      <div class="alert alert-warning">
        <h1 class="display-4">YouTube API Importer</h1>
        <p class="lead">Use this section to save your API key and channel ID for video imports.</p>
        <hr class="my-4">
        <p>Need a YouTube Key generated? They're free! Get one here.</p>
        <form method="post" action="options.php">
        <?php
        settings_fields( 'wp10customsettings' );
        do_settings_sections( 'wp10customsettings' )
        ?>
        <div class="form-group">
          <label for="youtubeAPIKey">YouTube API Key</label>
          <input name="youtubeAPIKey" value="<?php echo get_option( 'youtubeAPIKey' ); ?>" type="text" class="form-control" id="youtubeapikey" placeholder="Your YouTube API Key">
        </div>
        <div class="form-group">
          <label for="youtubeChannelID">Your YouTube Channel ID:</label>
          <input type="text" name="youtubeChannelID" value="<?php echo get_option( 'youtubeChannelID' ); ?>" class="form-control" id="youtubeChannelID" placeholder="YouTube Channel ID">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>


      <br>
      <br>

      <div class="alert alert-primary">
        <h1 class="display-4">Advertiser Settings</h1>
        <h3>Setup your advertiser settings below.</h3>
        <hr>
        <form method="post" action="options.php">
          <?php
            settings_fields( 'wp10adsettings' );
            do_settings_sections( 'wp10adsettings' )
          ?>
          <div class="form-group">
            <label for="adskipseconds">Skip AD After How Many Seconds</label>
            <input class="form-control" type="number" value="<?php echo get_option( 'adskipseconds' ); ?>" id="adskipseconds" name="adskipseconds">
          </div>
          <div class="form-group">
          <label for="advideo">Advertiser YouTube Video ID:</label>
          <input type="text" name="advideo" value="<?php echo get_option( 'advideo' ); ?>" class="form-control" id="advideo" placeholder="example: yKeolQxpcgQ">
          </div>
          <div class="form-group">
          <label for="adtitle">AD Title:</label>
          <input type="text" name="adtitle" value="<?php echo get_option( 'adtitle' ); ?>" class="form-control" id="adtitle" placeholder="">
          </div>
          <div class="form-group">
          <label for="adbodycopy">AD Body Copy:</label>
          <input type="text" name="adbodycopy" value="<?php echo get_option( 'adbodycopy' ); ?>" class="form-control" id="adbodycopy" placeholder="">
          </div>
          <div class="form-group">
          <label for="adbuttoncopy">AD Button Copy:</label>
          <input type="text" name="adbuttoncopy" value="<?php echo get_option( 'adbuttoncopy' ); ?>" class="form-control" id="adbuttoncopy" placeholder="">
          </div>
          <button type="submit" class="btn btn-primary btn-lg">Save Advertiser Changes</button>
        </form>
      </div>



    </div>
    <div class="col">
      <div class="alert alert-success">
        <h1 class="display-4">ShortCode Information</h1>
        <h3>To output videos simply use this shortcode: " [wp10yvidsout] "</h3>
        <hr>
        <form method="post" action="options.php">
          <?php
            settings_fields( 'wp10shortcodesettings' );
            do_settings_sections( 'wp10shortcodesettings' )
          ?>
          <div class="form-group">
            <label for="ypostcount">Number of Videos to Show</label>
            <input class="form-control" type="number" value="<?php echo get_option( 'ypostcount' ); ?>" id="ypostcount" name="ypostcount">
          </div>
          <div class="form-group">
            <label for="yvidstyletype">Display Type</label>
            <select class="form-control" id="yvidstyletype" name="yvidstyletype">
              <option <?php if(get_option('yvidstyletype') == 'Image Left'){ echo(' selected');} ?>>Image Left</option>
              <option <?php if(get_option('yvidstyletype') == 'Image Center'){ echo(' selected');} ?>>Image Center</option>
              <option <?php if(get_option('yvidstyletype') == 'Image Right'){ echo(' selected');} ?>>Image Right</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary btn-lg">Save ShortCode Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>