<?php

////// Write the Database connection code below (Q1)

// Database configuration
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = "password"; // Change this to your database password
$dbname = "lab3"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $lab3;

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Connection successful
echo "Connected successfully";



///////// (Q1 Ends)

$operation_val = '';
if (isset($_POST['operation']))
{
    $operation_val = $_POST["operation"];
    #echo $operation_val;
}

function getId($link) {
    
    $queryMaxID = "SELECT MAX(id) FROM fooditems;";
    $resultMaxID = mysqli_query($link, $queryMaxID);
    $row = mysqli_fetch_array($resultMaxID, MYSQLI_NUM);
    return $row[0]+1;
}



if (isset($_POST['updatebtn']))
{//// Write PHP Code below to update the record of your database (Hint: Use $_POST) (Q9)
//// Make sure your code has an echo statement that says "Record Updated" or anything similar or an error message
    
if (isset($_POST['updatebtn'])) {
    $id = $_POST['update_id'];
    $amount = $_POST['update_amount'];
    $calories = $_POST['update_calories'];
    
//// (Q9 Ends)
}


if (isset($_POST['insertbtn']))
{//// Write PHP Code below to insert the record into your database (Hint: Use $_POST and the getId() function from line 25, if needed) (Q10)
//// Make sure your code has an echo statement that says "Record Saved" or anything similar or an error message
    
if (isset($_POST['insertbtn'])) {
    $item = $_POST['insert_item'];
    $amount = $_POST['insert_amount'];
    $unit = $_POST['insert_unit'];
    $calories = $_POST['insert_calories'];
    $protein = $_POST['insert_protein'];
    $carbohydrate = $_POST['insert_carbohydrate'];
    $fat = $_POST['insert_fat'];
    
    // Get ID using getId() function
    $id = getId($conn);


//// (Q10 Ends)
}


if (isset($_POST['deletebtn']))
{//// Write PHP Code below to delete the record from your database (Hint: Use $_POST) (Q11)
//// Make sure your code has an echo statement that says "Record Deleted" or anything similar or an error message
   
if (isset($_POST['deletebtn'])) {
    $id = $_POST['delete_id'];

//// (Q11 Ends)
}



?>


<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document.ready(function() {
                $("#testbtn").click(function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: 'p3.php',
                        type: 'POST',
                        data: {
                            'operation_val' : $("#operation_val").val(),
                        },
                        success: function(data, status) {
                            $("#test").html(data)
                        }
                    });
                });
                $("#insertbtn").click(function(e) {
                    echo "here0";
                    e.preventDefault();

                    $.ajax({
                        url: 'p3.php',
                        type: 'POST',
                        data: {
                            'operation_val' : $("#operation_val").val(),
                        },
                        success: function(data, status) {
                            echo "here";
                        }
                    });
                });
            }));
            
        </script>
        <link rel="stylesheet" href="p3.css">
    </head>

    <body>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="cars">Choose an operation:</label>
            <select name="operation" id="operation" onchange="this.form.submit()">
                <option value="0" <?php print ($operation_val == 0) ? "selected" : '' ;?>><b>Select Operation</b></option>
                <option value="1" <?php print ($operation_val == 1) ? "selected" : '' ;?>>Show</option>
                <option value="2" <?php print ($operation_val == 2) ? "selected" : '' ;?>>Update</option>
                <option value="3" <?php print ($operation_val == 3) ? "selected" : '' ;?>>Insert</option>
                <option value="4" <?php print ($operation_val == 4) ? "selected" : '' ;?>>Delete</option>
            </select></br></br>
            <?php


            $query = "SELECT * FROM fooditems;";
            if($operation_val == 1){
                if($result = mysqli_query($link, $query)){
                    $fields_num = mysqli_num_fields($result);
                    echo "<table class=\"customTable\"><th>";
                    for($i=0; $i<$fields_num; $i++)
                    {
                        $field = mysqli_fetch_field($result);
                        if($i>0)
                        {
                            echo "<th>{$field->name}</th>";
                        }
                        else
                        {
                            echo "id";
                        }
                        
                    }
                    echo "</th>";
                    if($operation_val == 1){
                        while($row = mysqli_fetch_row($result))
                        {
                            ///// Finish the code for the table below using a loop (Q2)
                            
                            while ($row = mysqli_fetch_row($result)) {
                                echo "<tr>";
                                foreach ($row as $cell) {
                                    echo "<td>$cell</td>";
                                }
                                echo "</tr>";
                            }



                            ///////////// (Q2 Ends)
                        }
                    }                    
                    echo "</table>";
            }
        }
            

            ?>

            


            <div id="div_update" runat="server" class=<?php if($operation_val == 2) {echo "display-block";} else {echo "display-none";}?>>
            <!--Create an HTML table below to enter ID, amount, and calories in different text boxes. This table is used for updating records in your table. (Q3) --->
                
            <table>
               <tr>
                 <td>ID:</td>
                 <td><input type="text" name="update_id"></td>
              </tr>
              <tr>
                 <td>Amount:</td>
                 <td><input type="text" name="update_amount"></td>
              </tr>
              <tr>
                  <td>Calories:</td>
                  <td><input type="text" name="update_calories"></td>
             </tr>
            </table>


            <!--(Q3) Ends --->
            



            <!--Create a button below to submit and update record. Set the name and id of the button to be "updatebtn"(Q4) --->
            
            <input type="submit" name="updatebtn" id="updatebtn" value="Update Record">

            <!--(Q4) Ends --->
            </div>



            <div id="div_insert" runat="server" class=<?php if($operation_val == 3) {echo "display-block";} else {echo "display-none";}?>>
            <!--Create an HTML table below to enter item, amount, unit, calories, protein, carbohydrate and fat in different text boxes. This table is used for inserting records in your table. (Q5) --->
                
            <table>
                <tr>
                    <td>Item:</td>
                    <td><input type="text" name="insert_item"></td>
                </tr>
                <tr>
                    <td>Amount:</td>
                    <td><input type="text" name="insert_amount"></td>
                </tr>
                <tr>
                    <td>Unit:</td>
                    <td><input type="text" name="insert_unit"></td>
                </tr>
                <tr>
                    <td>Calories:</td>
                    <td><input type="text" name="insert_calories"></td>
                </tr>
                <tr>
                    <td>Protein:</td>
                    <td><input type="text" name="insert_protein"></td>
                </tr>
                <tr>
                    <td>Carbohydrate:</td>
                    <td><input type="text" name="insert_carbohydrate"></td>
                </tr>
                <tr>
                    <td>Fat:</td>
                    <td><input type="text" name="insert_fat"></td>
                </tr>
            </table>


            <!--(Q5) Ends --->




            <!--Create a button below to submit and insert record. Set the name and id of the button to be "insertbtn"(Q6) --->
            
            <input type="submit" name="insertbtn" id="insertbtn" value="Insert Record">

            <!--(Q6) Ends --->
            </div>

            <div id="div_delete" runat="server" class=<?php if($operation_val == 4) {echo "display-block";} else {echo "display-none";}?>>
            <!--Create an HTML table below to enter id a text box. This table is used for deleting records from your table. (Q7) --->
                
               <table>
                   <tr>
                      <td>ID:</td>
                      <td><input type="text" name="delete_id"></td>
                   </tr>
               </table>


            <!--(Q7) Ends--->    




            <!--Create a button below to submit and insert record. Set the name and id of the button to be "deletebtn"(Q8) --->

            <input type="submit" name="deletebtn" id="deletebtn" value="Delete Record">
            
            <!--(Q8) Ends --->
            </div>
            
        </form>

    </body>




</html>


