<tr>
    <td><?php echo $type; ?></td>
    <td><input type="input" /></td>
    <td>
	<select>
	    <?php foreach($units as $unit): ?>
		<option><?php echo $unit; ?></option>
	    <?php endforeach; ?>
	</select>
    </td>
</tr>
