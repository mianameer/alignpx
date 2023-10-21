<?php
include "../../includes/config.php";
include "../../includes/functions.php";
$title = $description = $user_id="";
$blogArray = array();
if(isset($_SESSION['userId'])){
    $user_id = $_SESSION['userId'];
}

$getUserBlogs = "SELECT * FROM `blog` WHERE `user_id`='$user_id'";
$getUserBlogsRequest = mysqli_query($connection_string, $getUserBlogs);
if (mysqli_num_rows($getUserBlogsRequest) > 0) {
    $blogArray = mysqli_fetch_all($getUserBlogsRequest, MYSQLI_ASSOC);
}
?>

<?php
include "../../includes/header.php";
include "../../includes/sidebar.php";

?>
<div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>
    <div class="row">
        <div class="text-center" style="    z-index: 999999; top: 116px; position: absolute; right: 33px ;">
            <button type="button" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#exampleModal">
                Create Blog
            </button>
        </div>
    </div>
    <div id="content" class="main-content">
        <div class="row" style="margin-left: 14px;  margin-top: 57px;">

            <?php if (count($blogArray) >= 0) {
                $count = 1;
                foreach ($blogArray as $blog) {
            ?>
                    <div id="<?= $blog['id'] ?>" style="margin: 10px;" class="">
                        <div class="card component-card_9">
                            <div class="card-body">
                                <p class="meta-date">25 Sep 2019</p>

                                <h5 id="title<?= $blog['id'] ?>" class="card-title"><?= $blog['title'] ?></h5>
                                <p id="description<?= $blog['id'] ?>" class="card-text"><?= $blog['description'] ?></p>

                                <div class="meta-info">
                                    <div class="meta-user">
                                        <div class="avatar avatar-sm">
                                            <span class="avatar-title rounded-circle">AG</span>
                                        </div>
                                        <div class="user-name">Luke Ivory</div>
                                    </div>

                                    <div class="meta-action">
                                        <div class="meta-likes">
                                            <div class="edit-item-wrapper" id="<?= $blog['id'] ?>">
                                                <input type="button" class="editItem  btn btn-primary mb-2 mr-2" id="<?= $blog['id'] ?>" value="Edit" />
                                            </div>
                                        </div>

                                        <div class="meta-view">
                                            <div class="item-wrapper" id="<?= $blog['id'] ?>">
                                                <input type="button" class="deleteItem  btn btn-danger mb-2 mr-2" id="<?= $blog['id'] ?>" value="Delete" />
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

            <?php
                    $count++;
                }
            } ?>
            <div id="blog" style="display: contents;"></div>

        </div>
        <!-- <div class="row" style="  margin-left: 14px; ">
            <div id="blog" style="display: contents;"></div>
        </div> -->
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Blog</h5>
                </div>
                <div id="error" style="color: red; display: none; text-align: center;"></div>
                <div class="modal-body">
                    <form action="#" method="post">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Holiday Title">Title *</label>
                                    <input type="text" class="form-control mb-4" id="title" placeholder="Title" name="title" value="<?php echo $title; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description
                                    </label>
                                    <textarea type="text" class="form-control mb-4" id="description" placeholder="Description" value="" name="description"><?php echo $description; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="button" id="create_blog" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Blog</h5>
                </div>
                <div id="error" style="color: red; display: none; text-align: center;"></div>
                <div class="modal-body">
                    <form action="#" method="post">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Holiday Title">Title *</label>
                                    <input type="text" class="form-control mb-4" id="etitle" placeholder="Title" name="title" value="" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description
                                    </label>
                                    <textarea type="text" class="form-control mb-4" id="edescription" placeholder="Description" value="" name="description"></textarea>
                                </div>
                            </div>
                            <input type="hidden" class="" id="blogid" placeholder="" name="blogid" value="" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="button" id="edit_blog" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </div>
    </div>
    <?php include "../../includes/footer.php"; ?>
    <script>
        $(document).ready(function() {
            $("#create_blog").click(function() {
                var titleValue = $("#title").val();
                var descriptionValue = $("#description").val();

                if (titleValue === '') {
                    $("#error").show();
                    $("#error").text("Title Required");
                } else if (descriptionValue === '') {
                    $("#error").show();
                    $("#error").text("Description Required");
                } else {
                    $("#error").hide();
                    $.ajax({
                        type: "POST",
                        url: "createBlog.php",
                        data: {
                            title: titleValue,
                            description: descriptionValue
                        },
                        success: function(response) {
                            responseData = JSON.parse(response);
                            if (responseData.status == 200) {
                                var htmlContent = `
                        
            <div id=` + responseData.blogId + ` style="margin: 10px;" class="">
                            <div class="card component-card_9">
                    <div class="card-body">
                        <p class="meta-date">25 Sep 2019</p>

                        <h5 id="title` + responseData.blogId + `" class="card-title">` + titleValue + `</h5>
                        <p id="description` + responseData.blogId + `" class="card-text">` + descriptionValue + `</p>

                        <div class="meta-info">
                            <div class="meta-user">
                                <div class="avatar avatar-sm">
                                    <span class="avatar-title rounded-circle">AG</span>
                                </div>
                                <div class="user-name">Luke Ivory</div>
                            </div>

                            <div class="meta-action">
           
                                <div class="meta-likes">
                                <div class="edit-item-wrapper" id=` + responseData.blogId + `>
                                <input type="button" class="editItem  btn btn-primary mb-2 mr-2" id="tag` + responseData.blogId + `" value="Edit" />
                                </div>
                                </div>

                                <div class="meta-view">
                                <div class="item-wrapper" id=` + responseData.blogId + `>
                                <input type="button" class="deleteItem  btn btn-danger mb-2 mr-2" id="tag` + responseData.blogId + `" value="Delete" />
                                </div>
  
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                </div>
               `
                                $("#blog").append(htmlContent);
                                // modal.hide();
                            } else {

                            }


                        }
                    });
                }
            });
            // *****************DELETE****************** 
            $(document).on("click", ".deleteItem", function() {
                var $itemWrapper = $(this).closest(".item-wrapper");
                var newId = $itemWrapper.attr("id");
                $.ajax({
                    type: "POST",
                    url: "DeleteBlog.php",
                    data: {
                        blogId: newId,
                    },
                    success: function(response) {
                        responseData = JSON.parse(response);
                        if (responseData.status == 200) {
                            $("#" + newId).hide();
                        }
                    }
                })
            });
            $("#edit_blog").click(function() {
                var titleValue = $("#etitle").val();
                var descriptionValue = $("#edescription").val();
                var blogid = $("#blogid").val();
                if (titleValue === '') {
                    $("#error").show();
                    $("#error").text("Title Required");
                } else if (descriptionValue === '') {
                    $("#error").show();
                    $("#error").text("Description Required");
                } else {
                    $("#error").hide();
                    $.ajax({
                        type: "POST",
                        url: "editBlog.php",
                        data: {
                            title: titleValue,
                            description: descriptionValue,
                            blogid: blogid,
                        },
                        success: function(response) {
                            responseData = JSON.parse(response);
                            if (responseData.status == 200) {
                                $('#title'+blogid).text(titleValue);
                                $('#description'+blogid).text(descriptionValue);
                                $('#exampleModal2').modal('hide');
                            }
                        }
                    });
                }
            });
            // *****************Pass Value In Model Field****************** 
            $(document).on("click", ".editItem", function() {
                $('#exampleModal2').modal('show');
                var newEditId = $(this).closest(".edit-item-wrapper");
                var blogid = newEditId.attr("id");
                var title = $("#title" + blogid).text();
                var describtion = $("#description" + blogid).text();
                $('#etitle').val(title);
                $('#edescription').val(describtion);
                $('#blogid').val(blogid);
            });
            $(document).on("click", "#create_blog", function() {
                // $('#exampleModal')[0].reset();
                // $('#exampleModal').trigger("reset");
                $('#exampleModal').modal('hide');
            })
        });
    </script>