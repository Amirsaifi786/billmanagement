<?php
require 'header.php'; 

if (isset($_GET['ided'])) {
    $id = base64_decode($_GET['ided']);
    $cms = mysqli_query($conn, "SELECT * FROM cmspages WHERE id = '$id' ");
    $cmspage = mysqli_fetch_array($cms);
}

if (isset($_POST['submit'])) {
    $title           = mysqli_real_escape_string($conn, $_POST['title']);
    $description     = mysqli_real_escape_string($conn, $_POST['description']);    
    $subdescription  = mysqli_real_escape_string($conn, $_POST['subdescription']);    

    $update = mysqli_query($conn, "UPDATE `cmspages` 
        SET 
            `title`          = '$title', 
            `description`    = '$description',            
            `subdescription` = '$subdescription'
        WHERE id = '$id'
    ");

    if ($update) {
        $msg = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    cmspages updated successfully...
                </div>';
        echo "<script>setTimeout(function(){ window.location = 'cms.php'; },1000);</script>";
    } else {
        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error!! Please try again...
                </div>';
        echo "<script>setTimeout(function(){ window.location = 'cms.php'; },2000);</script>";
    }
}
?>

<style>

.cke_notifications_area{
display:none;
}
</style>
 <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Edit cmspages</h2>
              <div class="row">
        
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Edit cmspages</strong>
                        <a href="cms.php" class="btn btn-primary float-right ml-3" type="button"><i class="fe fe-arrow-left "></i>Cmspages List</a>

                    </div>
                    <div class="card-body">
                      <form class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        <?php if(isset($msg)){ echo $msg; } ?>                    
                                           
                             <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="example-textarea">Title </label>
                                    <input type="text" class="form-control" name="title" value="<?php echo $cmspage['title']; ?>">
                                </div>
                            </div>                       
                           
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="example-textarea">Description</label>
                                    <textarea class="form-control" name="description" id="specification" rows="4"><?php echo $cmspage['description']; ?></textarea>
                                </div>
                            </div>                            

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="example-textarea">Sub Description</label>
                                    <textarea class="form-control" name="subdescription" id="description" rows="4"><?php echo $cmspage['subdescription']; ?></textarea>
                                </div>
                            </div>
                           
                        <button class="btn btn-primary" name="submit" type="submit">Submit form</button>
                      </form>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /.col -->
              </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
 
      </main>
         <!-------------------------------------------------CK EDITOR-------------------------------------------------->
      <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
        
                    <script>
                            CKEDITOR.replace( 'editor2' );
                    </script>
                        <script>
                            CKEDITOR.replace( 'editor1' );
                    </script>
                    <script>
                            CKEDITOR.replace( 'description' );
                    </script>
                    <script>
                            CKEDITOR.replace( 'specification' );
                    </script>
                      <script>
                            var notify=document.querySelector('.cke_notification cke_notification_warning').style.display="none";
                    </script>
                    
        
    <!---------------------------------------------------CK EDITOR--------------------------------------------------->

      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script> 
      <?php require'footer.php';  ?>