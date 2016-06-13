# simple-database-wrapper

He database wrapper ho te hi a hman dan tlangpui chu, SQL query kan hman tlanglawn em em - select, insert, update, delete te ho ziah reng ngailo a, kan model instance siam mai a, khami instance hmanga kan database table va bind-a, a tul ang method call paha arguments pek kha a ni a. Entirnan, insert statement

```sql
insert into posts (title, body, updated_at) values ('Title 1', 'Body 1', now());
```
tih ai chuan

```php
$post = new Post(new Database);
$post->title = 'Title 1';
$post->body = 'Body 1';
$post->updated_at = date('Y-m-d H:i:s');

$post->save();
```
tih khan a awlsam em em a ni. Entirna dang pawh, update query ai

```php
$post = new Post(new Database);
$post->id = 5;

$post->save();
```
```php
$post = new Post(new Database);
$posts = $post->find(5);
```
```php
$post = new Post(new Database);
$post->id = 5;

$post->delete();
```

SQL danglam deuh atan kan in ready ve nan 

```php
$post = new Post(new Database);
$posts = $post->findWith('any query here');
```

Tih theih tam tak ala awm a, features belh tur la tam tak a ni. Kan improve zel anga, a tul chuan tuna kan structure neihsa pawh hi kan la thlak hlawk dawn nia. ORM a nilo tih kha lo hre ta phawt ila.
