[MOOTOMBO!Framework](http://devxive.com)
====

### The MFWJavascriptAnimation Class

Load the animation css file and add support to remove animation on click
```
<?php
	MFWJavascriptAnimation::loadAnimation();
?>
```

Use `$selector` as the wrapping container where the animation should be remove, or set the removal function `$closet` to false
