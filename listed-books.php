<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 



    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Book Collection</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Book Collection</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="books-collection-card">
                    <div class="collection-header">
                        <div class="header-content">
                            <h5 class="card-title">
                                <i class="fa fa-book"></i>
                                Available Books
                            </h5>
                            <div class="header-actions">
                                <div class="search-box">
                                    <input type="text" id="bookSearch" placeholder="Search by title or category..." class="form-control">
                                    <i class="fa fa-search search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="books-grid">
                        <?php 
                        $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblauthors.AuthorName,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid,tblbooks.bookImage,tblbooks.isIssued,tblbooks.bookQty,  
                                       COUNT(tblissuedbookdetails.id) AS issuedBooks,
                                       COUNT(tblissuedbookdetails.RetrunStatus) AS returnedbook
                                FROM tblbooks
                                LEFT JOIN tblissuedbookdetails ON tblissuedbookdetails.BookId = tblbooks.id
                                LEFT JOIN tblauthors ON tblauthors.id = tblbooks.AuthorId
                                Left join tblcategory on tblcategory.id=tblbooks.CatId
                                GROUP BY tblbooks.id";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0) {
                            foreach($results as $result) {
                                $availableQty = ($result->issuedBooks == 0) ? $result->bookQty : ($result->bookQty - ($result->issuedBooks - $result->returnedbook));
                        ?>  
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="book-card">
                                <div class="book-image">
                                    <img src="admin/bookimg/<?php echo htmlentities($result->bookImage);?>" alt="<?php echo htmlentities($result->BookName);?>">
                                    <div class="availability-badge <?php echo ($availableQty > 0) ? 'available' : 'unavailable'; ?>">
                                        <?php echo ($availableQty > 0) ? 'Available' : 'Out of Stock'; ?>
                                    </div>
                                </div>
                                
                                <div class="book-content">
                                    <h5 class="book-title"><?php echo htmlentities($result->BookName);?></h5>
                                    <p class="book-author">
                                        <i class="fa fa-user"></i>
                                        <?php echo htmlentities($result->AuthorName);?>
                                    </p>
                                    <p class="book-category">
                                        <i class="fa fa-tag"></i>
                                        <?php echo htmlentities($result->CategoryName);?>
                                    </p>
                                    
                                    <div class="book-details">
                                        <div class="detail-row">
                                            <span class="detail-label">ISBN:</span>
                                            <code class="isbn-code"><?php echo htmlentities($result->ISBNNumber);?></code>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Total Copies:</span>
                                            <span class="detail-value"><?php echo htmlentities($result->bookQty);?></span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Available:</span>
                                            <span class="detail-value available-count"><?php echo $availableQty; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $cnt=$cnt+1;}} ?>  
                    </div>
                </div>
            </div>
        </div>


            
    </div>
    </div>
    </div>

     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    <script>
    $(document).ready(function(){
        $('#bookSearch').on('keyup', function(){
            var searchText = $(this).val().toLowerCase();
            $('.book-card').parent().each(function(){
                var bookTitle = $(this).find('.book-title').text().toLowerCase();
                var bookCategory = $(this).find('.book-category').text().toLowerCase();
                var bookAuthor = $(this).find('.book-author').text().toLowerCase();
                
                if(bookTitle.indexOf(searchText) > -1 || bookCategory.indexOf(searchText) > -1 || bookAuthor.indexOf(searchText) > -1){
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
    </script>

</body>
</html>
<?php } ?>
