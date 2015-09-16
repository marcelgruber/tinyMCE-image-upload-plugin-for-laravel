[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/marcelgruber/tinyMCE-image-upload-plugin-for-laravel?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=body_badge)
# TinyMCE image upload plugin - Laravel 5
This is the simplest implementation of a tinyMCE plugin for integrating with Laravel routes and controllers.  This will allow you to add a button to tinyMCE which will let a user select an image file to upload.  After the file is selected, the form is submitted, and you can process the image using whatever methods you choose.

**This implementation is light weight and allows for lots of customization, but is not recommended for those that are not familiar with the Laravel framework to include routes and controllers.**


## Installation
The plugin only has 4 files all under 1MB in size and are arranged in 2 folders.

**1.** The `/imageupload` folder should be copied into the `js/tinyMCE/plugins` folder as tinyMCE plugins usually are.

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

Here is an example of what the controller would look like.  NOTE: this doesn't provide validation and the name of `test.jpg` is used for all uploaded images.  Further uploads will overwrite the previous versions.

```php
<?php

class CustomController extends Controller {
  public function imageUpload(Request $request) {
  	$file = $request->file('imagefile');
  	$file->move('images', 'test.jpg');
	$file_path = '/images/'.'test.jpg';
	return view('path.to._image-upload', compact('file_path'));
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
Go use your controller function to process the image and save it.  The plugin handles adding the image to the tinyMCE instance as long as you pass the `$file_path` variable to the view included.
