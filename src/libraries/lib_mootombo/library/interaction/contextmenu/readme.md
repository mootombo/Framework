Bootstrap XiveContextMenu
====
jQuery plugin for right-click context menus

Author: Lahmizzar Muinela, devXive - research and development

Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html

Version: 1.1.9
Date: 22 October 2013


## Description
The XiveContextMenu is a lightweight jQuery plugin that lets you selectively override the browser's right-click menu with a custom one of your own. It integrates with Twitter Bootstrap 2.3.x

## Features
 * Use multiple menus on one page
 * Menus can be bound to multiple elements
 * Advanced stylable
 * Fully customizable Use Data Attributes to determine menu bindings


## Example usage
```html
<table id="myTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Names</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td class="person">Mike</td>
        </tr>
        <tr>
            <td>2</td>
            <td class="person">Judith</td>
        </tr>
    </tbody>
</table>

<div id="bsxContextMenu" class="dropdown clearfix">
	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
		<li><a data-menu="action1" tabindex="-1" href="#">Action</a></li>
		<li><a data-menu="action2" tabindex="-1" href="#">Another action</a></li>
		<li><a data-menu="action3" tabindex="-1" href="#">Something else here</a></li>
		<li class="divider"></li>
		<li><a data-target="_blank" href="http://google.com/">Open up Google in a new Window</a></li>
	</ul>
 </div>

<script>
	$('#bsxContextMenu').bsContextMenu( '#myTable td.person');
</script>
```

See a working copy in this [jsFiddle](http://jsfiddle.net/Lahmizzar/YtjZp/)

You define your menu structure in your HTML markup. For each menu, place an unordered list in a div with class "bsxContextMenu" and the id you will refer to it by (see the example). The div can be placed anywhere as it will automatically be hidden by the plugin.

For more Informations about the Twitter Bootstrap Dropdown Menu, visit the [Boostrap Documentation - Dropdowns](http://getbootstrap.com/2.3.2/components.html#dropdowns).

You can have as many menus defined on a page as you like. Each `<a data-menu>` element will act as an option on the menu. Give each `<a data-menu>` a unique id so that actions can be bound to it. 
> _Note: bsxContextMenu currently support nested menus with bootstrap 2.3.2 only. This feature for bootstrap 3.0 may be in an upcoming release._

## Parameters

### target
The `selector` of the element as defined in your markup. You can bind one or more elements. Eg $('myMenu').bsxContextMenu('table td') will bind the menu with id "myMenu" to all table cells.

### options
bsxContextMenu takes an optional settings object that lets you style your menu and bind click handlers to each option. bsxContextMenu supports the following properties in the settings object:

#### bindings
 * An object containing _"data-menu":function pairs_. The supplied function is the action to be performed when the associated item is clicked. The element that triggered the current menu is passed to this handler as the first parameter.

#### dropdownMenu
 * An object containing _styleName:value pairs_ for styling the containing `<div id="myMenu">` menu.

<table>
  <tr>
    <td><b>name</b></td>
    <td><b>type</b></td>
    <td><b>option (<span style="color=#00bb00">default</span>)</b></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>display</td>
    <td>string</td>
    <td><span style="color=#00bb00">'block'</span></td>
  </tr>
  <tr>
    <td>position</td>
    <td>string</td>
    <td><span style="color=#00bb00">'absolute'</span></td>
  </tr>
  <tr>
    <td>zIndex</td>
    <td>int</td>
    <td><span style="color=#00bb00">100</span></td>
  </tr>
</table>


#### listStyle
 * An object containing _styleName:value pairs_ for styling the `<li>` elements in "myMenu".
[color=#ff0000][i]NOTE: This feature is currently outdated and has no function. It'll come back in the further version for Bootstrap 3.x Versions[/i][/color]

<table>
  <tr>
    <td><b>name</b></td>
    <td><b>type</b></td>
    <td><b>option (<span style="color=#00bb00">default</span>)</b></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>cursor</td>
    <td>string</td>
    <td><span style="color=#00bb00">'default'</span></td>
  </tr>
  <tr>
    <td>padding</td>
    <td>string</td>
    <td><span style="color=#00bb00">3px</span></td>
  </tr>
</table>


#### targetStyle
 * An object containing the _css corsor style_ and an option to _prevent selection of the target_.

<table>
  <tr>
    <td><b>name</b></td>
    <td><b>type</b></td>
    <td><b>option (<span style="color=#00bb00">default</span>)</b></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>cursor</td>
    <td>string</td>
    <td><span style="color=#00bb00">'context-menu'</span></td>
  </tr>
  <tr>
    <td>selectable</td>
    <td>boolean</td>
    <td><span style="color=#00bb00">false</span></td>
  </tr>
</table>


#### shadow
 * Display a basic drop shadow on the menu.

<table>
  <tr>
    <td><b>name</b></td>
    <td><b>type</b></td>
    <td><b>option (<span style="color=#00bb00">default</span>)</b></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>shadow</td>
    <td>boolean</td>
    <td><span style="color=#00bb00">false</span></td>
  </tr>
</table>


## Using an advanced sublevel dropdown menu (Example)
```html
<div class="dropdown clearfix bootstrap-contextmenu" id="bsxContextMenu">
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display: block;">
        <li><a href="#" data-menu="view" tabindex="-1"><i class="icon-eye-open"></i> View</a></li>
        <li class="dropdown-submenu">
            <a href="#" tabindex="-1">Sort by</a>
            <ul aria-labelledby="dropdownMenu" role="menu" class="dropdown-menu">
                <li><a href="#" data-menu="name" tabindex="-1">Name</a></li>
                <li><a href="#" data-menu="size" tabindex="-1">Size</a></li>
                <li><a href="#" data-menu="itemtype" tabindex="-1">Item type</a></li>
                <li><a href="#" data-menu="datemodified" tabindex="-1">Date modified</a></li>
                <li class="divider"></li>
                <li><a href="#" data-menu="ascending" tabindex="-1">Ascending</a></li>
                <li><a href="#" data-menu="descending" tabindex="-1">Descending</a></li>
                <li class="divider"></li>
                <li class="dropdown-submenu">
                    <a href="#" tabindex="-1">More</a>
                    <ul aria-labelledby="dropdownMenu" role="menu" class="dropdown-menu">
                        <li><a href="#" data-menu="other1" tabindex="-1">Other 1</a></li>
                        <li><a href="#" data-menu="other2" tabindex="-1">Other 2</a></li>
                        <li><a href="#" data-menu="other3" tabindex="-1">Other 3</a></li>
                        <li class="divider"></li>
                        <li><a href="#" data-menu="other4" tabindex="-1">Other 4</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="#" data-menu="refresh" tabindex="-1"> <i class="icon-refresh"></i> Refresh</a></li>
        <li><a href="#" data-menu="notepad" tabindex="-1">Notepad++</a></li>
        <li class="divider"></li>
        <li><a href="#" data-menu="copy" tabindex="-1">Copy</a></li>
        <li class="disabled"><a href="#" data-menu="paste" tabindex="-1">Paste</a></li>
        <li class="disabled"><a href="#" data-menu="paste_shortcut" tabindex="-1">Paste shortcut</a></li>
        <li class="divider"></li>
        <li><a href="#" data-menu="create_shortcut" tabindex="-1">Create shortcut</a></li>
        <li><a href="http://google.de" data-menu="rename" tabindex="-1">Rename</a></li>
        <li><a href="#" data-menu="delete" tabindex="-1">Delete</a></li>
        <li class="divider"></li>
        <li><a href="#" data-menu="properties" tabindex="-1">Properties</a></li>
    </ul>
</div>
```


## Changing defaults
*~~In addition to passing style information for each menu via the settings object, you can extend the default options for all menus by calling $.contextMenu.defaults(settings). Every setting except bindings can be used as a default.~~*


## Credits
Inspired by:
 * [contextmenu plugin by Chris Domigan](http://www.trendskitchens.co.nz/jquery/contextmenu/)
 * [Twitter Bootstrap Context Menu by vudoanthang](http://codecanyon.net/item/twitter-bootstrap-context-menu/3599317)
 * [SO: Use Bootstrap 3 dropdown menu as context menu](http://stackoverflow.com/questions/18666601/use-bootstrap-3-dropdown-menu-as-context-menu)

 * [jQuery contextMenu by Rodney Rehm](http://medialize.github.io/jQuery-contextMenu/)
 * [jQuery ContextMenu Plugin by Matt Kruse](http://www.javascripttoolbox.com/lib/contextmenu/index.php)
 * [Query context menu by Jonas Arnklint](https://github.com/arnklint/jquery-contextMenu)


## GIST
https://gist.github.com/lahmizzar/7988c7a7ae4c290e4594.js


## Style optimization
```
.dropdown-menu .divider {
    margin: 5px 0;
}
```

## Bindings example
``` js
$('#bsxContextMenu').bsxContextMenu('.person', {
    bindings: {
        'open': function (t) {
            var target = $(t).data('personid');
            alert('PersonId is ' + target + '\nAction was data-menu="open"');
        },
        'email': function (t) {
            var target = $(t).data('personid');
            alert('PersonId is ' + target + '\nAction was data-menu="email"');
        },
        'save': function (t) {
            var target = $(t).data('personid');
            alert('PersonId is ' + target + '\nAction was data-menu="save"');
        },
        'delete': function (t) {
            var target = $(t).data('personid');
            alert('PersonId is ' + target + '\nAction was data-menu="delete"');
        },
        'paste': function (t) {
            var target = $(t).data('personid');
            alert('PersonId is ' + target + '\nAction was data-menu="paste"');
        }
    }
});
```