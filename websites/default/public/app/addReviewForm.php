<?php
echo '
<div>
<p>Leave a review</p>
<form action="../functions/addComment.php" method="POST">
    <label for="name">Name:</label><br>
    <input name="id" style="display:none" value="' . $menu["id"] . '" />
    <input type="text" name="name"><br>
    <label for="content">Comment</label><br>
    <textarea name="content" cols="30" rows="10"></textarea><br>
    <label for="rating">Ratings</label><br>
    <select name="rating">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    </select><br>
    <input type="submit" value="Submit">
  </form> 
</div>
';
