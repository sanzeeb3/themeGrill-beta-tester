<?php
class BetaTesterSettingsPage
{
    public function __construct() {
            add_action( 'admin_menu', array($this, 'beta_tester_plugin_menu' ));
          
    }
    public function beta_tester_plugin_menu() {
         add_submenu_page( 'index.php','Beta Tester Settings', 'Beta Tester Settings', 'manage_options', 'beta-tester-settings-page', array($this, 'betatester_callback' ) );
    }
    public function betatester_callback() {
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }

        if(isset($_POST['submit']))
        {
            $plugin=isset($_POST['plugin'])?$_POST['plugin']:null;
            update_option('tgbt_plugin_field',$plugin);
            echo "Settings Updated!!";
        }
           
            ?>
                <form method="post" action=" <?php echo  $_SERVER['REQUEST_URI'] ;?>">

                    <label>Github Repository Owner:</label>
                    <br/>

                    <label>Plugin For Beta Test</label>
                    <select name="plugin">
                        <option <?php if ( get_option( 'tgbt_plugin_field' ) == "user-registration") echo "selected='selected'";?> >user-registration</option>
                        <option <?php if ( get_option( 'tgbt_plugin_field' ) == "restaurantpress") echo "selected='selected'";?> >restaurantpress</option>
                        <option <?php if ( get_option( 'tgbt_plugin_field' ) == "online-restaurant-reservation") echo "selected='selected'";?> >online-restaurant-reservation</option>
                        <option <?php if ( get_option( 'tgbt_plugin_field' ) == "everest-forms") echo "selected='selected'";?> >everest-forms</option>
                    </select><br>

                    <input type="submit" name="submit">
                </form>         
            <?php
            echo '</div>';
    }
}
$settings = new BetaTesterSettingsPage();
?>