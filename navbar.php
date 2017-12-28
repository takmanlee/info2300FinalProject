<?php
  require_once 'config/config.php';
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if(isset($_SESSION['name'])){
    $admin = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT isAdmin FROM users WHERE username = '$_SESSION[name]'"))['isAdmin'];
  }

  if ( ($admin || isset($_SESSION['name'])) && $_SESSION['name']!='guest') {
    $navbar = array(
    'home' => array('text'=>'Home', 'url'=>'index.php'),
    'AboutUs' => array('text'=>'About Us', 'url'=>'AboutUs.php'),
    'Groups' => array('text'=>'Groups', 'url'=>'Groups.php'),
    'Events' => array('text'=>'Events', 'url'=>'Events.php'),
    'ContactUs' => array('text'=>'Contact Us', 'url'=>'ContactUs.php'),);

  function generateMenu($items, $admin) {
    $html = '<nav><ul>';
    foreach($items as $item) {
    $html .= "<li><a href='{$item['url']}'>{$item['text']}</a></li>\n";
  }
  if($admin){
    $html .= '<li ><a href="users.php">Modify Userbase</a></li>';
  }
$html .= '<li class="icon-logout"><a href="logout.php">Logout</a></li></ul><nav>';
return $html;
}
echo generateMenu($navbar, $admin);
}
else {
$navbar = array(
    'home' => array('text'=>'Home', 'url'=>'index.php'),
    'AboutUs' => array('text'=>'About Us', 'url'=>'AboutUs.php'),
    'Groups' => array('text'=>'Groups', 'url'=>'Groups.php'),
    'Events' => array('text'=>'Events', 'url'=>'Events.php'),
    'ContactUs' => array('text'=>'Contact Us', 'url'=>'ContactUs.php'));
function generateMenu($items) {
  $html = '<nav><ul>';
  foreach($items as $item) {
    $html .= "<li><a href='{$item['url']}'>{$item['text']}</a></li>\n";
  }

  $html .= '<li class="icon-login"> Login</li></ul></nav>';
  return $html;
}

echo generateMenu($navbar);

}



?>