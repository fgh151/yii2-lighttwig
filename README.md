Little Twig
===========
This extension allow render twig pages into php layout

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist fgh151/yii2-littletwig "*"
```

or add

```
"fgh151/yii2-littletwig": "*"
```

to the require section of your `composer.json` file.


Usage
-----

First you need add trait to controller:

```php
class TestController extends Controller
{
    use fgh151\littletwig\TwigTrait
    ...
}
```

now you can render twig page:

```php
public function actionIndex()
{
    return $this->renderTwig('/web/test.twig', ['users' => User::find()->limit(10)->all()], ['Project_Twig_Extension']);
}
```

Available params:
twig page,
array of variables
array of twig extensions classes (optional)

Twig extensions
---------------

To add new extension oyu mast create class, for example:
```php
class Project_Twig_Extension extends \Twig_Extension
{
    public  function  getFunctions()
    {
        return [
            new \Twig_SimpleFunction('TestFunction', function ($p, $p1){ 
                return $p + $p1;
            })
        ];
    }

    public function getName()
    {
        return 'project';
    }
}
```

in render function add class:
```php
return $this->renderTwig('/web/test.twig', [], ['Project_Twig_Extension']);
```

instead callback you may write class function:
```php
class Project_Twig_Extension extends \Twig_Extension
{
    public  function  getFunctions()
    {
        return [
            new \Twig_SimpleFunction('TestFunction', $this->f())
        ];
    }

    public function f($p, $p1)
    {
        return $p + $p1;
    }

    public function getName()
    {
        return 'project';
    }
}
```

Now in twig template available function TestFunction :

```twig
<p>{{ TestFunction(6, 4) }}</p>
```
it will render:
```html
<p>10</p>
```