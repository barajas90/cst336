<form style="width:400px; text-align: center; margin: 0 auto;">
    <strong>Product name</strong><input type="text" class="form-control" name="productName"><br>
    <strong>Description</strong><textarea name="description" class="form-control" cols= 50 rows=4></textarea><br>
    <strong>Price</strong> <input type="text" class="form-control" name="price"><br>
    <strong>Category</strong> <select name="catId" class="form-control">
        <option value="">Select One</option>
        <?php getCategories(); ?>
    </select><br />
    <strong>Set Image Url</strong><input type="text" name = "productImage" class="form-control"><br>
    <input type="submit" name="submitProduct" class='btn btn-primary' value="Add Product">
</from>