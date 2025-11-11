<option selected disabled>Open this select menu</option>

<?php 
require'config.php';



$categoryId = $_POST['categoryId'];

        $res= mysqli_query($conn,"SELECT * FROM subcategory WHERE category = '$categoryId' "); 
         if(mysqli_num_rows($res)>0)
        {
            while($data=mysqli_fetch_array($res))
            { ?>
                <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>";
            <?php }
        }
        else
        { ?>
            <option selected disabled>No Category added.</option>
        <?php         
        }
?>