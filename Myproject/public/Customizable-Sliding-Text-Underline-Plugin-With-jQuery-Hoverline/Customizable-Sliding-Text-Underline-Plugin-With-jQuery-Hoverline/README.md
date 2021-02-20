Hoverline jQuery Plugin
===========================

**Last Updated :**  December, 2011<br/>
**Demo :** http://nakule.in/demo/hoverline

The Hoverline jQuery plugin adds a sleek, beautiful and animated Hoverline to your Horizontal Navigation Menu.

First, write the HTML markup for your navbar.

```
<ul id="navbar">
	<li><a href="#">First Menu</a></li>
	<li><a href="#">Second Menu</a></li>
	<li><a href="#">Third Menu</a></li>
	<li><a href="#">Fourth Menu</a></li>
</ul>
```

As a bonus, the Hoverline Plugin comes with a function to convert a list with markup as above into a horizontal Navigation Menu. 

To create a navigation bar from the above markup, simply call the function `makeNavbar()`

```
$('ul#navbar').makeNavbar();
```

Voila !! Now, call the function `hoverline()` to add the animated hoverline to your navbar.

```
// A black hoverline with 1px thickness/height
$('ul#navbar').hoverline();

// A custom hoverline
$('ul#navbar').hoverline({
	'color' : 'red',	// Changes color of the Hoverline
	'height' : '2px',	// Changed Thickness
	'start' : '1',		// The First menu element is set as Default
	'speed' : '200',	// Speed of animation
});
```

Detailed explaination of the options and its usage can be found in the demo @ http://nakule.in/demo/hoverline
