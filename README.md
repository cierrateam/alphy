# Alphy
A tiny wrapper around alpine for laravel which is made for easier usage of components.

## Installation 
`composer require cierrateam/alphy`

## Usage
Instead of
```html
<div x-data="fooBar()">
  <span x-text="foo" />
</div>

<script>
  function fooBar() {
    return {
      foo: "bar",
    }
  }
</script>
```

You can just use
```html
<a-fooBar>
  <span x-text="foo" />
</a-fooBar>


<script>
  function fooBar() {
    return {
      foo: "bar",
    }
  }
</script>
```

## Plans
We're planning to extend this shorthands by time. It's just a small start for something big. So stay tuned 🚀
