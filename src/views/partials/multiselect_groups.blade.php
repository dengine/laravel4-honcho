<?php

// if we hav enot provided the groups, let's o ahead and retrieve them all.
if (empty($groups)) $groups = Sentry::getGroupProvider()->findAll();

if (empty($selected_groups)) $selected_groups = array();
$selected_groups = Input::old('groups', $selected_groups);


foreach ($groups as $group)
{
	$selected = null;

	// if we've not speci
	if (empty($selected_groups)) $selected_groups = array();

	if (in_array($group->id, $selected_groups))
	{
		$selected = 'selected';
	}

	// add our option
	$options[] = '<option value="'.$group->id.'" '.$selected.'>'.$group->name.'</option>';
}

?>

<div class="control-group">
	<div class="controls">
		<select id="groups[]" name="groups[]" multiple=multiple class="multiselect" size="10">
			<?php
				foreach($options as $option)
				{
					echo $option . PHP_EOL;
				}
			?>
		</select>
	</div>
</div>