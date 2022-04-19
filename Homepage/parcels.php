<?php include './Admin/connection.php'; ?>
<?php
      include 'navbar.php';
      include 'fetch.php';
    ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">


    <div class="container mb-3 mt-3" style="height: 100vh;">
        <table class="table table-striped table-bordered mydatatables" style="width: 100%;">
            <thead>
                <th>#</th>
                <th>Reference Number</th>
                <th>Sender Name</th>
                <th>Recipient Name</th>
                <th>Weight</th>
                <th>Height</th>
                <th>Length</th>
            </thead>

            <tbody>
                <?php
					$i = 1;
					$where = "";
                    $id = $fetch_info['id'];
					
					$qry = $conn->query("SELECT * from parcels WHERE users_id = '$id' ");
					while($row= $qry->fetch_assoc()):
					
                    // $sql = "SELECT reference_number, sender_name,recipient_name,weight,height,length FROM parcels WHERE ; ";
                    // $result = $conn->query($sql);

                    // if ($result->num_rows > 0) {
                    // echo "<table><tr><th>Ref</th><th>Send</th><th>Re</th><th>wei</th><th>hei</th><tr>len</tr></tr>";
                    // // output data of each row
                    // while($row = $result->fetch_assoc()) {
                    //     echo "<tr><td>".$row["reference_number"]."</td><td>".$row["sender_name"]." ".$row["recipient_name"]."</td><td>".$row["weight"]."</td><td>".$row["height"]."</td><td>".$row["length"]."</td></tr>";
                    // }
                    // echo "</table>";
                    // } else {
                    // echo "0 results";
                    ?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td><b><?php echo ($row['reference_number']) ?></b></td>
						<td><b><?php echo ucwords($row['sender_name']) ?></b></td>
						<td><b><?php echo ucwords($row['recipient_name']) ?></b></td>
                        <td><b><?php echo ucwords($row['weight']) ?></b></td>
                        <td><b><?php echo ucwords($row['height']) ?></b></td>
                        <td><b><?php echo ucwords($row['length']) ?></b></td>
						
					
					</tr>	
				<?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php include 'footer.php' ?>




<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" ></script>
<script>
    $('.mydatatables').dataTable(
        {
            lengthMenu: [[5, 10, 25, 50, -1],[5, 10, 25, 50, "All"]]
        }
    );
</script>

