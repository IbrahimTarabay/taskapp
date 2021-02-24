<div>
  <label for="description">Description</label>
  <input type="text" name="description" id="description"
   value="<?= old('description', esc($task->description)) ?>">
   <!--we use old() to show the value you entered in description even if it is unvalid-->
 </div>