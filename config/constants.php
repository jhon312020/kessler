<?php
return[
	'GA'=>[
		'RANGE'=>range(1, 10),
		'STORY'=>range(1, 4),
		'WRITE'=>range(1, 8),
		'GENERAL'=>range(1, 2),
		'OTHER'=>range(1,10),
	],
	'SA'=>[
		'RANGE'=>range(1, 18),
		'STORY'=>range(1, 8),
		'WRITE'=>range(1, 8),
		'GENERAL'=>range(1, 2),
		'OTHER'=>range(1,10),
	],
	'COMMON'=>[
		'ADMIN_ROLES'=>['SA', 'GA'],
		'REVIEW_CATEGORY'=> range(2,4),
		'STORY_CATEGORY'=> 1,
		'DIRECTION_BOOSTER_ID'=>1,
		'SHOPPING_BOOSTER_ID'=>2,
		'TODO_BOOSTER_ID'=>3,
		'MIN_SESSION_NO'=>8,
		'MIN_WRITE_NO'=>9,
		'MAX_SESSION_NO'=>18,
		'CATEGORY'=>range(1,5),
		'BOOSTER'=> 'Booster',
		'BOOSTER_RANGE'=>range(1,3),
		'RANGE'=>range(1, 18),
	]
];
?>