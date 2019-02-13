<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">

<?php
    
    $select_theme  = "SELECT * FROM {$theme_table} WHERE id = '1'";
    $theme_selected = $db->select( $select_theme );
    if( $theme_selected ) {
        while( $result = $theme_selected->fetch_assoc() ) {
            if( $result['theme'] == 'default' ) {
?>
        <link rel="stylesheet" href="theme/default.css">
<?php } elseif( $result['theme'] == 'green' ) { ?>
        <link rel="stylesheet" href="theme/green.css">
<?php } elseif( $result['theme'] == 'red' ) { ?> 
        <link rel="stylesheet" href="theme/red.css">       
<?php } } } ?>