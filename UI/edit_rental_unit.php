<?php
include_once 'connect.php';
session_start();
include_once "header.php";



$id = $_GET['id'];
$select = $pdo->prepare("SELECT * FROM rental_units WHERE id = '$id'");
$select->execute();


$row = $select->fetch(PDO::FETCH_ASSOC);

$id_db = $row['id'];

$unit_number = $row['unit_number'];
$number_of_bedrooms = $row['number_of_bedrooms'];
$number_of_bathrooms = $row['number_of_bathrooms'];
$rent_amount = $row['rent_amount'];
$occupied = 0;
$yaka = $row['yaka'];
$nwsc = $row['nwsc'];



//print_r($row);


?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Rental Unit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Rental Unit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Rental Unit Details</h3>
                        </div>
                        <form action="" method="post">
                            <div class="card-body">
                                <?php
                                    $pdo = new PDO('mysql:host=localhost;dbname=paxafricana','root','');
                                    $stmt = $pdo->query('SELECT name FROM rental_properties');
                                    $property_names = $stmt->fetchAll(PDO::FETCH_COLUMN);
                                ?>
                                <div class="form-group">
                                    <label for="property_name">Property Name</label>
                                    <select class="form-control" id="property_name" name="property_name">
                                        <?php foreach ($property_names as $name): ?>
                                            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
        <div class="form-group">
            <label for="unit_number">Unit Name</label>
            <input type="text" class="form-control" id="unit_number" name="unit_number" placeholder="Enter Unit Name">
        </div>
        <div class="form-group">
            <label for="number_of_bedrooms">Number of bedrooms</label>
            <input type="number" class="form-control" id="number_of_bedrooms" name="number_of_bedrooms" placeholder="Enter Number of bedrooms">
        </div>
        <div class="form-group">
            <label for="number_of_bathrooms">Number of bathrooms</label>
            <input type="number" class="form-control" id="number_of_bathrooms" name="number_of_bathrooms" placeholder="Enter number of bathrooms">
        </div>
        <div class="form-group">
            <label for="monthly_rate">Monthly rent amount</label>
            <input type="number" class="form-control" id="monthly_rate" name="monthly_rate" placeholder="Enter Monthly Rate">
        </div>
        <div class="form-group">
            <label for="yaka">Yaka meter</label>
            <input type="number" class="form-control" id="yaka" name="yaka" placeholder="Enter Yaka meter">
        </div>
        <div class="form-group">
            <label for="nwsc">NWSC number</label>
            <input type="number" class="form-control" id="nwsc" name="nwsc" placeholder="Enter NWSC number">
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card footer">
        <button type="submit" name="btnsave" class="btn btn-success">Save Changes</button>
    </div>
</form>
                            
                        <!-- form end -->
                    </div>
                    <!-- /.card -->
            
            
                </div>
   
                    <!-- /.card -->
            
            
                </div>



            </div>
        
        <!-- /.container-fluid -->
        </section>
</div>
<!-- /.content-wrapper -->
<?php include_once "footer.php" ?>

<?php
if(isset($_SESSION['status']) && $_SESSION['status']!='')

{
  ?>
  <script>

   
      Swal.fire({
        icon: '<?php echo $_SESSION['status_code']; ?>',
        title: '<?php echo $_SESSION['status']; ?>',
    
    });
  </script>
  <?php
  unset($_SESSION['status']);
}
?>