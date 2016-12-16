# RUVENTS Twig Extensions

## Class Extension

Helps to work with objects

### instanceof(class_name) test

```twig
{% if object is instanceof('Namespace\\Class') %}
{% endif %}
```

## Inflector Extension

Is useful for transforming strings. Internally uses the [Doctrine Inflector](https://packagist.org/packages/doctrine/inflector) library.

### |underscorize filter

```twig
{{ 'aliceInChains'|underscorize }} {# prints: alice_in_chains #}
{{ 'AliceInChains'|underscorize }} {# prints: alice_in_chains #}
```

### |classify filter

```twig
{{ 'alice_in_chains'|classify }} {# prints: AliceInChains #}
{{ 'aliceInChains'|underscorize }} {# prints: AliceInChains #}
```

### |camelize filter

```twig
{{ 'alice_in_chains'|camelize }} {# prints: aliceInChains #}
{{ 'AliceInChains'|camelize }} {# prints: aliceInChains #}
```

### |ucwords(delimiters=" \n\t\r\0\x0B-") filter

Uppercases words with configurable delimeters between words

```twig
{{ 'hello sean'|ucwords }} {# prints: Hello Sean #}
```
