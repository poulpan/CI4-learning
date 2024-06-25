<label for="cl_brand">Brand <span style="color: red;">*</span></label>
<input type="text" name="cl_brand" id="cl_brand" value="<?= old('cl_brand', esc($record->cl_brand)) ?>" placeholder="Marka">

<label for="cl_model">Model <span style="color: red;">*</span></label>
<input type="text" name="cl_model" id="cl_model" value="<?= old('cl_model', esc($record->cl_model)) ?>" placeholder="M' ekapses">

<label for="cl_color">Color</label>
<input type="text" name="cl_color" id="cl_color" value="<?= old('cl_color', esc($record->cl_color)) ?>" placeholder="Diafano">

<label for="cl_year">Year <span style="color: red;">*</span></label>
<input type="text" name="cl_year" id="cl_year" value="<?= old('cl_year', esc($record->cl_year)) ?>" placeholder="0000">

<button style="background-color: green; color: whitesmoke;">Save</button>