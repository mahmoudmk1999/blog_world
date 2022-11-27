<?php
    include('include/connection.php');
    include('include/header.php');

    if (isset($_POST['title'])){
        $pTitle = $_POST['title'];
    }
    if(isset($_POST['category'])){
        $pCat = $_POST['category'];
    }
    if(isset($_POST['content'])){
        $pContent = $_POST['content'];
    }
    if(isset($_POST['add'])){
        $pAdd = $_POST['add'];
    }
    $pAuthor = "MK";
    //image
    if(isset($_FILES['postImage']['name'])){
        $imageName = $_FILES['postImage']['name'];
    }
    if(isset($_FILES['postImage']['tmp_name'])){
        $imageTmp = $_FILES['postImage']['tmp_name'];
    }
    ///////////
?>

    <!-- Start Content -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2" id="side-area">
                    <h4>Control Panel</h4>
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
                    <div class="add-category">
                        <?php
                            if(isset($pAdd)){
                                if(empty($pTitle) || empty($pContent)){
                                    echo "<div class='alert alert-danger'>" . "Please fill in the fields below" . "</div>";
                                }
                                elseif(strlen($pContent) > 10000){
                                    echo "<div class='alert alert-danger'>" . "The content of the post is very large" . "</div>";
                                }
                                else{
                                    $postImage = rand(0,1000) . "_" . $imageName;
                                    move_uploaded_file($imageTmp, "uploads\\" . $postImage);
                                    
                                    $query = "INSERT INTO posts(postTitle,postCat,postImage,postContent,postAuthor) 
                                    VALUES ('$pTitle','$pCat','$postImage','$pContent','$pAuthor')";
                                    $res = mysqli_query($conn,$query);
                        
                                    if(isset($res)){
                                        echo  "<div class='alert alert-success'>" . "Post added successfully" . "</div>";
                                    }
                                    else{
                                        echo "<div class='alert alert-danger'>" . "Something went wrong" . "</div>";
                                    }
                                }
                            }
                        ?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title">Post Title</label>
                                <input type="text" name="title" class="form-control" >
                            </div>
                            <div class="mb-3">
                                <label for="cate">Category</label>
                                <select name="category" id="cate" class="form-control">
                                    <?php
                                        $query = "SELECT * FROM categories";
                                        $res = mysqli_query($conn,$query);
                                        while($row = mysqli_fetch_assoc($res)){
                                        ?>
                                        <option >
                                            <?php echo $row['categoryName'];?>
                                        </option>
                                        <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image">Post Image</label>
                                <input type="file" id="image" class="form-control" name ="postImage">
                            </div>
                            <div class="mb-3">
                            <label for="content">Post Text</label>
                                <textarea id="" cols="30" rows="10" class="form-control" name="content"></textarea>
                            </div>
                            <button class="btn-custom" name="add">Submit</button>
                        </form>
                    </div>
                </div>
<?php
    include('include/footer.php');
?>