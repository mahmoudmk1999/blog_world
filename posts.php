<?php
    include('include/connection.php');
    include('include/header.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
?>



    <!-- Start Content -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2" id="side-area">
                    <h4>Control </h4>
                    <ul>
                        <li>
                            <a href="categories.php">
                                <span><i class="fa-solid fa-tags"></i></span>
                                <span>Categories</span>
                            </a>
                        </li>
                        <!-- Articles -->
                        <li data-bs-toggle="collapse" data-bs-target="#menu">
                            <a href="#">
                                <span><i class="fa-regular fa-newspaper"></i></span>
                                <span>Posts</span>
                            </a>
                        </li>
                        <ul class="collapse" id="menu">
                            <li>
                                <a href="new-post.php">
                                    <span><i class="fa-regular fa-pen-to-square"></i></span>
                                    <span>New Post</span>
                                </a>
                            </li>
                            <li>
                                <a href="posts.php">
                                    <span><i class="fa-solid fa-table-cells-large"></i></span>
                                    <span>All Posts</span>
                                </a>
                            </li>
                        </ul>
                        <li>
                            <a href="index.php" target="_blank">
                                <span><i class="fa-solid fa-window-restore"></i></span>
                                <span>Web Site</span>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <span><i class="fa-solid fa-right-from-bracket"></i></span>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-10" id="main-area"> 

                    <!-- Display all posts -->
                <div class="display-posts mt-4">
                <?php 
                            if(isset($id)){
                                $query = "DELETE FROM posts WHERE id = '$id'";
                                $delete = mysqli_query($conn,$query);
                        
                                if(isset($delete)){
                                    echo "<div class='alert alert-success'>" . "Post deleted successfully" . "</div>";
                                }
                                else{
                                    echo "<div class='alert alert-danger'>" . "Something went wrong" . "</div>";
                                }
                            }
                ?>
                <table class="table table-hover table-dark">
                    <tr style="background: var(--first-color) !important; color: #FFF;">
                        <th>Post No</th>
                        <th>Post Title</th>
                        <th>Post Author</th>
                        <th>Post Image</th>
                        <th>Post Date</th>
                        <th>Post Delete</th>
                    </tr>
                    <?php
                        $query = "SELECT * FROM posts ORDER BY id desc";
                        $res = mysqli_query($conn,$query);
                        $no = 0;

                        while($row= mysqli_fetch_assoc($res)){
                        $no++;   
                        ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $row['postTitle'];?></td>
                            <td><?php echo $row['postAuthor'];?></td>
                            <td><img src="uploads/<?php echo $row['postImage'];?>" width="90px" height="60px"></td>
                            <td><?php echo $row['postDate'];?></td>
                            <td><a href="posts.php?id=<?php echo $row['id'];?>"> 
                                <button class="btn-custom" >Delete</button></a>
                            </td>
                        </tr>
                        <?php 
                        }
                    ?>
                </table>
                </div>
                <div>
            </div>
        </div>
    </div>


    <!-- End Content -->





<?php
    include('include/footer.php');
?>