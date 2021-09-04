<?php require_once 'header.php'; 
    if (isset($_POST['issue-book'])) {
       $student_id = $_POST['student_id'];
       $book_id = $_POST['book_id'];
       $book_issue_date = $_POST['book_issue_date'];

       $result = mysqli_query($con,"INSERT INTO `issue_book`(`student_id`,`book_id`,`book_issue_date`) VALUES ('$student_id','$book_id','$book_issue_date')");

       if ($result) {
          mysqli_query($con,"UPDATE `books` SET `available_qty`= `available_qty`-1 WHERE `id`='$book_id'");
       ?>
       <script type="text/javascript">
           alert('Book Issued Successfully!');
       </script>
      <?php
       }else{
        ?>
       <script type="text/javascript">
           alert('Book Not Issued!');
       </script>
        <?php
       }
    }
?>
                <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                            <li></i><a href="javascript:avoid(0)">Issue Book</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                    <div class="col-sm-6 col-sm-offset-3">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-inline" method="post" action="">
                                        <div class="form-group">
                                            <select class="form-control" name="student_id">
                                                <option value="">Select</option>
                                                <?php
                                             $result = mysqli_query($con,"SELECT * FROM Students WHERE status = '1'");
                                                  while ($row = mysqli_fetch_assoc($result)) { ?>
                                                  <option value="<?= $row['id'] ?>"><?= ucwords($row['firstname'].' '. $row['lastname']).' ->('.$row['roll'].')' ?></option>
                                                  <?php
                                                 }
                                                 ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="search" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php
                            if(isset($_POST['search'])){
                                $id =$_POST['student_id'];
                             $result = mysqli_query($con,"SELECT * FROM `students` WHERE `id` = '$id' AND `status` = '1'");
                              $row = mysqli_fetch_assoc($result);
                              ?>
                              <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post" action="">
                                        <div class="form-group">
                                            <label for="name">Student Name</label>
                                            <input type="text" class="form-control" id="name" value="<?=ucwords($row['firstname'].' '. $row['lastname'])?>" readonly>
                                            <input type="hidden" name="student_id" value="<?= $row['id'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Book Name</label>
                                              <select class="form-control" name="book_id">
                                                <option value="">Select</option>
                                                <?php
                                                $result = mysqli_query($con,"SELECT * FROM `books` WHERE `available_qty`> 0");
                                                  while ($row = mysqli_fetch_assoc($result)) { ?>
                                                  <option value="<?= $row['id'] ?>"><?= $row['book_name'] ?></option>
                                                  <?php
                                                 }
                                                 ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Book Issue Date</label>
                                            <input class="form-control" name="book_issue_date" type="text" value="<?= date('d-m-Y')?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="issue-book" class="btn btn-primary">Save Issue Book</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                      </div>
                              <?php
                            }
                            ?>
                        </div>
                    </div>   
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<?php require_once 'footer.php'; ?>