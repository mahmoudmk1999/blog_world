<?php
    session_start();
    include('include/connection.php');
    include('include/header.php');


    if (isset($_POST['category'])){
        $cName = $_POST['category'] ;
    }
    if(isset($_POST['add'])){
    $cAdd = $_POST['add'];
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    
    if(!isset($_SESSION['id'])){
        echo "<div class='alert alert-warning '>" . "Please Wait To Redirect To Sign in Page" . "</div>";
        header('REFRESH:2; URL=login.php');
    }
    else{
    
    
?>

    <!-- Start Content -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2" id="side-area">
                    <h4>Control Panel</h4>
                    <ul>
                        <li>
                            <a href="">
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
                    <div class="add-category">
                        <?php 
                        if(isset($cAdd)){
                            if(empty($cName)){
                                echo "<div class='alert alert-danger'>" . "Category field is empty" . "</div>";
                            }
                            elseif(strlen($cName) > 100){
                                echo "<div class='alert alert-danger'>" ."The name of the category is too big" . "</div>";
                            }
                            else{
                                $query = "INSERT INTO categories(categoryName) VALUES ('$cName')";
                                mysqli_query($conn,$query);
                                echo "<div class='alert alert-success'>" ."New Category is added" . "</div>";
                            }}
                        ?>  
                        <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                            <div class="mb-3">
                                <label for="category">New Category</label>
                                <input type="text" name="category" class="form-control" >
                            </div>
                            <button class="btn-custom" name ="add">Add</button>
                        </form>
                    </div>

                    <!-- Display Categories -->
                    <div class="display-cat mt-5">
                        <?php 
                            if(isset($id)){
                                $query = "DELETE FROM categories WHERE id = '$id'";
                                $delete = mysqli_query($conn,$query);
                        
                                if(isset($delete)){
                                    echo "<div class='alert alert-success'>" . "Category Has been Reomoved" . "</div>";
                                }
                                else{
                                    echo "<div class='alert alert-danger'>" . "Something went wrong" . "</div>";
                                }
                            }
                        ?>
                        <table class="table table-hover table-dark">
                            <tr>
                                <th>Category No</th>
                                <th>Category Name</th>
                                <th>Added Date</th>
                                <th>Delete Category</th>
                            </tr>
                            <?php
                                $query = "SELECT * FROM categories ORDER BY id desc";
                                $res = mysqli_query($conn,$query);
                                $no = 0;
                                while($row = mysqli_fetch_assoc($res)){
                                    $no++;
                                    ?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $row['categoryName'];?></td>
                                            <td><?php echo $row['categoryDate'];?></td>
                                            <td><a href="categories.php?id=<?php echo $row['id'];?>"> 
                                                <button class="btn-custom">Delete</button></a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End Content -->
<?php
    }
?>
<?php
    include('include/footer.php')
?>