<?php
include_once 'connect.php';
session_start();
include_once "header.php";

if (isset($_POST['btnsave'])) {
    $rental_property_name = $_POST['property_name'];
    $unit_number = $_POST['unit_number'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $entry_date = $_POST['entry_date'];

// retrieve the rental_unit_id and rental_property_id based on the selected unit_number and property_name
$unit_property_query = $pdo->prepare("
    SELECT rental_units.id AS unit_id, rental_properties.id AS property_id 
    FROM rental_units 
    INNER JOIN rental_properties ON rental_units.rental_property_id = rental_properties.id
    WHERE rental_properties.name = :property_name AND rental_units.unit_number = :unit_number
");
$unit_property_query->bindParam(':property_name', $rental_property_name);
$unit_property_query->bindParam(':unit_number', $unit_number);
$unit_property_query->execute();
$result = $unit_property_query->fetch(PDO::FETCH_ASSOC);

$rental_unit_id = $result['unit_id'];
$rental_property_id = $result['property_id'];

// prepare the insert statement with the retrieved rental_unit_id and rental_property_id
$insert = $pdo->prepare("
    INSERT INTO tenants(first_name, last_name, email, phone_number, move_in_date, unit_id, property_id) 
    VALUES (:first_name, :last_name, :email, :phone_number, :entry_date, :unit_id, :property_id)
");

$insert->bindParam(':first_name', $first_name);
$insert->bindParam(':last_name', $last_name);
$insert->bindParam(':email', $email);
$insert->bindParam(':phone_number', $phone_number);
$insert->bindParam(':entry_date', $entry_date);
$insert->bindParam(':unit_id', $rental_unit_id);
$insert->bindParam(':property_id', $rental_property_id);

if ($insert->execute()) {
    $_SESSION['message'] = 'Tenant added successfully';
    $_SESSION['status_code'] = 'success';
} else {
    $_SESSION['message'] = 'Tenant has not been added';
}

}

?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add new Tenant</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Tenants</a></li>
                        <li class="breadcrumb-item active">New tenant Form</li>
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
                        <h3 class="card-title">Add New Tenant Details</h3>
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <?php
                            $pdo = new PDO('mysql:host=localhost;dbname=paxafricana', 'root', '');
                            $stmt = $pdo->query('SELECT name FROM rental_properties');
                            $property_names = $stmt->fetchAll(PDO::FETCH_COLUMN);
                            ?>
                            <div class="form-group">
                                <label for="property_name">Property Name</label>
                                <select class="form-control" id="property_name" name="property_name">
                                    <?php foreach ($property_names as $property_name): ?>
                                        <option value="<?php echo $property_name; ?>"><?php echo $property_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php
                            $pdo = new PDO('mysql:host=localhost;dbname=paxafricana', 'root', '');
                            $stmt = $pdo->query('SELECT unit_number FROM rental_units');
                            $unit_names = $stmt->fetchAll(PDO::FETCH_COLUMN);
                            ?>
                            <div class="form-group">
                                <label for="unit_num">Unit Number</label>
                                <select class="form-control" id="unit_number" name="unit_number">
                                    <?php foreach ($unit_names as $unit_number): ?>
                                        <option value="<?php echo $unit_number; ?>"><?php echo $unit_number; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="first_name">Tenant First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter tenant's first name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Tenant Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter tenant's last name">
                            </div>
                            <div class="form-group">
                                <label for="email">Tenant Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter tenant's email">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Tenant Phone Number</label>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Enter tenant's phone number">
                            </div>
                            <div class="form-group">
                                <label for="move_in">Tenant Entry Date</label>
                                <input type="date" class="form-control" id="entry_date" name="entry_date" placeholder="Enter tenant's entry date">
                            </div>
                            <div class="form-group">
                                <label for="exit_date">Tenant Exit Date</label>
                                <input type="date" class="form-control" id="exit_date" name="exit_date" placeholder="Enter tenant's exit date">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" name="btnsave" class="btn btn-success">Add New Tenant</button>
                        </div>
                    </form>
                    <!-- form end -->
                    </div>
              <!-- /.card-body -->
            </div>

            </div>



</div>

<!-- /.container-fluid -->
</section>
</div>
<!-- /.content-wrapper -->
<?php include_once "footer.php" ?>

<?php
if(isset($_SESSION['status']) && $_SESSION['status']!=''){


}

?>
<script>
        

</script>