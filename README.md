# TinyMCE image upload plugin for Laravel 5
This is the simplest implementation of a tinyMCE plugin for integrating with Laravel routes and controllers.  This will allow you to add a button to tinyMCE which will let a user select an image file to upload.  After the file is selected, the form is submitted, and you can process the image using whatever methods you choose.

**This implementation is light weight and allows for lots of customization, but is not recommended for those that are not familiar with the Laravel framework to include routes and controllers.**


## Installation
The plugin only has 4 files all under 1MB in size and are arranged in 2 folders.

**1.** The `/imageupload` folder should be copied into the `js/tinyMCE/plugins` folder as are usualy tinyMCE plugins.

**2.** The views `_image-dialog.blade.php` and `_image-upload.blade.php` should be put into the Laravel views folder of your choosing.


## Setup and Configuration
This plugin assumes that you have a Laravel 5 installation and that you're using the HTML and Form helpers.

**routes.php** setup:

```php
<?php
Route::get('route/used/for/image/upload', function() {
			return view('location.of._image-dialog');
		});
Route::post('route/used/for/image/upload', 'CustomController@imageUpload');
```

**CustomController.php** setup:

```php
<?php

class CustomController extends Controller {
  public function imageUpload() {
  // receives form input file
  // handle image processing here
  
  $file_path = 'http://path.to/image/file.jpg';
  return view('_image-upload', compact('file_path');
  }
}
```


##View Setup
Now you need to adjust `_image-dialog.blade.php` to reflect the same route that was used for `route/used/for/image/upload` above.

You can see this on line 13 of `_image-dialog.blade.php`
```php
{!! Form::open(array('url' => 'route/used/for/image/upload', 'method' => 'POST', 'files' => true, 'target' => 'upload_target')) !!}
```

##tinyMCE Setup
Now you just have to add a `<script></script>` block on the page you intend to use tinyMCE on.

Here is an example of the minimal configuration that I use:
```html
<script type="text/javascript">
	/*
	 * TinyMCE Setup
	 */
	tinymce.init({
		menubar : false,
		selector: "textarea",
		plugins: [
			"link image code fullscreen imageupload"
		],
		toolbar: "undo redo | bold italic | bullist numlist outdent indent | link image | imageupload | code | fullscreen",
		relative_urls: false
	});
	</script>
```

##You're done!
Go use your controller function to process the image and save it.  The plugin handles added it to the tinyMCE instance as long as you pass the `$file_path` variable to the view included.
