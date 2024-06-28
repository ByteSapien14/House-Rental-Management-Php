<!DOCTYPE html>
<html lang="en">

<body>
    <?php include 'links.php'; ?>
    <div class="main">
        <center>
            <div class="card" style="width: 43rem; border-radius: 35px; background-color:#f0f5f5; margin-top:140px">
                <br>
                <div class="card-body">
                    <h1 class="card-title" style="text-align:center"><B>Add House</B></h1><br>
                    <form name="Form2" action="addhouse.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">

                        <table class="tab">
                            <tr>
                                <td><b>Owner ID: </b></td>
                                <td> <input type="number" id="ownerId" name="o" value="" size="25"></td>
                            </tr>
                            <tr>
                                <td><b>No of Rooms: </b></td>
                                <td> <input type="number" id="noOfRooms" name="n" value="" size="25"></td>
                            </tr>
                            <tr>
                                <td><b>Rate: </b></td>
                                <td> <input type="number" id="rate" name="ra" value="" size="35"></td>
                            </tr>
                            <tr>
                                <td><b> Upload Pics: </b></td>
                                <td> <input type="file" name="u[]" value="" size="25" accept="image/*" multiple></td>
                            </tr>
                            <tr>
                                <td><b>Address: </b></td>
                                <td> <input type="text" id="address" name="a" value="" size="25"></td>
                            </tr>
                            <tr>
                                <td><b>Description: </b></td>
                                <td> <input type="text" id="description" name="de" value="" size="25"></td>
                            </tr>
                        </table>
                        <br><br>
                        <input type="submit" value="Add" class="btn-primary" name="submit">
                    </form><br>
                </div>
            </div>
        </center>
    </div>
    <script>
      function validateForm() {
        var ownerId = document.getElementById('ownerId').value;
        var noOfRooms = document.getElementById('noOfRooms').value;
        var rate = document.getElementById('rate').value;
        var address = document.getElementById('address').value;
        var description = document.getElementById('description').value;

        if (ownerId === "" || noOfRooms === "" || description === "") {
          alert('Please fill in all required fields.');
          return false;
        }

        // Additional validation logic for specific fields (e.g., numeric checks)
        if (isNaN(ownerId) || isNaN(noOfRooms) || isNaN(rate)) {
          alert('Numeric fields must contain valid numbers.');
          return false;
        }

        return true;
      }
    </script>

</body>

</html>
