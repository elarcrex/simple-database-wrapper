<?php
require 'vendor/autoload.php';

use Elarc\Libs\Database;
use Elarc\Models\Post;

$post = new Post(new Database);
/* Start */
var_dump($post->all());

$post->title = "First post";
$post->body = "First post body";
$post->updated_at = date('Y-m-d H:i:s');
$post->save();

var_dump($post->all());
/* End */

/* Start */
$post->id = 5;
$post->title = "Updated title";
$post->save();

var_dump($post->all());
/* End */

/* Start */
$post->id = 4;
$post->delete();

var_dump($post->all());
/* End */