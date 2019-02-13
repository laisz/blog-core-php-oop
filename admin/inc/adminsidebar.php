<div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                       <li><a class="menuitem">Site Option</a>
                            <ul class="submenu">
                                <li><a href="titleslogan.php">Title & Slogan</a></li>
                                <li><a href="social.php">Social Media</a></li>
                                <li><a href="copyright.php">Copyright</a></li>
                                
                            </ul> <!-- /.submenu -->
                        </li>
						
                         <li><a class="menuitem">Pages</a>
                            <ul class="submenu">
                                
                                <li><a href="addpage.php">Add New Page</a></li>
                                
                        <?php
                            
                            $select_page = "SELECT * FROM {$page_table}";
                            $get_page = $db->select( $select_page );
                            if( $get_page ) {
                                while( $result = $get_page->fetch_assoc() ) {

                        ?>
                                        
                                <li><a href="page.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
                                
                        <?php } } ?>

                            </ul> <!-- /.submenu -->
                        </li>
                        <li><a class="menuitem">Category Option</a>
                            <ul class="submenu">
                                <li><a href="addcat.php">Add Category</a></li>
                                <li><a href="catlist.php">Category List</a> </li>
                            </ul> <!-- /.submenu -->
                        </li>
                        <li><a class="menuitem">Slider Option</a>
                            <ul class="submenu">
                                <li><a href="addslider.php">Add Slider</a></li>
                                <li><a href="sliderlist.php">Slider List</a></li>
                            </ul> <!-- /.submenu -->
                        </li>
                        <li><a class="menuitem">Post Option</a>
                            <ul class="submenu">
                                <li><a href="addpost.php">Add Post</a> </li>
                                <li><a href="postlist.php">Post List</a> </li>
                            </ul> <!-- /.submenu -->
                        </li>
                    </ul> <!-- /.section .menu -->
                </div> <!-- /.block #section-menu --> 
            </div> <!-- /.box .sidemenu -->
        </div> <!-- /.grid_2 -->