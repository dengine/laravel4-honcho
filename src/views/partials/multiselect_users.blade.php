<?php

// if we hav enot provided the users, let's o ahead and retrieve them all.
if (empty($users)) $users = Sentry::getUserProvider()->findAll();

if (empty($selected_users)) $selected_users = array();
$selected_users = Input::old('users', $selected_users);


foreach ($users as $user)
{
	$selected = null;

	// if we've not speci
	if (empty($selected_users)) $selected_users = array();

	if (in_array($user->id, $selected_users))
	{
		$selected = 'selected';
	}

	// add our option
	$options[] = '<option value="'.$user->id.'" '.$selected.'>'.$user->first_name.' '.$user->last_name.' ('.$user->email.')</option>';
}

?>

<div class="control-user">
	<div class="controls">
		<select id="users[]" name="users[]" multiple=multiple class="multiselect" size="10">
			<?php
				foreach($options as $option)
				{
					echo $option . PHP_EOL;
				}
			?>
		</select>
	</div>
</div>