<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Comics</title>
    <link rel="stylesheet" href="table.css">
    <link rel="icon" href="icon.png" >    
    <!-- <script src="Addcomic.js"></script> -->
    <style>
        td {
          text-align: left;  
        }
    </style>
</head>
<body>
    <div class="Card"><br />
        <h3>Add Comic</h3>          
            <table>  
                <tr>
                    <td>Comic Name</td>
                    <td><input type="text" name="Cname" id="Cname" onkeypress="return isAlphabet(event)" /></td>
                </tr>
                <tr>
                    <td>Author Name</td>
                    <td><select id="Aname" >
                        <option value=0>Select Author</option>
                        <?php
                            $con = mysqli_connect('localhost', 'root', '','bookstore_project');
                            $qryAuthors = "select AuthorID, AuthorName from author order by AuthorName";
                            $rstAuthors = mysqli_query($con, $qryAuthors);
                            while ($rowAuthors =  mysqli_fetch_assoc($rstAuthors)) {
                                echo "<option value = " .  $rowAuthors['AuthorID'] . ">" . $rowAuthors['AuthorName'] . "</option>";
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <!-- <tr>
                    <td>Cover Photo</td>
                    <td><input type="file" name="Cimg" id="Cimg" /></td>
                </tr> -->
                <tr>
                    <td>Comic Type</td>
                    <td><input type="Text" name="Ctype" id="Ctype" /></td>
                </tr>
                <tr>
                    <td>Published Date</td>
                    <td><input type="date" name="Pdate" id="Pdate" /></td>
                </tr> 
                <tr >
                    <td>Price</td>
                    <td><input type="number" name="Price" id="Price" onkeypress="return isNumber(event)"/></td>
                </tr>
            </table>
            <center>
                <button name="Submit" id="Submit" value="Submit" onclick="submitForm()">Done</button>
                <button ><a href="Comics.php">Back</a></button>
            </center>
        </div>
</body>
<script>
    function submitForm() {
    alert('hi');
    var formData = new FormData();
    // var imgFile = document.getElementById('Cimg');
    // formData.append('image', imgFile.files[0]);
    formData.append('Cname', document.getElementById('Cname').value);
    formData.append('Aname', document.getElementById('Aname').value);
    formData.append('CType', document.getElementById('Ctype').value);
    formData.append('Pdate', document.getElementById('Pdate').value);
    formData.append('Price', document.getElementById('Price').value);

    var xmlreq = new XMLHttpRequest();
    var url = "CBe.php";
    xmlreq.open('POST', url, true);
    xmlreq.onload = function() {
        if(xmlreq.status==200) {
            alert(xmlreq.responseText);
        } else {
            alert('Something went wrong');
        }
    };

    xmlreq.send(formData);

	document.getElementById("Cname").value="";
	document.getElementById("Aname").value="";
	document.getElementById("Cimg").value="NO FILE CHOSEN";
	document.getElementById("Ctype").value="";
	document.getElementById("Pdate").value="";
	document.getElementById("Price").value="";

}
function isNumber(evt) {
    if (evt.charCode < 48 && evt.charCode > 57){
        return false;
    }
    return true;
}
function isAlphabet(event) {
    if ((event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32) {
        return true;
    }
    return false;
}
</script>
</html>