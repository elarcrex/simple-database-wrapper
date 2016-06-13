<?php
require 'vendor/autoload.php';

use Elarc\Libs\Database;
use Elarc\Models\Post;

$post = new Post(new Database);

/*$post->title = "First post";
$post->body = "First post body";
$post->updated_at = date('Y-m-d H:i:s');
$post->save();*/

var_dump($post->all());
