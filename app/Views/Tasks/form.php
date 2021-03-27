<div class="field">
  <label class="label" for="description">Description</label>
  <input class="input" type="text" name="description" id="description"
   value="<?= old('description', esc($task->description)) ?>">
   <!--we use old() to show the value you entered in description even if it is unvalid-->
 </div>